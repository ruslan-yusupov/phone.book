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
        $sql = 'SELECT * FROM ' . static::$table . ' WHERE user_id = :user_id';

        return $db->query($sql, [':user_id' => $user->id], static::class);

    }

    /**
     * @param int $id
     * @return object|bool
     */
    public static function findById(int $id)
    {

        $user = User::getCurrentUser();

        if (null === $user) {
            return [];
        }

        $db     = new Db;
        $sql    = 'SELECT * FROM ' . static::$table . ' WHERE id = :id AND user_id = :user_id';
        $result = $db->query($sql, [':id' => $id, ':user_id' => $user->id], static::class);

        return !empty($result) ? reset($result) : false;

    }

}