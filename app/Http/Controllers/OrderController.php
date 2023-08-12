<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProducts;
use App\Models\Order;
use App\Models\User;
use Auth;
use Validator;
use DB;

class OrderController extends Controller
{
    public $successStatus = 200;
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
    }
    public function place_order(Request $req)
    {
       if(auth()->user())
        {                        
            $token   = $req->bearerToken();
            $user_id = Auth::user()->id;
            $user_data=User::where('id',$user_id)->first();
            $validator = Validator::make($req->all(), [ 
                'phone'=>'required|digits:10|numeric',
                'products'=>'required'

            ]);

            if ($validator->fails()) { 
                $errors        = json_decode($validator->errors());
                $phone     =isset($errors->phone[0])? $errors->phone[0] : '';
                $products     =isset($errors->product[0])? $errors->product[0] : '';
                if($phone){
                    $msg = $phone;
                }else if($products){
                    $msg = $products;
                }

                return response()->json(['message'=>$msg,'success' => 'error','statusCode'=>401,'data'=>[]], $this-> successStatus);
            }
            $order=new Order();
            $order->cust_name=$user_data->name;
            $order->phone=$req->phone;
            $order->order_id=random_int(10000, 99999);
            $order->order_date=date('Y-m-d');
            $order->status="Waiting Confirmation";
            $order->save(); 
            $products_data=$req->products;
            for( $i = 0; $i<count($products_data); $i++)
            {
                $product_Details=Product::where('id',$products_data[$i]['p_id'])->first();
                if($products_data[$i]['p_qty'] <= $product_Details->qty && $product_Details->qty !=0)
                {
                    $order_product=new OrderProducts();
                    $order_product->product=$products_data[$i]['p_id'];
                    $order_product->qty=$products_data[$i]['p_qty'];
                    $order_product->order_id=$order->id;
                    $order_product->total_amount=($products_data[$i]['p_qty'])*($product_Details->price);
                    $order_product->save(); 
                    Product::where('id',$products_data[$i]['p_id'])->update(['qty'=>($product_Details->qty- $products_data[$i]['p_qty'])]);
                }
                else
                {
                    Order::where('id',$order->id)->delete();
                    return response()->json(['message'=>"Product out off stock!.", 'statusCode' => 400,'success' => 'error'], $this-> successStatus);
                }
            }
            $amount=DB::table('orderproducts')->where('order_id',$order->id)->sum('total_amount');
            Order::where('id',$order->id)->update(['total_amount'=>$amount]); 
            return response()->json(['statusCode' => $this-> successStatus,'success' => 'success'], $this-> successStatus);           
        }
        else
        {
            return response()->json(['message'=>"User does't exist", 'statusCode' => 400,'success' => 'error'], $this-> successStatus);
        }    

    } 

    public function get_order_details()
    {
       try {
            $order_details= Order::with('order_products')->get();
            return response()->json([
                'success'   => 'success',
                'message'   => 'success',
                'statusCode'=> 200,
                'data'      => $order_details
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success'    => 'error',
                'statusCode' => 500,
                'data'       => [],
                'message'    => $e->getMessage(),
            ]);
        }
    }
}
