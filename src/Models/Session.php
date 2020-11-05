<?php

namespace App\Models;

use App\Db;
use App\Model;

class Session extends Model
{

    public static string $table = 'sessions';
    public string $user_id;
    public string $hash;
    public string $user_agent;


    /**
     * @param $userId
     * @return bool
     */
    public static function deleteAllByUserId($userId): bool
    {
        $db  = new Db;
        $sql = 'DELETE FROM ' . self::$table . ' WHERE user_id=:user_id';

        return $db->execute($sql, [':user_id' => $userId]);
    }


    /**
     * @param $sessionHash
     * @return int|null
     */
    public static function getUserId($sessionHash)
    {
        $userAgentHash = hash('sha256', $_SERVER['HTTP_USER_AGENT']);

        $db      = new Db;
        $sql     = 'SELECT user_id FROM ' . self::$table . ' WHERE hash=:hash AND user_agent=:user_agent';
        $params  = [':hash' => $sessionHash, ':user_agent' => $userAgentHash];
        $result  = $db->query($sql, $params, self::class);

        if (empty($result)) {
            return null;
        }

        $session = reset($result);

        return $session->user_id;

    }


    /**
     * @param $userId
     * @param $userSessionId
     * @return int
     */
    public static function add($userId, $userSessionId): int
    {
        $session = new self;

        $session->user_id    = $userId;
        $session->hash       = $userSessionId;
        $session->user_agent = hash('sha256', $_SERVER['HTTP_USER_AGENT']);

        $session->save();

        return $session->id;
    }

}
