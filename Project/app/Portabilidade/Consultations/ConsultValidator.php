<?php namespace Portabilidade\Consultations;

use Portabilidade\Support\Api\AbstractApiValidator;
use Auth;

class ConsultValidator extends AbstractApiValidator
{

    protected function rules()
    {
        return [
            'number' => 'required|between:10,12'
        ];
    }
}