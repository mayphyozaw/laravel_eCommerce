@extends('admin.layout.master')
@section('content')
    <div class="">
        <a href="{{ route('income.index') }}" class="btn btn-dark" style="margin:15px;">All Income Lists</a>
        <div class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-outline">
                        <div class="card-header bg-blue ">
                            <h5 class="text-white m-b-0">Update Form</h5>

                        </div>
                        <div class="card-body">
                            <form action="{{ route('income.update', $income->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="">Enter Title </label>
                                    <input type="text" class="form-control" name="title" value="{{ $income->title }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Amount</label>
                                    <input type="integer" class="form-control" name="amount" value="{{ $income->amount }}">
                                </div>
                                <div class="form-group">
                                    <label for="">Enter Description </label>
                                    <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ $income->description }}</textarea>

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
