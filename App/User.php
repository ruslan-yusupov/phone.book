<?php


namespace App;

use PDO;

class User
{

    const COOKIE_SESS_NAME = 'APPSESSID';
    const DB_USER          = 'user';
    const DB_PASSWORD      = 'K6&3Y%qb%WS(cl21';
    const DSN              = 'mysql:host=172.22.0.5;dbname=phone_book';


    /**
     * @param string $email
     * @param string $password
     * @return false|mixed
     */
    public static function authenticate(string $email, string $password)
    {
        $dbh = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);
        $sth = $dbh->prepare('SELECT * FROM users WHERE email=:email');

        $sth->execute([':email' => $email]);

        $data = $sth->fetch();

        if (!empty($data)) {
            if (true === password_verify($password, $data['password'])) {
                return $data['id'];
            }
        }

        return false;

    }


    /**
     * @param int $userId
     * @param string $hash
     * @return bool
     */
    public static function setSession(int $userId, string $hash): bool
    {

        $dbh = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);

        //Clean old sessions
        $sth = $dbh->prepare(
            'DELETE FROM sessions WHERE user_id=:user_id'
        );
        $sth->execute([':user_id' => $userId]);

        //Add new session
        $sth = $dbh->prepare(
            'INSERT INTO sessions (user_id, hash, user_agent) VALUES (:user_id, :hash, :user_agent)'
        );

        return $sth->execute([':user_id' => $userId, ':hash' => $hash, ':user_agent' => $_SERVER['HTTP_USER_AGENT']]);

    }


    /**
     * @return mixed|null
     */
    public static function getCurrentUser()
    {
        $dbh = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);
        $userSessionHash = $_COOKIE[self::COOKIE_SESS_NAME] ?? null;

        if (empty($userSessionHash)) {
            return null;
        }

        $sth = $dbh->prepare(
            'SELECT user_id FROM sessions WHERE hash=:hash AND user_agent=:user_agent'
        );
        $sth->execute([':hash' => $userSessionHash, ':user_agent' => $_SERVER['HTTP_USER_AGENT']]);

        $sessionInfo = $sth->fetch();

        if (empty($sessionInfo)) {
            return null;
        }

        $sth = $dbh->prepare(
            'SELECT * FROM users WHERE id=:id'
        );

        $sth->execute([':id' => $sessionInfo['user_id']]);

        return $sth->fetch(PDO::FETCH_ASSOC);

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

        $dbh = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);
        $sth = $dbh->prepare(
            'DELETE FROM sessions WHERE user_id=:user_id'
        );

        $result = $sth->execute([':user_id' => $user['id']]);

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

        $dbh = new PDO(self::DSN, self::DB_USER, self::DB_PASSWORD);
        $sth = $dbh->prepare(
            'INSERT INTO users (login, email, password) VALUES (:login, :email, :password)'
        );

        return $sth->execute([':login' => $login, ':email' => $email, ':password' => $passwordHash]);

    }

}