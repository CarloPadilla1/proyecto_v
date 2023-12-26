


    <h1>Lista de Productos</h1>

    <h1>Lista de Productos</h1>

    <form action="{{ route('preview.order') }}" method="POST">
        @csrf

        <table>
            <thead>
                <tr>
                    <th>Nombre del Producto</th>
                    <th>Precio de Compra</th>
                    <th>Cantidad</th>
                    <th>Seleccionar</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->name_product }}</td>
                        <td>{{ $product->inventory->purchase_price }}</td>
                        <td>
                            <input type="number" name="cantidad[{{ $product->id_product }}]" min="0" max="100" value="1">
                        </td>
                        <td>
                            <input type="checkbox" name="products[]" value="{{ $product->id_product }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit">Generar Orden</button>
    </form>
