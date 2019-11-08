@extends('adminlte::page')

@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<h1>Product list:</h1>
<a href="/admin/products/create" class="btn btn-primary">Create</a>
<hr>

<table id="product-table" class="table table-striped table-bordered" style="width:100%">
    <thead>
        <tr>
            <th>Name</th>
            <th>Content</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Price</th>
            
            <th>Updated at</th>
            <th>Created at</th>
            <th>Operation</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->content }}</td>
                <td>{{ $product->category ? $product->category->name : '' }}</td>
                <td>{{ $product->quantity }}</td>
                <td>{{ $product->price }}</td>
                 
                <td>{{ $product->updated_at }}</td>
                <td>{{ $product->created_at }}</td>
                <td>
                    <div class="row">
                        <div class="col-md-3">
                            <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        </div>
                        <div class="col-md-2">
                            <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST">
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
            $('#product-table').DataTable({
                "order": [[ 7, "desc" ]]
            });
        } );
    </script>
@stop
