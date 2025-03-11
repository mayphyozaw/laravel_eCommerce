@extends('admin.layout.master')
@section('content')
    <div class="">
        <a href="{{ route('category.index') }}" class="btn btn-dark" style="margin:15px;">All Categories</a>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header bg-blue ">
                            <h5 class="text-white m-b-0">Edit Form</h5>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('category.update', $cat->slug) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Enter Category Name</label>
                                    <input type="text" class="form-control" value="{{ $cat->name }}" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Category Name(MM)</label>
                                    <input type="text" class="form-control" value="{{ $cat->mm_name }}" name="mm_name">
                                </div>
                                <div class="form-group">
                                    <input type="file" class="form-control" name="image">
                                    <label for="">Choose Image </label>
                                    <img src="{{ asset('/images/' . $cat->image) }}" width="100" alt=""
                                        class="image-thumbnail">
                                </div>

                                <input type="submit" class="btn btn-success" value="Update"
                                    class="btn btn-primary border-0">
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.content -->
    </div>
@endsection
