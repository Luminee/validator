<?php

namespace Luminee\Validator\Rules;

enum PhoneEnum: string
{
    case REGEX = 'regex:/^1[3-9][0-9]{9}$/';
    case Landline = 2;
}
