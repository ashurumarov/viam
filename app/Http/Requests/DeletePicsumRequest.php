<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property int $id
 */
class DeletePicsumRequest extends FormRequest
{
    protected $routeParamsToValidate = ['id' => 'id',];

    public function rules(): array
    {
        return [
            'id'     => ['required|int'],
        ];
    }
}
