<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Productos</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Nombre del Producto</th>
                <th>Precio de Compra</th>
                <th>Precio de Venta</th>
                <th>Stock</th>
                <th>Categoriass</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{ $product->name_product }}</td>
                    <td>{{ $product->inventory->purchase_price }}</td>
                    <td>{{ $product->inventory->sale_price }}</td>
                    <td>{{ $product->inventory->stock }} {{$product->inventory->measurement->measurement}}</td>
                    <td>@foreach ($product->categories as $category)
                        {{$category->name_category}}
                    @endforeach</td>
                    <td>
                        <form action="{{ route('delete.product', ['id_product' => $product->id_product]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este producto?')">Eliminar</button>
                        </form>
                        <button type="button" onclick="toggleEditForm('{{ $product->id_product }}')">Editar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    @foreach($products as $product)
        <form id="editForm{{ $product->id_product }}" style="display: none;" action="{{ route('update.product', ['id_product' => $product->id_product]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name_product">Nuevo Nombre del Producto</label>
                <input type="text" name="name_product" value="{{ $product->name_product }}">
            </div>
            <div>
                <label for="description">Nueva Descripción</label>
                <input type="text" name="description" value="{{ $product->description }}">
            </div>
            <div>
                <label for="id_brand">Nueva Marca</label>
                <select name="id_brand">
                    @foreach($brands as $brand)
                        <option value="{{ $brand->id_brand }}" {{ $brand->id_brand == $product->id_brand ? 'selected' : '' }}>{{ $brand->name_brand }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="id_provider">Nuevo Proveedor</label>
                <select name="id_provider">
                    @foreach($providers as $provider)
                        <option value="{{ $provider->id_provider }}" {{ $provider->id_provider == $product->id_provider ? 'selected' : '' }}>{{ $provider->name_provider }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="id_category">Nueva Categoría</label>
                <select name="id_category[]" multiple>
                    @foreach($categories as $category)
                        <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
                    @endforeach
                </select>
            </div>
            
            <div>
                <label for="purchase_price">Nuevo Precio de Compra</label>
                <input type="number" name="purchase_price" step="0.01" value="{{ $product->inventory->purchase_price }}">
            </div>
            <div>
                <label for="sale_price">Nuevo Precio de Venta</label>
                <input type="number" name="sale_price" step="0.01" value="{{ $product->inventory->sale_price }}">
            </div>
            <div>
                <label for="stock">Nuevo Stock</label>
                <input type="number" name="stock" value="{{ $product->inventory->stock }}">
            </div>
            <div>
                <label for="id_measurements">Nueva Medida</label>
                <select name="id_measurements">
                    @foreach($measurements as $measurement)
                        <option value="{{ $measurement->id_measurements }}" {{ $measurement->id_measurements == $product->id_measurements ? 'selected' : '' }}>{{ $measurement->measurement }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    @endforeach

    <h1>Crear Producto</h1>
    <form action="{{ route('create.product') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name_product">Nombre del Producto</label>
            <input type="text" name="name_product">
        </div>
        <div>
            <label for="description">Descripción</label>
            <textarea name="description"></textarea>
        </div>
        <div>
            <label for="id_brand">Marca</label>
            <select name="id_brand">
                @foreach($brands as $brand)
                    <option value="{{ $brand->id_brand }}">{{ $brand->name_brand }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_provider">Proveedor</label>
            <select name="id_provider">
                @foreach($providers as $provider)
                    <option value="{{ $provider->id_provider }}">{{ $provider->name_provider }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="id_category">Categoría</label>
            <select name="id_category[]" multiple>
                @foreach($categories as $category)
                    <option value="{{ $category->id_category }}">{{ $category->name_category }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="purchase_price">Precio de Compra</label>
            <input type="number" name="purchase_price" step="0.01">
        </div>
        <div>
            <label for="sale_price">Precio de Venta</label>
            <input type="number" name="sale_price" step="0.01">
        </div>
        <div>
            <label for="stock">Stock</label>
            <input type="number" name="stock">
        </div>
        <div>
            <label for="id_measurements">Medida</label>
            <select name="id_measurements">
                @foreach($measurements as $measurement)
                    <option value="{{ $measurement->id_measurements }}">{{ $measurement->measurement }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit">Crear Producto</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <script>
        function toggleEditForm(id) {
            const form = document.getElementById('editForm' + id);
            form.style.display = form.style.display === 'none' ? 'block' : 'none';
        }
    </script>
</body>
</html>