<!DOCTYPE html>

<body>
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

        <div class="base_flex">
            <form action="{{route('register')}}" method="POST" class="base_register_supeadmin">
                @csrf
            {{-- hacer registro en bootstrap --}}
                <h1>Registro</h1>
                <label for="name_user">Username</label>
                <input type="text" name="name_user">
                <input type="password" name="password">
                <select name="id_type_user">
                    @foreach($type_users as $type_user)
                        <option value="{{ $type_user->id_type_user }}">{{ $type_user->type_user }}</option>
                    @endforeach
                </select>
                <button type="submit" >Registrar</button>
            </form>
        </div>

    @vite('resources/js/app.js')
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>    
</body>
</html>