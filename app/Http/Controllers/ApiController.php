<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderProducts;

class ApiController extends Controller
{
    public function __construct()
    {
        date_default_timezone_set('Asia/Kolkata');
    }
    public function list_product()
    {
       try {
            $product= Product::where('status',"Active")->get();
            return response()->json([
                'success'   => 'success',
                'message'   => 'success',
                'statusCode'=> 200,
                'data'      => $product
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
