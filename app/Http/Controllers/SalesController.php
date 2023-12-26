<?php

namespace App\Http\Controllers;

use App\Models\Sell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SalesController extends Controller
{
    //
    public function createSale(Request $request)
    {
        try {
            $user_id = Auth::user()->id_user;
    
            // Obtener datos de la venta y los ítems del palet desde la solicitud
            $totalSale = $request->input('totalSale');
            $paletItems = $request->input('paletItems');

            // Crear la venta
            $sell = Sell::create([
                'total_amount' => $totalSale,
                'id_user' => $user_id,
            ]);
            // Iterar sobre cada ítem de palet y crear las líneas de venta
        foreach ($paletItems as $item) {
            $new_line = [
                'id_product' => $item['id_infusion'],
                'quantity' => $item['count'],
                'amount' => $item['totalProducto_infusion'],
            ];
            
            $sell->sale_line()->create($new_line);
        }
            // Realizar cualquier otra lógica que necesites aquí
    
            return response()->json(['message' => 'Venta creada con éxito', 'sell_id' => $sell->sell], 201);
        } catch (\Exception $e) {
            // Manejar errores si es necesario
            return response()->json(['error' => 'Error al crear la venta', 'message' => $e->getMessage()], 500);
        }
    }
    public function getSells(Request $request)
{
    $search = $request->query('search');
    
    $sells = Sell::when($search, function ($query) use ($search) {
        $query->whereHas('sale_line.product', function ($subquery) use ($search) {
            $subquery->where('name_product', 'like', "%{$search}%");
        })
        ->orWhereHas('user', function ($subquery) use ($search) {
            $subquery->where('name_user', 'like', "%{$search}%");
        });
    })
    ->with([
        'sale_line.product:id_product,name_product',
        'sale_line.product.categories:id_category,name_category',
        'sale_line.product.inventory:id_product,sale_price', 
        'user:id_user,name_user'
    ])
    ->get();

    return response()->json(['success' => true, 'sells' => $sells]);
}


    // public function getSells(Request $request)
    // {
    //     $search = $request->query('search');
    //     $sells = Sell::when($search, function ($query) use($search) {
            
    //     }
    //     )->with(['sale_line.product:id_product,name_product',
    //                             'sale_line.product.categories:id_category,name_category',
    //                             'sale_line.product.inventory:id_product,sale_price', 
    //                             'user:id_user,name_user'])
    //                         ->get();
    //     return response()->json(['success'=> true, 'sells'=>$sells]);
    // }
}
