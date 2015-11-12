<?php namespace Portabilidade\Support;

use Illuminate\Validation\Factory;
use Illuminate\Validation\Validator;

/**
 * Class AbstractValidator
 */
abstract class AbstractValidator {

    /**
     * @var Factory
     */
    private $validator;

    /**
     * @var Validator
     */
    private $validation;

    /**
     * @var array
     */
    protected $attributes = [];


    /**
     * @param Factory $validator
     */
    public function __construct(Factory $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Register the custom validation methods.
     *
     * Get all the class methods starting with validate and register them for the validator. Eg.: validateFoo
     * will be registered for the foo validator rule.
     */
    public function autoRegister()
    {
        $methods = get_class_methods($this);
        foreach ( $methods as $method) {
            if(preg_match('/^validate.+/', $method)) {
                $validation = lcfirst(preg_replace('/validate/', '', $method));

                $this->validator->extend($validation, function($attribute, $value, $parameters) use ($method) {
                    return $this->$method($attribute, $value, $parameters);
                });
            }
        }

    }

    /**
     * @param array $data
     * @internal param null $id
     */
    public function validate(array $data)
    {
        $this->attributes = $data;
        $this->autoRegister();

        $rules = $this->parseRules($this->rules(), $data);
        $this->validation = $this->make($data, $rules, $this->messages());
        if ( $this->validation->fails())
            throw (new FailedValidationException())
                ->setErrors($this->validation->messages())
                ->setRedirectUrl($this->getRedirectUrl());

    }

    /**
     * @param array $data
     * @param $rules
     * @param $messages
     * @param null $id
     * @internal param $validator
     * @return mixed
     */
    private function make(array $data, $rules, $messages, $id = null)
    {
        return $this->validator->make($data, $rules, $messages);
    }

    /**
     * @param $rules
     * @param $data
     * @return mixed
     */
    private function parseRules($rules, $data)
    {
        foreach($rules as $field => &$ruleset) {
            $ruleset = (is_string($ruleset)) ? explode('|', $ruleset) : $ruleset;
            foreach ( $ruleset as &$rule) {
                if (strpos($rule, 'unique') === 0) {
                    if (strpos($rule, '{ID}')) {
                        if (isset($data['id']))
                            $rule = str_replace('{ID}', $data['id'], $rule);
                        else
                            $rule = str_replace('{ID}', 'NULL', $rule);
                    }
                }
            }
        }
        return $rules;
    }

    public function getRedirectUrl()
    {
        return null;
    }

    /**
     * @param $name
     * @return null
     */
    public function __get($name)
    {
        return isset($this->attributes[$name]) ? $this->attributes[$name] : null;
    }

    /**
     * @param $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->attributes[$name]);
    }

    abstract protected function rules();

    protected function messages()
    {
        return [];
    }

}