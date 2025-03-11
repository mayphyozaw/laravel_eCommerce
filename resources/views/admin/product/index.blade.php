@extends('admin.layout.master')
@section('content')
    <div class="container">
        <a href="{{ route('product.create') }}" class="btn btn-success" style="margin:15px;">All Products</a>

    </div>
    <hr>

    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-header bg-blue ">

                    </div>
                    <div>
                        <a href="{{ route('product.create') }}" class="btn btn-success border-0" style="margin:15px;">Create
                            Product</a>
                    </div>
                    <div class="card-body">

                        <table class="table table-stripe">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Remain Quantity</th>
                                    <th>Add or Remove</th>
                                    <th>Option</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $p)
                                    <tr>

                                        <td>
                                            <img src="{{ asset('/images/' . $p->image) }}" width="50" alt=""
                                                class="image-thumbnail">
                                        </td>
                                        <td>{{ $p->name }}</td>
                                        <td>{{ $p->total_qty }}</td>
                                        <td>
                                            <a href="{{ route('create-product-remove', $p->slug) }}"
                                                class="btn btn-sm btn-warning">-</a>
                                            <a href="{{ route('create-product-add', $p->slug) }}"
                                                class="btn btn-sm btn-warning">+</a>
                                        </td>
                                        <td>

                                            <form action="{{ route('product.destroy', $p->slug) }}" method="POST"
                                                onSubmit="return confirm('Are you sure to delete?')">
                                                <a href="{{ route('product.edit', $p->slug) }}"
                                                    class="btn btn-sm btn-primary border-0">Edit</a>
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-sm btn-danger border-0">
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="pt-2">
                    {{ $products->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
