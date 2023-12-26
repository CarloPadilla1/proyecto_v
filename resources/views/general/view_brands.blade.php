<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ver Marcas</title>
</head>
<body>
    @foreach($brands as $brand)
    <h3>Nombre de la marca: {{ $brand->name_brand }} </h3>
    <p>Descripción: {{ $brand->description }}</p>
    <form action="{{ route('delete.brand', ['id_brand' => $brand->id_brand]) }}" method="POST"> 
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar esta marca?')">Eliminar</button>
    </form>
    <button type="button" onclick="toggleEditForm('{{ $brand->id_brand }}')">Editar</button>

    <form id="editForm{{ $brand->id_brand }}" style="display: none;" action="{{ route('update.brand', ['id_brand' => $brand->id_brand]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name_brand">Nuevo Nombre de la marca</label>
            <input type="text" name="name_brand" value="{{ $brand->name_brand }}">
        </div>
        <div>
            <label for="description">Nueva Descripción</label>
            <input type="text" name="description" value="{{ $brand->description }}">
        </div>
        <button type="submit">Guardar Cambios</button>
    </form>
    
    @endforeach
    <form action="{{ route('create.brand') }}" method="POST">
        @csrf
        <h1>Crear Marca</h1>
        <div>
            <label for="name_brand">Marca</label>
            <input type="text" name="name_brand">
        </div>
        <div>
            <label for="description">Descripcion</label>
            <input type="text" name="description">
        </div>
        <button type="submit">Crear</button>
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