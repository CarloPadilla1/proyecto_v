<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;

use App\Models\Inventory;
use App\Models\Measurement;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;


class ProductController extends Controller
{
    //
    public function viewProducts(Request $request){
            // Obtén todos los productos con sus relaciones
            $search = $request->query('search');
            $products = Product::when($search, function($query) use($search){
                $query->where('name_product', 'like', '%' . $search . '%');
            })
            ->with(['categories', 'provider', 'brand', 'inventory.measurement'])
            ->orderBy('name_product')
            ->take(30)
            ->get();
        
            $measurements= Measurement::get();
            // Retorna los productos en formato JSON
            return response()->json(['products' => $products, 'measurements' => $measurements]);
    }
   
    
    

    public function createProduct(ProductRequest $request){
        // Declaro el arreglo de los id de category
        $categories = $request->categoriesIds();
        // Creo el producto
        $new_product = Product::create($request->productParams());
        // //Inserto las relaciones product_category
        foreach ($categories as $category) {
            // Asociar la etiqueta con la reseña
            $new_product->categories()->attach($category);
        }
        // // Crear el inventario asociado al producto
        $inventory_params = $request->inventoryParams(); // Obtenemos los parámetros para el inventario
        $inventory_params['id_product'] = $new_product->id_product; // Agregamos el id del producto
        $new_inventory = new Inventory($inventory_params);
        $new_product->inventory()->save($new_inventory);
        
        return response()->json(['success' => true, 'product' => $new_product]);
    }

    public function updateProduct(ProductRequest $request, $id_product)
    {
        $product = Product::find($id_product);
        if ($product) {
            $update_p = $request->productParams();
            $update_i = $request->inventoryParams();
            $update_c = $request->categoriesIds();
            // Actualiza los datos del producto según los valores del formulario
            $product->update($update_p);
                // Asociar la etiqueta con la reseña
            $product->categories()->sync($update_c);
            $inventory = $product->inventory; // Obtener el inventario asociado
            $inventory->update($update_i);
            return response()->json(['success' => true, 'message' => "actualizar correctamente"]);
            // return redirect()->route('view.products')->with('success', 'Producto actualizado con éxito');
        } else {
            return redirect()->route('view.products')->with('error', 'No se encontró el producto a actualizar');
        }
    }

    
    public function deleteProduct($id_product)
{
    try 
    {
        $product = Product::find($id_product);
        if ($product) {
            $name= $product->name_product;
            // Elimina el producto y cualquier otro registro relacionado (inventario, imágenes, etc.) según tu estructura de base de datos.
            $product->delete();
            return response()->json(['success' => true, 'message'=> 'Se ha eliminado el producto'.$name]);
        } else {
            return response()->json(['success'=>false,'message' => 'No se encontró el producto a eliminar']);
        }
    } 
    catch (\Illuminate\Database\QueryException $e) 
    {
        if($e->getCode()=="23000") {
            return response()->json(['success'=>false,'message' => 'Hay ventas relacionadas a este producto, favor de eliminarlas primero']);
        } else {
            // Manejo de otros errores si es necesario
            return response()->json(['success'=>false,'message' => 'Error al intentar eliminar el producto']);
        }
    }
}

    public function paginateProducts(Request $request) {
        //Obtener datos de la url
        $search = $request->query('search');
        $categories = $request->query('categories');
        // dd($search);
        // Obtener los productos paginados con sus relaciones
        $products = Product::query()
            ->with(['categories', 'provider', 'brand', 'inventory.measurement'])
            //se filtra por el nombre
            ->when($search, function ($query, $search) {
                $query->where('name_product', 'like', '%' . $search . '%');
                    //filtro por description opcional
                    // ->orWhere('description', 'like', '%' . $search . '%');
            })
            //Aqui se filtra con los nombres de categorias, debe ser un array
            ->when($categories, function ($query, $categories) {
                $query->whereHas('categories', function ($subquery) use ($categories) {
                    $subquery->whereIn('name_category', explode(',', $categories));
                });
            })
            ->paginate(4);
           
        return response()->json($products);
    }
    public function updateStock(Request $request) {
        $productId = $request->input('productId');
        $newStock = $request->input('newStock');
    
        $product = Product::find($productId);
    
        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Producto no encontrado']);
        }
    
        $currentStock = $product->inventory->stock;
        $purchasePrice = $product->inventory->purchase_price;
        
        // Calcular el nuevo total_expense
        $newTotalExpense = $purchasePrice * ($newStock - $currentStock);
        
        $TotalExpense = $newTotalExpense +($product->inventory->total_expense);
        // Actualizar el stock y total_expense en la base de datos
        $product->inventory->update([
            'stock' => $newStock,
            'total_expense' => $TotalExpense,
        ]);
    
        return response()->json(['success' => true, 'message' => 'El stock ha sido actualizado']);
    }
    
    
}