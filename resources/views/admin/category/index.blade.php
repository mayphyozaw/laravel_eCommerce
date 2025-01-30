@extends('admin.layout.master')
@section('content')
    <div class="content">

        <div class="row">
            <div class="col-lg-12">
                <div class="card card-outline">
                    <div class="card-header bg-blue ">

                    </div>
                    <div>
                        <a href="{{ route('category.create') }}" class="btn btn-success border-0" style="margin:15px;">Create
                            Category</a>
                    </div>
                    <div class="card-body">

                        <table class="table table-stripe">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($category as $c)
                                    <tr>
                                        <td>{{ $c->name }}</td>
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
            </div>
        </div>

    </div>
    {{ $category->links() }}
@endsection
