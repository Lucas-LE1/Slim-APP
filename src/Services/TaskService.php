<?php

namespace App\Services;

class TaskService
{
    private static $list = array();

    public static function getAllTask()
    {
        return self::$list;
    }

    public static function getTaskById(int $id)
    {
        if (array_key_exists($id, self::$list)) {
            return self::$list[$id];
        } else {
            return [];
        }
    }

    public static function addTask($context)
    {
        $lastIndex = array_key_last(self::$list);

        if ($lastIndex === null)
            $newIndex = 0;
        else
            $newIndex = $lastIndex + 1;

        $task = array(
            $newIndex => $context
        );

        self::$list[] = $task;
    }

    public static function alterTask($context, $id)
    {
        if (array_key_exists($id, self::$list)) {
            self::$list[$id] = $context;
        } else {
            return [];
        }
    }
}