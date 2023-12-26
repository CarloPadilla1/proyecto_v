<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandsController extends Controller
{
    //
    public function viewBrands(Request $request){
        $search = $request->query('search');
        $brands = Brand::when($search, function ($query) use ($search){
            $query->Where('name_brand', 'LIKE','%' . $search . '%');
        })->get(); 
        return response()->json([
            'brands' => $brands,
        ]);

    }
    public function createBrand(Request $request){
        $request->validate([
            'name_brand' => 'required|string|max:255',
            'description' => 'required|string',
        ],
        //mensajes
        [
            'name_brand.required' => 'El nombre de la marca es obligatorio.',
            'name_brand.string' => 'El nombre de la marca debe ser una cadena de texto.',
            'name_brand.max' => 'El nombre de la marca no puede exceder los 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.'
        ]);
        $brand = new Brand([
            'name_brand' => $request->input('name_brand'),
            'description' => $request->input('description'),
        ]);
        $brand->save();
        //return redirect()->back()->with('success', 'Marca creada exitosamente');
    }
    public function updateBrand(Request $request, $id_brand)
    {
        $brand = Brand::find($id_brand);

        if ($brand) {
            $request->validate([
                'name_brand' => 'required|string|max:255',
                'description' => 'required|string',
            ], [
                'name_brand.required' => 'El nombre de la marca es obligatorio.',
                'name_brand.string' => 'El nombre de la marca debe ser una cadena de texto.',
                'name_brand.max' => 'El nombre de la marca no puede exceder los 255 caracteres.',
                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser una cadena de texto.'
            ]);

            $brand->update([
                'name_brand' => $request->input('name_brand'),
                'description' => $request->input('description'),
                // Otras columnas a actualizar...
            ]);
            $updatedBrand = Brand::find($id_brand);
            return response()->json(['message' => 'Marca actualizada con éxito', 'brand' => $updatedBrand], 200);
            //return response()->json(['message' => 'Marca actualizada con éxito'], 200);
            return response()->json(['message' => 'Marca actualizada con éxito', 'brand' => $updatedBrand], 200);
            //return redirect()->route('view.brands')->with('success', 'Marca actualizada con éxito');
        } else {
            return response()->json(['error' => 'No se encontró la marca a actualizar'], 404);
            //return redirect()->route('view.brands')->with('error', 'No se encontró la marca a actualizar');
        }
    }
    public function deleteBrand($id_brand)
    {
        try 
        {
            $brand = Brand::find($id_brand);
    
            if ($brand) {
                $name = $brand->name;
                // Elimina la marca y cualquier otro registro relacionado según tu estructura de base de datos.
                $brand->delete();
                return response()->json(['success' => true, 'message'=> 'Se ha eliminado la marca '.$name]);
            } else {
                return response()->json(['success'=>false,'message' => 'No se encontró la marca a eliminar']);
            }
        } 
        catch (\Illuminate\Database\QueryException $e) 
        {
            if($e->getCode()=="23000") {
                return response()->json(['success'=>false,'message' => 'Hay productos relacionadas con esta marca, favor de eliminarlas primero']);
            } else {
                // Manejo de otros errores si es necesario
                return response()->json(['success'=>false,'message' => 'Error al intentar eliminar la marca']);
            }
        }
    }
}
