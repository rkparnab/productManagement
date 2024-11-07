@extends('layout')

@section('content')
    <h1 class="edit-content">Edit Product Management</h1>

    <form method="POST" action="{{ route('products.update', $product->id) }}">
        @csrf
        @method('PUT')
        <div class="edit">
        <label for="name">Name:</label>
        <input type="text" name="name" value="{{ $product->name }}" required>

        <label for="description">Description:</label>
        <textarea name="description">{{ $product->description }}</textarea>

        <label for="price">Price:</label>
        <input type="number" name="price" value="{{ $product->price }}" required>

        <label for="stock">Stock:</label>
        <input type="number" name="stock" value="{{ $product->stock }}">

        <label for="image">Image:</label>
        <input type="file" name="image" value="{{ $product->image }}">


        <button type="submit">Update</button>
        </div>
    </form>
@endsection
