@extends('admin.layout.master')
@section('content')
    <div class="">
        <a href="{{ route('supplier.index') }}" class="btn btn-dark" style="margin:15px;">All Suppiers</a>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header bg-blue ">
                            <h5 class="text-white m-b-0">Create Form</h5>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('supplier.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="">Enter Supplier Name</label>
                                    <input type="text" class="form-control" name="name">
                                </div>

                                <div class="form-group">
                                    <label for="">Choose Image </label>
                                    <input type="file" class="form-control" name="image">
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Description </label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>

                                </div>

                                <input type="submit" class="btn btn-success" value="Create"
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
