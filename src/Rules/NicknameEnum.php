<?php

namespace Luminee\Validator\Rules;

enum NicknameEnum: string
{
    case REGEX_20 = 'regex:/^[a-zA-Z .@\p{Han}][0-9a-zA-Z .@\p{Han}]{1,19}$/u|max:20';
}
