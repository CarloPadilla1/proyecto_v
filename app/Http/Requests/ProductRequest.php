<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name_product' => 'required|string|max:255',
            'description' => 'required|string',
            'id_brand' => 'required|exists:brands,id_brand',
            'id_provider' => 'required|exists:providers,id_provider',
            'id_category' => 'required|exists:categories,id_category',
            'purchase_price' => 'required|numeric|min:0',
            'sale_price' => 'required|numeric|min:0',
            'stock' => 'nullable|integer|min:0',
            'quantity_sell' => 'nullable|integer|min:0',
            'total_expense' => 'nullable|numeric|min:0',
            'total_revenue' => 'nullable|numeric|min:0',
            'total_profit' => 'nullable|numeric',
        ];
    }
    public function inventoryParams(): array
    {
        $stock = $this->input('stock');
        $purchase_price = $this->input('purchase_price');
        return [
            'id_measurements' => $this->input('id_measurements'),
            'purchase_price' => $purchase_price,
            'sale_price' => $this->input('sale_price'),
            'stock' => $stock,
            'quantity_sell' => 0,
            'total_expense' => $stock * $purchase_price,
            'total_revenue'=> 0.00,
            'total_profit'=> -$stock * $purchase_price,
        ];
    }
    public function productParams(): array
    {
        return $this->only([
            'name_product',
            'description',
            'id_brand',
            'id_provider',
        ]);
    }
    public function categoriesIds(){
        return $this->input('id_category');
    }
    public function messages(): array
    {
        return [
            'name_product.required' => 'El nombre del producto es obligatorio.',
            'name_product.string' => 'El nombre del producto debe ser una cadena de texto.',
            'name_product.max' => 'El nombre del producto no puede exceder los 255 caracteres.',
    
            'description.required' => 'La descripción es obligatoria.',
            'description.string' => 'La descripción debe ser una cadena de texto.',
    
            'id_brand.required' => 'La marca es obligatoria.',
            'id_brand.exists' => 'La marca seleccionada no es válida.',
    
            'id_provider.required' => 'El proveedor es obligatorio.',
            'id_provider.exists' => 'El proveedor seleccionado no es válido.',
    
            'id_category.required' => 'La categoría es obligatoria.',
            'id_category.exists' => 'La categoría seleccionada no es válida.',
    
            'purchase_price.required' => 'El precio de compra es obligatorio.',
            'purchase_price.numeric' => 'El precio de compra debe ser un número.',
            'purchase_price.min' => 'El precio de compra no puede ser menor que 0.',
    
            'sale_price.required' => 'El precio de venta es obligatorio.',
            'sale_price.numeric' => 'El precio de venta debe ser un número.',
            'sale_price.min' => 'El precio de venta no puede ser menor que 0.',
    
            'stock.integer' => 'El stock debe ser un número entero.',
            'stock.min' => 'El stock no puede ser menor que 0.',
    
            'quantity_sell.integer' => 'La cantidad vendida debe ser un número entero.',
            'quantity_sell.min' => 'La cantidad vendida no puede ser menor que 0.',
    
            'total_expense.numeric' => 'El total de gastos debe ser un número.',
            'total_expense.min' => 'El total de gastos no puede ser menor que 0.',
    
            'total_revenue.numeric' => 'El total de ingresos debe ser un número.',
            'total_revenue.min' => 'El total de ingresos no puede ser menor que 0.',
    
            'total_profit.numeric' => 'El total de ganancias debe ser un número.',
            'total_profit.min' => 'El total de ganancias no puede ser menor que 0.',
        ];
    }
    
}
