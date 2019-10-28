@extends('adminlte::page')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<h1>Category list:</h1>
<a href="/admin/categories/create" class="btn btn-primary">Create</a>
<hr>

<table id="category-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Parent</th>
            <th>Created by</th>
            <th>Updated at</th>
            <th>Created at</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
            <tr>
                <td>{{ $category->name }}</td>
                <td>{{ $category->parent->name ?? '' }}</td>
                <td>{{ $category->user->name }}</td>
                <td>{{ $category->updated_at }}</td>
                <td>{{ $category->created_at }}</td>
                <td>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </div>

                        <div class="col-md-3">
                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-sm btn-danger">
                                            {{ __('Delete') }}
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection

@section('css')
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#category-table').DataTable({
                "order": [[ 5, "desc" ]]
            });
        } );
    </script>
@stop
