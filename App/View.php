<?php

namespace App;

use App\Models\Contact;
use App\Models\User;

/**
 * @package App
 *
 * @property array $data
 * @property Contact $contacts
 * @property User $user
 */

class View
{

    protected array $data = [];

    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }

    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }

    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }

    public function render($template)
    {
        ob_start();
        include $template;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;

    }

}