<h1>Previsualización de la Orden</h1>

<table>
    <thead>
        <tr>
            <th>Producto</th>
            <th>Cantidad</th>
            <th>Monto por Línea</th>
        </tr>
    </thead>
    <tbody>
        <?php $total_amount = 0; ?> <!-- Inicializamos la variable -->
        <form action="" method="POST">
            @foreach($orderLines as $orderLine)
                <?php $total_amount += $orderLine['amount_line'] ; ?>
                <tr>
                    <td>{{ $orderLine['product']->name_product }}</td>
                    <td>{{ $orderLine['quantity'] }}</td>
                    <td>{{ $orderLine['amount_line'] }}</td>
                </tr>
            @endforeach
        </form>
    </tbody>
</table>

<div>
    Precio Total de la Orden: {{$total_amount}}
</div>