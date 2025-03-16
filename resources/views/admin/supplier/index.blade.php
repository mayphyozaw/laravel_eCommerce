@extends('admin.layout.master')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-header bg-info text-white ">
                        <h6 style="font-size:14px; font-weight:bold;">Supplier</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-4 d-flex align-items-center">
                                <form action="" method="get" class="search-form" style="margin:10px;">
                                    <div class="input-group">

                                        <input type="search" class="form-control" type="text">
                                        <span class="input-group-btn">
                                            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                                    class="fa fa-search"></i>
                                            </button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-8 d-flex justify-content-end">
                                <a href="{{ route('supplier.create') }}" class="btn btn-success border-0"
                                    style="margin:15px;">Create
                                    Supplier</a>
                            </div>

                        </div>
                        <table class="table table-stripe">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>Description</th>
                                    <th>OPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($supplier as $s)
                                    <tr>
                                        <td><img src="{{ asset('/images/' . $s->image) }}" width="50" alt=""
                                                class="image-thumbnail"></td>
                                        <td>{{ $s->name }}</td>
                                        <td>{{ $s->description }}</td>
                                        <td>
                                            {{ $s->slug }}
                                            <form action="{{ route('supplier.destroy', $s->id) }}" method="POST"
                                                onSubmit="return confirm('Are you sure to delete?')">
                                                <a href="{{ route('supplier.edit', $s->id) }}"
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
                    {{ $supplier->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
