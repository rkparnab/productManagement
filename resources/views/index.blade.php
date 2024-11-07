@extends('layout')

@section('content')
    <h1 class="product-content">Products Management</h1>


    <form method=" GET" action="{{ route('products.index') }}">
        <div class="product-form">
        <input type="text" name="search" placeholder="Search by Product ID or Description" value="{{ request('search') }}">
        <button type="submit" class="product-btn">Search</button>
    </div>
    </form>


    <table>
        <thead>
            <tr>
                <th><a href="{{ route('products.index', ['sort_by' => 'name']) }}">Name</a></th>

                <th><a href="{{ route('products.index', ['sort_by' => 'product_id']) }}">ProductId</a></th>

                <th><a href="{{ route('products.index', ['sort_by' => 'price']) }}">Price</a></th>

                <th><a href="{{ route('products.index', ['sort_by' => 'stock']) }}">Stock</a></th>


                <th><a href="{{ route('products.index', ['sort_by' => 'description']) }}">Descriptions</a></th>

                <th><a href="{{ route('products.index', ['sort_by' => 'image']) }}">Image</a></th>

                <th><a href="">Action</a></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->product_id }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                     <td>{{ $product->description }}</td>
                    <td>

                        @if ($product->image)
                            <img src="{{ asset('images/' .$product->image)}}" alt="" style="width:80px;height:80px">
                        @else
                            No Image
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="view-button">View</a>

                        <a href="{{ route('products.edit', $product->id) }}" class="edit-button">Edit</a>

                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="pagination">
        {{ $products->links() }}
    </div>

@endsection
