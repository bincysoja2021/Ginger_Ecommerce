<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUsers implements FromCollection,WithHeadings
{

    protected $id;

    function __construct($id) {
        $this->id = $id;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Order::select(
            'order.id',
            'order.order_id',
            'order.cust_name',
            'order.phone',
            'order.total_amount as total',
            'order.order_date',
            'order.status',
            'product.name as pname',
            'orderproducts.total_amount',
            'orderproducts.qty'
        )
        ->join('orderproducts', 'orderproducts.order_id', 'order.id')
        ->join('product', 'product.id', 'orderproducts.product')
        ->where('order.id',$this->id)->get();
    }
     public function headings(): array
    {
        return ["ID", "Orderid","Name",'Phone','Netamount','Order Date','Status','product','total_amount','qty'];
    }
}
