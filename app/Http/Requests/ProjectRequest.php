<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'code' => 'required',
            'product_id' => 'required|exists:products,id',
            'material' => 'required',
            'material.*.id' => 'required|exists:raw_materials,id',
            'material.*.quantity' => 'required|numeric',
            'process' => 'required',
            'process.*.materialId' => 'required|exists:raw_materials,id',
            'process.*.process' => 'required|exists:process,id',
            'process.*.duration' => 'required',
        ];
    }
}
