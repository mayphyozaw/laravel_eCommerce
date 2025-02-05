@extends('admin.layout.master')
@section('content')
    <h2>
        Add For
        <b class="text-danger">{{ $product->name }}</b>
    </h2>
    <div>
        <a href="{{ route('product.index') }}">All Products</a>
    </div>
    <hr>

    <form action="{{ route('create-product-add', $product->slug) }}" method="Post">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Choose Supplier</label>
                        <select name="supplier_id" class="form-control">
                            @foreach ($supplier as $s)
                                <option value="{{ $s->id }}">{{ $s->name }}</option>
                            @endforeach
                        </select>

                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Total Quantity</label>
                        <input type="number" name="total_qty" class="form-control">
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Enter Description</label>
                        <textarea name="description" id="description" class="form-control"></textarea>
                    </div>
                </div>
                <input type="submit" value="Add" class="btn btn-primary border-0">

            </div>
        </div>

    </form>
@endsection
