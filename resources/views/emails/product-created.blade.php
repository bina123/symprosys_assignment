<!DOCTYPE html>
<html>
<body>
    <h2>New product created</h2>
    <p>A new product has just been added:</p>
    <ul>
        <li><strong>ID:</strong> {{ $product->id }}</li>
        <li><strong>Name:</strong> {{ $product->name }}</li>
        <li><strong>Price:</strong> {{ $product->price }}</li>
        <li><strong>Category:</strong> {{ optional($product->category)->name }}</li>
    </ul>
    @if ($product->description)
        <p>{{ $product->description }}</p>
    @endif
</body>
</html>
