@extends('layout')

@section('content')
    <h1>Create Product Management</h1>

    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data" >
        @csrf
    <div class="pro-id">
        <label for="product_id">Product ID:</label>
        <input type="text" name="product_id" required>
    </div>

       <div class="name">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
    </div>

    <div class="descript">
        <label for="description">Description:</label>
        <textarea name="description"></textarea>
    </div>

    <div class="price">
        <label for="price">Price:</label>
        <input type="number" name="price" required>
    </div>

    <div class="stock">
        <label for="stock">Stock:</label>
        <input type="number" name="stock">
    </div>

    <div class="image">
        <label for="image">Image:</label>
        <input type="file" name="image">
    </div>

    <div class="submit-btn">
        <button type="submit">Create</button>
    </div>
    </form>

@endsection
