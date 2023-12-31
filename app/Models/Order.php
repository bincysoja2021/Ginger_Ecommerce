<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table="order";
    protected $fillable = ['id','order_id','cust_name','phone','total_amount','order_date','status'];

    public function order_products()
    {
        return $this->belongsTo('App\Models\OrderProducts','id','order_id');
    } 

    public function productid()
    {
      return $this->belongsTo('App\Models\OrderProducts','id','order_id');  
    }


}
