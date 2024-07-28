<?php

namespace Modules\Review\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            'comment' => ['required', 'max:400'],
            'rating' => ['required', 'integer', 'between:1,5'],
        ];
    }
}
