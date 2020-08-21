<?php

namespace App\Component;

/**
 * Componente para operações relacionadas à tarefas.
 *
 * @package App\Component
 */
class Task
{
    public function getRecurrence($taskName)
    {
        return strstr($taskName, '[day');
    }

    public function updateRecurrence($oldRecurrence, $taskName)
    {
        preg_match("/\d/i", $oldRecurrence, $days);

        $days = reset($days) + 1;

        $newRecurrence = "[day $days]";

        return str_replace(
            $oldRecurrence,
            $newRecurrence,
            $taskName
        );
    }

    public function resetRecurrence($oldRecurrence, $taskName)
    {
        return str_replace($oldRecurrence, '[day 0]', $taskName);
    }
}