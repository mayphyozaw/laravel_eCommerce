@extends('admin.layout.master')
@section('content')
    <div class="content">
        <div>
            <a href="{{ route('product-add-transaction') }}" class="btn btn-outline-success">Add Transaction</a>
            <a href="{{ route('product-remove-transaction') }}" class="btn btn-outline-success">Remove Transaction</a>
        </div>
        <hr>

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-header bg-blue ">

                    </div>

                    <div class="card-body">

                        <table class="table table-stripe">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Total Quantity</th>
                                    <th>Description</th>
                                    <th>Purchase Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactions as $t)
                                    <tr>
                                        <td>
                                            <img src="{{ asset('/images/' . $t->product->image) }}" style="width:100px"
                                                alt="" class="img-thumbnail">
                                        </td>
                                        <td>
                                            {{ $t->product->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $t->total_qty }}
                                        </td>
                                        <td>
                                            {!! $t->description !!}
                                        </td>
                                        <td>
                                            {{ $t->created_at }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pt-2">
                    {{ $transactions->links() }}
                </div>
            </div>
        </div>
        {{-- {{ $transactions->links() }} --}}
    </div>
@endsection
