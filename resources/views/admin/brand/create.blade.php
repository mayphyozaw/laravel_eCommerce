@extends('admin.layout.master')
@section('content')
    <div class="">
        <a href="{{ route('brand.index') }}" class="btn btn-dark" style="margin:15px;">All Brands</a>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header bg-blue ">
                            <h5 class="text-white m-b-0">Create Form</h5>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('brand.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Enter Brand Name</label>
                                    <input type="text" class="form-control" name="name">
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
