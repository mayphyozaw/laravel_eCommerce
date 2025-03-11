@extends('admin.layout.master')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-header bg-info text-white ">
                        <h6 style="font-size:14px; font-weight:bold;">Income Lists</h6>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 d-flex py-3">
                                <a href="{{ route('income.create') }}" class="btn btn-success border-0 mr-4">Create Income
                                </a>

                                <button class="btn btn-outline-warning">
                                    Today Income: {{ $todayIncome }}ks
                                </button>
                            </div>
                        </div>
                        <table class="table table-stripe">
                            <thead class="bg-info text-white">
                                <tr>
                                    <th>Title</th>
                                    <th>Amount</th>
                                    <th>Description</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($income as $i)
                                    <tr>
                                        <td>{{ $i->title }}</td>
                                        <td>{{ $i->amount }}ks</td>
                                        <td>{{ $i->description }}</td>

                                        <td>

                                            <form action="{{ route('income.destroy', $i->id) }}" method="POST"
                                                onSubmit="return confirm('Are you sure to delete?')">
                                                <a href="{{ route('income.edit', $i->id) }}"
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
                    {{-- {{ $income->links() }} --}}
                </div>
            </div>
        </div>

    </div>
@endsection
