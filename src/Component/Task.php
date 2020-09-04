<?php

namespace App\Component;

use Cassandra\Date;
use DateInterval;
use DateTime;
use Exception;

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

    /**
     * Retorna se um hábito já foi concluído.
     *
     * @param array $taskDueDate
     *
     * @return bool
     *
     * @throws Exception
     */
    public function isHabitCompleted($taskDueDate)
    {
        if (array_key_exists('datetime', $taskDueDate)) {
            $dueDate = new DateTime($taskDueDate['datetime']);

            return $dueDate > (new DateTime());
        }

        $dueDate = new DateTime($taskDueDate['date']);

        return $dueDate->format('Y-m-d') > (new DateTime())->format('Y-m-d');
    }

    /**
     * Retorna a tarefa com a data de vencimento atualizada.
     *
     * @param array $task
     *
     * @return array
     *
     * @throws Exception
     */
    public function increaseDueDate($task)
    {
        if (array_key_exists('datetime', $task['due'])) {
            $dueDate = new DateTime($task['due']['datetime']);

            $dueDate->add(new DateInterval('P1D'));

            $task['due_datetime'] = $dueDate->format(DateTime::RFC3339);

            return $task;
        }

        $dueDate = new DateTime($task['due']['date']);

        if ($dueDate->format('Y-m-d') == (new DateTime())->format('Y-m-d')) {
            return $task;
        }

        $dueDate->add(new DateInterval('P1D'));

        $task['due_date'] = $dueDate->format('Y-m-d');

        return $task;
    }
}