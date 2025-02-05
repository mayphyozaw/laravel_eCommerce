@extends('admin.layout.master')
@section('content')
    <div class="container">
        <a href="{{ route('product.create') }}" class="btn btn-success" style="margin:15px;">Create Products</a>

    </div>
    <hr>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Image</th>
                {{-- <th>Description</th> --}}
                <th>Name</th>
                <th>Remain Quantity</th>
                <th>Add or Remove</th>
                <th>Option</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $p)
                <tr>
                    <td><img src="{{ asset('/images/' . $p->image) }}" style="width:100px" class="img-thumbnail" alt="">
                    </td>
                    {{-- <td style="color:red">{!! $p->description !!}</td> --}}
                    <td>{{ $p->name }}</td>
                    <td>{{ $p->total_qty }}</td>
                    <td>
                        <a href="{{ route('create-product-remove', $p->slug) }}" class="btn btn-sm btn-warning">-</a>
                        <a href="{{ route('create-product-add', $p->slug) }}" class="btn btn-sm btn-warning">+</a>
                    </td>
                    <td>

                        <form action="{{ route('product.destroy', $p->slug) }}" method="POST"
                            onSubmit="return confirm('Are you sure to delete?')">
                            <a href="{{ route('product.edit', $p->slug) }}" class="btn btn-sm btn-primary border-0">Edit</a>
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-sm btn-danger border-0">
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    {{ $products->links() }}
@endsection
