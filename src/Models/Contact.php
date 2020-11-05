<?php

namespace App\Models;

use App\Db;
use App\Model;

class Contact extends Model
{

    protected static string $table = 'contacts';
    public string $name;
    public string $surname;
    public string $phone_number;
    public string $email;
    public string $picture;
    public int    $user_id;


    /**
     * @return array
     */
    public static function findAll(): array
    {
        $user = User::getCurrentUser();

        if (null === $user) {
            return [];
        }

        $db  = new Db;
        $sql = 'SELECT * FROM ' . self::$table . ' WHERE user_id = :user_id';

        return $db->query($sql, [':user_id' => $user->id], self::class);
    }


    /**
     * @param int $id
     * @return object|bool
     */
    public static function findById(int $id)
    {
        $user = User::getCurrentUser();

        if (null === $user) {
            return null;
        }

        $db     = new Db;
        $sql    = 'SELECT * FROM ' . self::$table . ' WHERE id = :id AND user_id = :user_id';
        $result = $db->query($sql, [':id' => $id, ':user_id' => $user->id], self::class);

        return !empty($result) ? reset($result) : false;
    }


    /**
     * @return int|bool
     */
    public static function getCount()
    {
        $user = User::getCurrentUser();

        if (null === $user) {
            return null;
        }

        $db     = new Db;
        $sql    = 'SELECT COUNT(id) FROM ' . self::$table . ' WHERE user_id = :user_id';
        $result = $db->query($sql, [':user_id' => $user->id]);

        return !empty($result) ? intval(reset($result[0])) : false;
    }

}
