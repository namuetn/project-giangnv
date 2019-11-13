@extends('adminlte::page')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<h1>Product list:</h1>

<hr>

<table id="user-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->role }}</td>
                <td>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-sm btn-primary">Edit</a>
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
            $('#user-table').DataTable({
                "order": [[ 5, "desc" ]]
            });
        } );
    </script>
@stop
