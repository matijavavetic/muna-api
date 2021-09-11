<?php

namespace src\Applications\Http\FormRequests;

class CheckRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'value' => [
                'string',
                'min:3',
                'max:100'
            ],
        ];
    }

    public function validationData(): array
    {
        return [
            'value'  => $this->input('value'),
            'userId' => $this->input('userId')
        ];
    }
}