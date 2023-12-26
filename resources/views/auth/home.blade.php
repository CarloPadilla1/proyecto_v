<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-87">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home</title>
</head>
<body style="background-color: #151f19b3">
    <div id="app">

    </div>

<br>

        <div hidden>
            
                <a href="{{route('logout')}}">Logout</a> ---
                <a href="{{route('view.register')}}">Registrar Usuario</a> ---
                {{-- <a href="{{route('view.brands')}}">Ver Marcas</a>  ---  --}}
                {{-- <a href="{{route('view.categories')}}">Ver Categorias</a> --- --}}
                {{-- <a href="{{route('view.providers')}}">Ver Proveedores</a> --- --}}
            
                {{-- <a href="{{route('view.products')}}">Ver Productos</a> --- --}}
            
                <h1>Bienvenido {{Auth::user()->name_user}} - {{ Auth::user()->typeUser->type_user }}</h1>
                @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>



                @endif
        </div>

    {{-- @if ($products->count() > 0)
    <h2>Lista de Productos</h2>
    @foreach ($products as $product)
        <strong>Nombre: {{ $product->name_product }}</strong>
        <p>Descripción: {{ $product->description }}</p>
        <p>Categorías:
        @foreach ($product->categories as $category)
                        {{$category->name_category}}
        @endforeach</p>
        <p>Proveedor: {{ $product->provider->name_provider }}</p>
        <p>Marca: {{ $product->brand->name_brand }}</p>
        <p>Stock: {{ $product->inventory->stock }} {{ $product->inventory->measurement->measurement }}</p>
        <p>Valor de compra: {{ $product->inventory->purchase_price }}</p>
        <p>Valor de venta: {{ $product->inventory->sale_price }}</p>
        <p>Fecha: {{ $product->inventory->updated_at}}</p>
    @endforeach

    {{ $products->links() }}
@else
    <p>No hay productos disponibles.</p>
@endif --}}

<br>

@vite('resources/js/app.js')
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>

</body>
</html>