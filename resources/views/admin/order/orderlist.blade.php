@extends('admin.layout.master')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-header bg-info text-white ">
                        <h6 style="font-size:14px; font-weight:bold;">Order All</h6>
                    </div>
                    <div class="card-body">


                        <div class="row">
                            <div class="col-md-4 d-flex py-3">
                                <a href="{{ url('admin/order') }}" class="btn btn-dark btn-sm border-0 mr-4 ">
                                    All
                                </a>
                                <a href="{{ url('admin/order?status=success') }}"
                                    class="btn btn-success btn-sm border-0 mr-4">
                                    Success
                                </a>
                                <a href="{{ url('admin/order?status=pending') }}"
                                    class="btn btn-warning btn-sm border-0 mr-4">
                                    Pending
                                </a>
                                <a href="{{ url('admin/order?status=cancel') }}"
                                    class="btn btn-danger btn-sm border-0 mr-4">
                                    Cancel
                                </a>
                            </div>
                        </div>


                        <table class="table table-stripe">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>User Info</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order as $o)
                                    <tr>
                                        <td>
                                            <img src="{{ $o->product->image_url }}" width="40" alt="">
                                        </td>
                                        <td>{{ $o->product->name }}</td>
                                        <td>{{ $o->total_qty }}</td>
                                        <td>{{ $o->product->sale_price }}</td>
                                        <td>
                                            @if ($o->status === 'success')
                                                <span class="badge badge-success"> Success</span>
                                            @endif
                                            @if ($o->status === 'pending')
                                                <span class="badge badge-warning"> Pending</span>
                                            @endif
                                            @if ($o->status === 'cancel')
                                                <span class="badge badge-danger"> Cancel</span>
                                            @endif
                                        </td>
                                        <td>
                                            <table class="table border">
                                                <tr>
                                                    <td>Image</td>
                                                    <td>Name</td>
                                                    <td>Phone</td>
                                                    <td>Address</td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <img src="{{ $o->user->image_url }}" width="40" alt="">
                                                    </td>

                                                    <td>{{ $o->user->name }}</td>

                                                    <td>{{ $o->user->phone }}</td>

                                                    <td>{{ $o->user->address }}</td>

                                                </tr>
                                            </table>
                                        </td>
                                        <td>
                                            <a href="{{ url('/admin/changeOrder?id=' . $o->id . '&status=success') }}"
                                                class="btn btn-success btn-sm border-0">Success</a>
                                            @if ($o->status !== 'success')
                                                <a href="{{ url('/admin/changeOrder?id=' . $o->id . '&status=cancel') }}"
                                                    class="btn btn-danger btn-sm border-0">Cancel</a>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pt-2">
                    {{ $order->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
