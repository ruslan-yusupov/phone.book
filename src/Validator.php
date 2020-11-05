<?php

namespace App;

/**
 * @package App
 */
class Validator
{

    /**
     * @param string $email
     * @return bool
     */
    public static function checkEmail(string $email): bool
    {
        $generalRegex = '~^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$~iD';

        switch (false) {
            case !empty($email):
            case preg_match($generalRegex, $email):
                return false;
        }

        return true;
    }


    /**
     * @param string $password
     * @return bool
     */
    public static function checkPassword(string $password): bool
    {
        $hasUpperCaseSymbols = '~[A-Z]~';
        $hasLowerCaseSymbols = '~[a-z]~';
        $hasDigitsSymbols    = '~\d~';
        $hasMoreThan5Symbols = '~\S{6,}~';

        switch (false) {
            case !empty($password):
            case preg_match($hasUpperCaseSymbols, $password):
            case preg_match($hasLowerCaseSymbols, $password):
            case preg_match($hasDigitsSymbols, $password):
            case preg_match($hasMoreThan5Symbols, $password):
                return false;
        }

        return true;
    }


    /**
     * @param string $login
     * @return bool
     */
    public static function checkLogin(string $login): bool
    {
        $hasLatinSymbols = '~[A-z]~';
        $hasDigitsSymbols    = '~\d~';
        $hasLimitIn16Symbols = '~^\S{3,16}$~';

        switch (false) {
            case !empty($login):
            case preg_match($hasLatinSymbols, $login):
            case preg_match($hasDigitsSymbols, $login):
            case preg_match($hasLimitIn16Symbols, $login):
                return false;
        }

        return true;
    }


    /**
     * @param $image
     * @return bool
     */
    public static function checkImage($image): bool
    {
        switch (true) {
            case empty($image):
            case 0 !== $image['error']:
            case 'image/jpeg' !== $image['type'] && 'image/png' !== $image['type']:
            case 5242880 < $image['size']:
                return false;
        }

        return true;
    }


    /**
     * @param string $text
     * @return bool
     */
    public static function checkInput(string $text): bool
    {
        switch (true) {
            case empty($text):
                return false;
        }

        return true;
    }

}
