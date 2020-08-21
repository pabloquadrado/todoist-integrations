<?php

namespace App\Component;

/**
 * Componente para operações relacionadas à tarefas.
 *
 * @package App\Component
 */
class Task
{
    /**
     * Retorna a recorrência do hábito.
     *
     * @param string $taskName
     *
     * @return false|string
     */
    public function getRecurrence($taskName)
    {
        return strstr($taskName, '[day');
    }

    /**
     * Atualiza a recorrência do hábito.
     *
     * @param string $oldRecurrence
     * @param string $taskName
     *
     * @return string|string[]
     */
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

    /**
     * Reseta a recorrência do hábito.
     *
     * @param string $oldRecurrence
     * @param string $taskName
     *
     * @return string|string[]
     */
    public function resetRecurrence($oldRecurrence, $taskName)
    {
        return str_replace($oldRecurrence, '[day 0]', $taskName);
    }
}