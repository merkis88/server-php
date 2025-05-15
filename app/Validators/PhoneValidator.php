<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class PhoneValidator extends AbstractValidator
{
    protected string $message = "Поле :field должно быть валидным номером телефона (+7 или 8, и 10 цифр).";

    public function rule(): bool
    {
        return preg_match('/^(?:\+7|8)\d{10}$/', (string)$this->value) === 1;
    }
}
