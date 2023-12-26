<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\TypeUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    //
    public function createUser(){
         $user =User::create([
             'name_user'=>'Administrador_Vinicio',
             'password'=>bcrypt('DPSangelita89'),
             'id_type_user'=> 1
         ]);
        $user = User::with('typeUser')->get();
        dd($user);
    }
    //login de todos los usuarios
    public function userLogin(Request $request){
        $credentials = $request->only('name_user', 'password');

        if (Auth::attempt($credentials)) {
            // El usuario ha iniciado sesión
            return redirect()->route('home'); // Puedes redirigir a la página que desees después del inicio de sesión exitoso
            //return response()->json(['message' => 'Inicio de sesión exitoso', 'redirect' => route('auth.home')]);
            //return response()->json(['message' => 'Inicio de sesión exitoso', 'redirect' => route('auth.home')]);
        
        }
        // El inicio de sesión falló
        return back()->withErrors([
            'message' => 'Credenciales inválidas, por favor, inténtalo de nuevo.'
        ]);
    }
    
    public function userLogout(){
        Auth::logout();
        return redirect()->route('welcome');
    }
    public function viewRegister(){
        $type_users = TypeUser::get();
        //return view('auth.register',['type_users' => $type_users]);
        return response()->json([   'view' => view('auth.register', ['type_users' => $type_users])->render(),]);

    }
    public function userRegister(RegisterRequest $request){
        $user = new User([
            'name_user' => $request->input('name_user'),
            'password' => bcrypt($request->input('password')),
            'id_type_user' => $request->input('id_type_user')
        ]);
        
        // Guardar el usuario en la base de datos
        $user->save();
        return redirect()->route('home')->with('success', '¡Usuario registrado con éxito!');
    }
    public function getAllUsersForFilter(){
        $users = User::select('id_user','name_user')->get();
        return response()->json(['success'=>true, 'users_for_filter'=>$users]);
    }
}
