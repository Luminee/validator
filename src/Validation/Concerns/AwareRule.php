<?php

namespace Luminee\Validator\Validation\Concerns;

use Luminee\Validator\Validation\Validator;

trait AwareRule
{
    /**
     * The data under validation.
     *
     * @var array
     */
    protected $data;

    /**
     * The validator performing the validation.
     *
     * @var Validator
     */
    protected $validator;

    /**
     * Set the current validator.
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return $this
     */
    public function setValidator($validator)
    {
        $this->validator = $validator;

        return $this;
    }

    /**
     * Set the current data under validation.
     *
     * @param array $data
     * @return $this
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set the append data under validation.
     *
     * @param $attribute
     * @param $value
     * @return void
     */
    public function setAppendAttribute($attribute, $value)
    {
        $this->data['_append'][$attribute] = $value;

        $this->validator->setData($this->data);
    }

    /**
     * Get the append data under validation.
     *
     * @param $attribute
     * @return mixed|null
     */
    public function getAppendAttribute($attribute)
    {
        return $this->data['_append'][$attribute] ?? null;
    }

}
