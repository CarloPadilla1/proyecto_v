<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Hola</title>
    @vite('resources/css/app.css')
</head>
<body class="base_blade_1" >
     <div>
        <a hidden href="{{route('crear.superadmin')}}">Ver usuarios</a>
        
        <section class="base_form rounded container ">
            <form  action="{{route('login')}}" method="GET" >
                @csrf
                <h1 class="text-center pt-2">Iniciar sesión</h1>
                <div class="mt-3">
                    <label for="name_user" class="form-label">Ingrese el Nombre del Usuario</label>
                    <div class="d-flex">
                        <div class="my-auto me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                                <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                            </svg>
                        </div>
                        <input type="text" class="form-control " name="name_user">
                    </div>
                </div>
                <div class="mt-3">
                    <label for="password" class="form-label">Ingrese la contraseña</label>
                    <div class="d-flex">
                        <div class="me-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="26" height="24" fill="currentColor" class="bi bi-lock-fill" viewBox="0 0 16 16">
                                <path d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z"/>
                              </svg>
                        </div>
                        <input type="password" class="form-control" name="password">
                    </div>
                </div>
                <div class="d-flex justify-content-center mt-3 mb-2 "><button type="submit" class="btn btn-primary">Iniciar sesión</button></div>
            </form>
        </section>

        @if($errors->has('message'))
        <div class="alert alert-danger mt-5" style="position: absolute; top: 0px">
            {{ $errors->first('message') }}
        </div>
        @endif
    </div> 

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
