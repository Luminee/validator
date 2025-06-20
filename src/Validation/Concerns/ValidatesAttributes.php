<?php

namespace Luminee\Validator\Validation\Concerns;

trait ValidatesAttributes
{
    public function validateDependOn()
    {

    }
    /**
     * Indicate that an attribute should be excluded when another attribute check true.
     *
     * @param string $attribute
     * @param mixed $value
     * @param mixed $parameters
     * @return bool
     */
    public function validateExcludeDependOn($attribute, $value, $parameters)
    {
        $this->requireParameterCount(2, $parameters, 'exclude_depend_on');

        $attribute_passed = $this->isAttributePassed($parameters[0]);

        $should_pass = !($parameters[1] == 'false') && $parameters[1];

        return $should_pass !== $attribute_passed;
    }

    protected function isAttributePassed($attribute)
    {
        return empty($this->failedRules) || !array_key_exists($attribute, $this->failedRules);
    }

}
