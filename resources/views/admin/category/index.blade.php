@extends('admin.layout.master')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-header bg-info text-white ">
                        <h6 style="font-size:14px; font-weight:bold;">Category</h6>
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
                                <a href="{{ route('category.create') }}" class="btn btn-success border-0"
                                    style="margin:15px;">Create
                                    Category</a>
                            </div>

                        </div>
                        <table class="table table-stripe">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>IMAGE</th>
                                    <th>NAME</th>
                                    <th>NAME(MM)</th>
                                    <th>OPTION</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                    <tr>
                                        <td><img src="{{ asset('/images/' . $c->image) }}" width="50" alt=""
                                                class="image-thumbnail"></td>
                                        <td>{{ $c->name }}</td>
                                        <td>{{ $c->mm_name }}</td>
                                        <td>

                                            <form action="{{ route('category.destroy', $c->slug) }}" method="POST"
                                                onSubmit="return confirm('Are you sure to delete?')">
                                                <a href="{{ route('category.edit', $c->slug) }}"
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
                    {{ $category->links() }}
                </div>
            </div>
        </div>

    </div>
@endsection
