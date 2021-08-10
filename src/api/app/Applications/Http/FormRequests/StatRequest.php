<?php

namespace src\Applications\Http\FormRequests;

class StatRequest extends FormRequest
{
    public function rules(): array
    {
        return [];
    }

    public function validationData(): array
    {
        return [
            'userId' => $this->input('userId')
        ];
    }
}