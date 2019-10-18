@extends('layouts.shop')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<h1>Product show page</h1>
<a href="{{ route('products.edit', $product->id) }}">Edit</a>

<form action="{{ route('products.destroy', $product->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{ __('Delete') }}
            </button>
        </div>
    </div>
</form>

<h3>Name: {{ $product->name }}</h3>
<h3>Content: {{ $product->content }}</h3>
<h3>Quantity: {{ $product->quantity }}</h3>
<h3>Price: {{ $product->price }}</h3>
<h3>Created by: {{ $product->user ? $product->user->name : '' }}</h3>

@endsection
