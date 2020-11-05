<?php

namespace App;

abstract class Model
{

    protected static string $table = '';

    public $id;

    /**
     * @return array
     */
    public static function findAll(): array
    {

        $db  = new Db;
        $sql = 'SELECT * FROM ' . static::$table;

        return $db->query($sql, [], static::class);

    }

    /**
     * @param int $id
     * @return object|bool
     */
    public static function findById(int $id)
    {

        $db     = new Db;
        $sql    = 'SELECT * FROM ' . static::$table . ' WHERE id = :id';
        $result = $db->query($sql, [':id' => $id], static::class);

        return !empty($result) ? reset($result) : false;

    }

    /**
     * @return void
     */
    public function insert(): void
    {

        $db     = new Db;
        $props  = get_object_vars($this);
        $fields = [];
        $binds  = [];
        $data   = [];

        foreach ($props as $name => $value) {

            if ('id' !== $name) {
                $fields[] = $name;
                $binds[] = ':' . $name;
                $data[':' . $name] = $value;
            }

        }

        $sql = '
            INSERT INTO ' . static::$table .
            '(' . implode(', ', $fields) . ') 
            VALUES (' . implode(', ', $binds) . ')';

        $db->execute($sql, $data);
        $this->id = $db->lastInsertId();

    }

    /**
     * @return void
     */
    public function update(): void
    {

        $db     = new Db;
        $props  = get_object_vars($this);
        $fields = [];
        $data   = [];

        foreach ($props as $name => $value) {

            if ('id' !== $name) {
                $fields[] = $name . '=:' . $name;
            }

            $data[':' . $name] = $value;

        }

        $sql = '
            UPDATE ' . static::$table . ' 
            SET ' . implode(', ', $fields) . ' 
            WHERE id=:id';

        $db->execute($sql, $data);

    }

    /**
     * @return void
     */
    public function delete(): void
    {

        $db  = new Db;
        $sql = 'DELETE FROM ' . static::$table . ' WHERE id=:id';

        $db->execute($sql, [':id' => $this->id]);

    }

    /**
     * @return void
     */
    public function save(): void
    {

        if (null !== $this->id) {
            $this->update();
        } else {
            $this->insert();
        }

    }

}