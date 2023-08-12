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
        return Order::with('productid')->select('id','order_id','cust_name','phone','total_amount','order_date','status')->where('id',$this->id)->get();
    }
     public function headings(): array
    {
        return ["ID", "Orderid","Name",'Phone','Netamount','Order Date','Status'];
    }
}
