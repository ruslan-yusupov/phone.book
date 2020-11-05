<?php

namespace App;

use App\Models\Contact;
use App\Models\User;

/**
 * @package App
 *
 * @property array $data
 * @property Contact $contacts
 * @property Contact $contact
 * @property User $user
 * @property string $message
 * @property array $alerts
 * @property int $count
 */

class View
{

    protected array $data = [];


    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->data[$name] = $value;
    }


    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->data[$name] ?? null;
    }


    /**
     * @param $name
     * @return bool
     */
    public function __isset($name): bool
    {
        return isset($this->data[$name]);
    }


    /**
     * @param $template
     * @return false|string
     */
    public function render($template)
    {
        $templatePath = __DIR__ . '/../templates' . $template;

        ob_start();
        include $templatePath;
        $content = ob_get_contents();
        ob_end_clean();

        return $content;

    }

}
