<?php

namespace Modules\Review\Http\Requests\Reviews;

use Illuminate\Foundation\Http\FormRequest;

class ReplyRequest extends FormRequest
{
    /**
     * @return array[]
     */
    public function rules(): array
    {
        return [
            'answer' => ['required', 'max:400']
        ];
    }
}
