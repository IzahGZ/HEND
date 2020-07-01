<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RawMaterialSupplierRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'name' => 'required',
            // 'code' => 'required',
            // 'uom' => 'required|numeric',
            // 'shelf_life' => 'required|numeric',
            // 'set_up_cost' => 'required|numeric',
            // 'inventory_cost' => 'required|numeric',
            // 'suppliers' => 'required',
            // 'suppliers.*.supplier_id' => 'required|exists:raw_materials,id',
            // 'suppliers.*.quantity' => 'required|numeric',
            // 'suppliers.*.moq_id' => 'required|numeric',
            // 'suppliers.*.price_per_unit' => 'required|numeric',
            // 'suppliers.*.lead_time' => 'required|numeric',
        ];
    }
}
