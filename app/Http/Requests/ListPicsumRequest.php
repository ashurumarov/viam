<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 */
class ListPicsumRequest extends FormRequest
{
    protected $routeParamsToValidate = ['id' => 'id', 'height' => 'height', 'width' => 'width'];
    public int $width = 500;
    public int $height = 500;

    public function rules(): array
    {
        return [
            'id'     => ['required|int'],
            'height' => ['int|nullable'],
            'width'  => ['int|nullable'],
        ];
    }
}
