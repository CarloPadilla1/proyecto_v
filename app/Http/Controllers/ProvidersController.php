<?php

namespace App\Http\Controllers;

use App\Models\Providers;
use Illuminate\Http\Request;

class ProvidersController extends Controller
{
    //
    public function viewProviders(Request $request){
        $search = $request->query('search');
        $providers = Providers::when($search, function($query) use($search){
            $query->Where('name_provider', 'LIKE', '%' . $search . '%');
        })->get();
        return response()->json(['providers' => $providers]);
        //return view('general.view_providers',['providers'=>$providers]);
    }
    public function createProvider(Request $request){
        $request->validate([
            'name_provider' => 'required|string|max:255',
            'description' => 'required|string',
        ],
        //mensajes
        [
            'name_provider.required' => 'El nombre del proveedor es obligatorio.',
            'name_provider.string' => 'El nombre del proveedor debe ser una cadena de texto.',
            'name_provider.max' => 'El nombre del proveedor no puede exceder los 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.'
        ]);
        $brand = new Providers([
            'name_provider' => $request->input('name_provider'),
            'description' => $request->input('description'),
        ]);
        $brand->save();
        //return redirect()->back()->with('success', 'Proveedor creado exitosamente');
    }
    public function updateProvider(Request $request, $id_provider)
    {
        $provider = Providers::find($id_provider);

        if ($provider) {
            $request->validate([
                'name_provider' => 'required|string|max:255|',
                'description' => 'required|string',
            ], [
                'name_provider.required' => 'El nombre del proveedor es obligatorio.',
                'name_provider.string' => 'El nombre del proveedor debe ser una cadena de texto.',
                'name_provider.max' => 'El nombre del proveedor no puede exceder los 255 caracteres.',
                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser una cadena de texto.'
            ]);

            $provider->update([
                'name_provider' => $request->input('name_provider'),
                'description' => $request->input('description'),
                // Otras columnas a actualizar...
            ]);

            //return redirect()->route('view.providers')->with('success', 'Proveedor actualizado con éxito');
        } else {
            //return redirect()->route('view.providers')->with('error', 'No se encontró el proveedor a actualizar');
        }
    }

    public function deleteProvider($id_provider)
    {
        try 
        {
            $provider = Providers::find($id_provider);
    
            if ($provider) {
                $name = $provider->name_provider;
                // Elimina el proveedor y cualquier otro registro relacionado según tu estructura de base de datos.
                $provider->delete();
                return response()->json(['success' => true, 'message'=> 'Se ha eliminado el proveedor'.$name]);
            } else {
                return response()->json(['success'=>false,'message' => 'No se encontró el proveedor a eliminar']);
            }
        } 
        catch (\Illuminate\Database\QueryException $e) 
        {
            if($e->getCode()=="23000") {
                return response()->json(['success'=>false,'message' => 'Hay productos relacionadas con este proveedor, favor de eliminarlas primero']);
            } else {
                // Manejo de otros errores si es necesario
                return response()->json(['success'=>false,'message' => 'Error al intentar eliminar el proveedor']);
            }
        }
    }
}
