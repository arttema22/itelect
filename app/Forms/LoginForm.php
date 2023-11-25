<?php

declare(static_types=1);

namespace App\Forms;

use MoonShine\Components\FormBuilder;

final class LoginForm
{
    public static function render(): FormBuilder
    {
        return FormBuilder::make(
            route('login'),
        );
    }
}
