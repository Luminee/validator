<?php

namespace Luminee\Validator\Validation;

use Illuminate\Contracts\Translation\Translator;
use Illuminate\Validation\Validator as IlluminateValidator;
use Luminee\Validator\Validation\Concerns\ValidatesAttributes;

class Validator extends IlluminateValidator
{
    use ValidatesAttributes;

    /**
     * Create a new Validator instance.
     *
     * @param Translator $translator
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return void
     */
    public function __construct(
        Translator $translator,
        array $data,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ) {
        $extraRules = [
            'ExcludeDependOn',
        ];
        $this->dependentRules = array_merge($this->dependentRules, $extraRules);
        parent::__construct($translator, $data, $rules, $messages, $customAttributes);
    }
}
