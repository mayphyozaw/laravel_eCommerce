@extends('admin.layout.master')
@section('content')
    <div class="">
        <a href="{{ route('supplier.index') }}" class="btn btn-dark" style="margin:15px;">All Supplier</a>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header bg-blue ">
                            <h5 class="text-white m-b-0">Edit Form</h5>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('supplier.update', $s->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Enter Category Name</label>
                                    <input type="text" class="form-control" value="{{ $s->name }}" name="name">
                                </div>

                                <div class="form-group">
                                    <input type="file" class="form-control" name="image">
                                    <label for="">Choose Image </label>
                                    <img src="{{ asset('/images/' . $s->image) }}" width="100" alt=""
                                        class="image-thumbnail">
                                </div>

                                <div class="form-group">
                                    <label for="">Enter Description </label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $s->description }}</textarea>

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
