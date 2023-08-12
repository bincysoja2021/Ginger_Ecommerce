<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProducts;
use PDF;
use DB;
use App\Exports\ExportUsers;
use Maatwebsite\Excel\Facades\Excel;

class AdminOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        date_default_timezone_set('Asia/Kolkata');
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $order = Order::orderBy('id','desc')->paginate(5);
        return view('Order.index',compact('order'));
    }

   

    public function edit(Request $req)
    {
        $products=Product::get();
        $order=Order::where('id',$req->id)->first();
        $order_product=OrderProducts::where('order_id',$req->id)->get();
        return view('Order.edit',compact('order','products','order_product'));
    }

     public function invoice(Request $req)
    {
        $data=Order::where('id',$req->id)->first();
        $order_product=OrderProducts::with('products')->where('order_id',$req->id)->get();

        $pdf = PDF::loadView('Order.invoice_pdf',array('data' => $data,'order_product'=>$order_product));

        return $pdf->download('Invoice.pdf');
    }   

    public function update(Request $request)
    {
        $request->validate([
                'name' => 'required',
                'phone'=>'required|digits:10|numeric'
        ]);      
        $category=Order::where('id',$request->id)->update(['cust_name'=>$request->name,'phone'=>$request->phone,'status'=>$request->status]);
        return redirect()->route('list_order')->with('success','Order has been updated successfully');
    }

            

     public function destroy($id)
    {
        
          Order::find($id)->delete();
          return redirect()->route('list_order')->with('success','Order has been deleted successfully');
        
    }

    public function exportCSVFile($id) 
    {   
        return Excel::download(new ExportUsers($id) , 'Order.csv');

    }

    public function change_status(Request $req)
    {
      Order::where('id',$req->id)->update(['status'=>$req->status]);
    } 
       
}
