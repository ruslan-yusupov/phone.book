<?php

namespace App\Models;

class Validator
{

    /**
     * @param string $email
     * @return bool
     */
    public static function checkEmail(string $email): bool
    {
        $generalRegex = '~^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$~iD';

        return preg_match(self::EMAIL_REGEX, $email);
    }


    /**
     * @param string $password
     * @return bool
     */
    public static function checkPassword(string $password): bool
    {

        $hasUpperCaseSymbols = '~[A-Z, А-ЯЁ]~';
        $hasLowerCaseSymbols = '~[a-z, а-яё]~';
        $hasDigitsSymbols    = '~\d~';
        $hasMoreThan5Symbols = '~\S{6,}~';

        switch (false) {
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
            case preg_match($hasLatinSymbols, $login):
            case preg_match($hasDigitsSymbols, $login):
            case preg_match($hasLimitIn16Symbols, $login):
                return false;
        }

        return true;

    }


    /**
     * @param string $login
     * @return bool
     */
    public static function checkImageSize(int $size): bool
    {

        $hasLatinSymbols = '~[A-z]~';
        $hasDigitsSymbols    = '~\d~';
        $hasLimitIn16Symbols = '~^\S{3,16}$~';

        switch (false) {
            case preg_match($hasLatinSymbols, $login):
            case preg_match($hasDigitsSymbols, $login):
            case preg_match($hasLimitIn16Symbols, $login):
                return false;
        }

        return true;

    }

}