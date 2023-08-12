@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Order Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-2">
        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-left">
                    <h2>Edit Order</h2>
                </div>
                <div class="pull-right">
                    <a class="btn btn-primary" href="{{ route('list_order') }}" enctype="multipart/form-data">
                        Back</a>
                </div>
            </div>
        </div>
        @if(session('status'))
        <div class="alert alert-success mb-1 mt-1">
            {{ session('status') }}
        </div>
        @endif
        <form action="{{ route('order_update',$order->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('GET')
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Customer Name:</strong>
                        <input type="text" name="name" value="{{ $order->cust_name }}" class="form-control"
                            placeholder="Customer name" autocomplete="off">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Status:</strong>
                           <select name="status" class="form-control">
                                <option value="Waiting for confirmation" {{ ($order->status == "Waiting for confirmation") ? 'selected' : '' }}>Waiting for confirmation</option>
                                <option value="Cancelled" {{ ($order->status == "Cancelled") ? 'selected' : '' }}>Cancelled</option>
                                <option value="Order Confirmed" {{ ($order->status == "Order Confirmed") ? 'selected' : '' }}>Order Confirmed</option>
                            </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Phone number:</strong>
                        <input type="tel" name="phone" class="form-control" placeholder="Phone number" value="{{ $order->phone}}" autocomplete="off">
                        @error('phone')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <table class="table table-bordered my-2" id="dynamicAddRemove">
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                        </tr>
                        @foreach($order_product as $key=>$productval)
                        <tr>
                            <td>
                                <select name="addMoreInputFields[{{$key}}][product]" class="form-control" style="pointer-events: none;">
                                    @foreach($products as $val)
                                    <option  value='{{ $val->id }}' {{ ($val->id == $productval->product) ? 'selected' : '' }}>{{ $val->name}}</option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="number" name="addMoreInputFields[{{$key}}][quantity]" placeholder="Enter quantity" class="form-control" min="1" value="{{$productval->qty}}" readonly/>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
</html>

@endsection
