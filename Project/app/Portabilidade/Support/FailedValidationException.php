<?php namespace Portabilidade\Support;

/**
 * Class FailedValidationException
 * @package Fluxoti\Validators
 */
class FailedValidationException  extends \RuntimeException
{

    /**
     * @var array
     */
    protected $errors = [];

    public $redirect_to = null;

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

    public function setRedirectUrl($url)
    {
        $this->redirect_to = $url;
        return $this;
    }

}

