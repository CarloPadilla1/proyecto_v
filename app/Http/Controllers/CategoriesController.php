<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    //
    public function viewCategories(Request $request)
    {
        $search = $request->query('search');
        
        $categories = Categories::when($search, function ($query) use ($search) {
            $query->where('name_category', 'LIKE', '%' . $search . '%');
        })->get();

        return response()->json(['categories' => $categories]);
    }

    public function createCategory(Request $request){
        $request->validate([
            'name_category' => 'required|string|max:255',
            'description' => 'required|string',
        ],
        //mensajes
        [
            'name_category.required' => 'El nombre de la categoria es obligatorio.',
            'name_category.string' => 'El nombre de la categoria debe ser una cadena de texto.',
            'name_category.max' => 'El nombre de la categoria no puede exceder los 255 caracteres.',
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.'
        ]);
        $brand = new Categories([
            'name_category' => $request->input('name_category'),
            'description' => $request->input('description'),
        ]);
        $brand->save();
        return redirect()->back()->with('success', 'Categoria creada exitosamente');
    }

    public function updateCategory(Request $request, $id_category)
    {
        $category = Categories::find($id_category);
        if ($category) {
            $request->validate([
                'name_category' => 'required|string|max:255|unique:categories',
                'description' => 'required|string',
            ], [
                'name_category.required' => 'El nombre de la categoría es obligatorio.',
                'name_category.string' => 'El nombre de la categoría debe ser una cadena de texto.',
                'name_category.max' => 'El nombre de la categoría no puede exceder los 255 caracteres.',
                'description.required' => 'La descripción es obligatoria.',
                'description.string' => 'La descripción debe ser una cadena de texto.'
            ]);
            $category->update([
                'name_category' => $request->input('name_category'),
                'description' => $request->input('description'),
                // Otras columnas a actualizar...
            ]);
            $updatedCategory = Categories::find($id_category);
            return response()->json(['message' => 'Marca actualizada con éxito', 'category' => $updatedCategory], 200);
            //return redirect()->route('view.categories')->with('success', 'Categoría actualizada con éxito');
        } else {
            return response()->json(['error' => 'No se encontró la categoria a actualizar'], 404);
        }
    }

    public function deleteCategory($id_category)
    {
        try 
        {
            $category = Categories::find($id_category);
            if ($category) {
                $name = $category->name_category;
                // Elimina la categoría y cualquier otro registro relacionado según tu estructura de base de datos.
                $category->delete();
                return response()->json(['success' => true, 'message'=> 'Se ha eliminado la categoría '.$name]);
            } else {
                return response()->json(['success'=>false,'message' => 'No se encontró la categoría a eliminar']);
            }
        } 
        catch (\Illuminate\Database\QueryException $e) 
        {
            if($e->getCode()=="23000") {
                return response()->json(['success'=>false,'message' => 'Hay productos relacionadas con esta categoría, favor de eliminarlas primero']);
            } else {
                // Manejo de otros errores si es necesario
                return response()->json(['success'=>false,'message' => 'Error al intentar eliminar la categoría']);
            }
        }
    }
}
