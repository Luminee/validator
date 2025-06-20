<?php

namespace Luminee\Validator;

class Validator
{
    /**
     * Get Validator For Input Data
     *
     * @param $fromRequest
     * @param array $rules
     * @param array $messages
     * @param array $attributes
     * @return \Illuminate\Validation\Validator
     * @throws BindingResolutionException
     */
    public static function validate($fromRequest, array $rules = [], array $messages = [], array $attributes = [])
    {
        if (is_string($fromRequest)) {
            $fromRequest = app()->make($fromRequest);
        }

        return \Illuminate\Support\Facades\Validator::make(
            request()->all(),
            array_merge($fromRequest->rules(), $rules),
            array_merge($fromRequest->messages(), $messages),
            array_merge($fromRequest->attributes(), $attributes)
        );
    }
}
