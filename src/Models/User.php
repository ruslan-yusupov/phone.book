<?php


namespace App\Models;

use App\Db;
use App\Model;

class User extends Model
{

    const COOKIE_SESS_NAME = 'APPSESSID';

    public static string $table = 'users';

    public string $login;
    public string $email;
    public $password;

    /**
     * @param string $email
     * @param string $password
     * @return false|mixed
     */
    public static function authenticate(string $email, string $password)
    {
        $db     = new Db;
        $sql    = 'SELECT * FROM ' . self::$table . ' WHERE email=:email';
        $params = [':email' => $email];
        $result = $db->query($sql, $params, self::class);
        $user   = reset($result);


        if (!empty($user)) {
            if (true === password_verify($password, $user->password)) {
                return $user->id;
            }
        }

        return false;

    }


    /**
     * @return mixed|null
     */
    public static function getCurrentUser()
    {
        $userSessionHash = $_COOKIE[self::COOKIE_SESS_NAME] ?? null;

        if (empty($userSessionHash)) {
            return null;
        }

        //Get user id from session
        $userId = Session::getUserId($userSessionHash);

        if (empty($userId)) {
            return null;
        }

        //Get user
        return self::findById($userId);

    }


    /**
     * @return bool
     */
    public static function logout(): bool
    {
        $user = self::getCurrentUser();

        if (empty($user)) {
            return false;
        }

        //Delete user sessions
        $result = Session::deleteAllByUserId($user->id);

        if (true === $result) {
            setcookie(self::COOKIE_SESS_NAME, '', time() - 3600);
        }

        return $result;

    }


    /**
     * @param string $login
     * @param string $email
     * @param string $password
     * @return bool
     */
    public static function register(string $login, string $email, string $password): bool
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $user = new self;
        $user->login = $login;
        $user->email = $email;
        $user->password = $passwordHash;
        $user->save();

        return $user->id;

    }

}