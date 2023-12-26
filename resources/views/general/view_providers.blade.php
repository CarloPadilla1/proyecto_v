<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Proveedor</title>
</head>
<body>
    @foreach($providers as $provider)
    <h3>Nombre del proveedor: {{ $provider->name_provider }}</h3>
    <p>Descripción: {{ $provider->description }}</p>

    <form action="{{ route('delete.provider', ['id_provider' => $provider->id_provider]) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar este proveedor?')">Eliminar</button>
    </form>

    <button type="button" onclick="toggleEditForm('{{ $provider->id_provider }}')">Editar</button>

    <form id="editForm{{ $provider->id_provider }}" style="display: none;" action="{{ route('update.provider', ['id_provider' => $provider->id_provider]) }}" method="POST">
        @csrf
        @method('PUT')
        <div>
            <label for="name_provider">Nuevo Nombre del proveedor</label>
            <input type="text" name="name_provider" value="{{ $provider->name_provider }}">
        </div>
        <div>
            <label for="description">Nueva Descripción</label>
            <input type="text" name="description" value="{{ $provider->description }}">
        </div>
        <button type="submit">Guardar Cambios</button>
    </form>
    @endforeach

    <form action="{{ route('create.provider') }}" method="POST">
        @csrf
        <h1>Crear Proveedor</h1>
        <div>
            <label for="name_provider">Proveedor</label>
            <input type="text" name="name_provider">
        </div>
        <div>
            <label for="description">Descripción</label>
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