@extends('layout')

@section('content')

<div class="show">

    <p><strong>Product Name:</strong> {{ $product->name }}</p>

    <p><strong>Product ID:</strong> {{ $product->product_id }}</p>

    <p><strong>Description:</strong> {{ $product->description }}</p>

    <p><strong>Price:</strong> {{ $product->price }}</p>

    <p><strong>Stock:</strong> {{ $product->stock }}</p>

    <p><strong>Image: </strong></p>

    @if ($product->image)
        <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" style="width:80px;height:80px">
    @endif
</div>

  <div class="button-back">
    <a href="{{ route('products.index') }}" class="back-btn">Back to Products</a>
   </div>

@endsection
