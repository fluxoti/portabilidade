<?php namespace Portabilidade\Support\Api;

/**
 * Class FailedValidationException
 * @package Fluxoti\Validators
 */
class FailedApiValidationException  extends \RuntimeException
{

    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param $errors
     * @return $this
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
        $this->message = "Validation failed";
        return $this;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

}

