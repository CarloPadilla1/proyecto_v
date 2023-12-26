<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Categorias</title>
</head>
<body>
    @foreach($categories as $category)
        <h3>Nombre de la categoría: {{ $category->name_category }}</h3>
        <p>Descripción: {{ $category->description }}</p>

        <form action="{{ route('delete.category', ['id_category' => $category->id_category]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('¿Seguro que quieres eliminar esta categoría?')">Eliminar</button>
        </form>

        <button type="button" onclick="toggleEditForm('{{ $category->id_category }}')">Editar</button>

        <form id="editForm{{ $category->id_category }}" style="display: none;" action="{{ route('update.category', ['id_category' => $category->id_category]) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name_category">Nuevo Nombre de la categoría</label>
                <input type="text" name="name_category" value="{{ $category->name_category }}">
            </div>
            <div>
                <label for="description">Nueva Descripción</label>
                <input type="text" name="description" value="{{ $category->description }}">
            </div>
            <button type="submit">Guardar Cambios</button>
        </form>
    @endforeach

    <form action="{{ route('create.category') }}" method="POST">
        @csrf
        <h1>Crear Categoría</h1>
        <div>
            <label for="name_category">Categoría</label>
            <input type="text" name="name_category">
        </div>
        <div>
            <label for= "description">Descripción</label>
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