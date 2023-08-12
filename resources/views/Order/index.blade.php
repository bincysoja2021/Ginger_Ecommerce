@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" >
</head>
<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('home') }}"> Back to Home</a>
                </div>
                <div class="pull-left">
                    <h2>Order Management</h2>
                </div>
            </div>
        </div>
        @if ($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Order ID</th>
                    <th>Customer Name</th>
                    <th>Phone</th>
                    <th>Net Amount</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $key=>$orders)
                    <tr>
                    	<td>{{ $key + 1 }}</td>
                        <td>{{ $orders->order_id }}</td>
                        <td>{{ ucfirst($orders->cust_name) }}</td>
                        <td>{{ $orders->phone }}</td>
                        <td>{{ $orders->total_amount }}</td>
                        <td> {{ $orders->order_date }}</td>
                        <td>  
                            <select onchange="datachangestatus(this,<?php echo $orders->id?>)"> 
                                <option value="Waiting for confirmation" {{ ($orders->status == "Waiting for confirmation") ? 'selected' : '' }}>Waiting for confirmation</option>
                                <option value="Cancelled" {{ ($orders->status == "Cancelled") ? 'selected' : '' }}>Cancelled</option>
                                <option value="Order Confirmed" {{ ($orders->status == "Order Confirmed") ? 'selected' : '' }}>Order Confirmed</option>
                            </select></td>
                        <td>
                            <form action="{{ route('order_destroy',$orders->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('order_edit',$orders->id) }}">Edit</a>
                                <a class="btn btn-secondary" href="{{ route('order_invoice',$orders->id) }}">Invoice</a>
                                <a class="btn btn-warning" href="{{ route('export',$orders->id) }}">Export CSV</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        {!! $order->links() !!}
    </div>
<script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>


<script type="text/javascript">
    function datachangestatus(sel,id)
    {
        var status=sel.value;
        var id=id;
        $.ajax
        ({
            type: "POST",
            url: "{{url('/change_status')}}",
            data: {
            "_token": "{{ csrf_token() }}",
            "status":status,
            "id":id
            },
            cache: false,
            success: function(data)
            {
              window.location.reload();
            } 
        });
    }
 
</script>

    
</body>
</html>

@endsection
