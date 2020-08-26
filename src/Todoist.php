<?php

namespace App;

use DateTime;
use Exception;

/**
 * Fachada de recursos da integração com o Todoist.
 *
 * @package App
 */
class Todoist
{
    /** @var Resource\Factory Fábrica de recursos. */
    private $resourceFactory;

    /** @var Component\Factory Fábrica de componentes. */
    private $componentFactory;

    /**
     * Construtor da facade.
     */
    public function __construct()
    {
        $this->resourceFactory = new Resource\Factory();
        $this->componentFactory = new Component\Factory();
    }

    /**
     * Atualiza recorrência dos hábitos.
     */
    public function updateHabits()
    {
        try {

            $taskResource = $this->resourceFactory->createTask();

            $tasks = $taskResource->getHabitsTasks();

            if (empty($tasks)) {
                $this->getResponse('Nenhuma tarefa no projeto Habits.');
            }

            $taskComponent = $this->componentFactory->createTask();

            foreach ($tasks as $task) {
                $recurrence = $taskComponent->getRecurrence($task['content']);

                if (! $recurrence) {
                    continue;
                }

                $dueDate = new DateTime($task['due']['datetime'] ?: $task['due']['date']);

                if ($dueDate->getTimestamp() > (new DateTime())->getTimestamp()) {
                    $task['content'] = $taskComponent->updateRecurrence(
                        $recurrence,
                        $task['content']
                    );

                    $taskResource->updateContent($task);

                    continue;
                }

                $task['content'] = $taskComponent->resetRecurrence(
                    $recurrence,
                    $task['content']
                );

                $taskResource->updateContent($task);
            }

        } catch (Exception $exception) {
            $this->getResponse($exception->getMessage());
        }

        $this->getResponse('Hábitos atualizados.');
    }

    /**
     * Finaliza aplicação e exibe retorno dentro da estrutura padrão.
     *
     * @param string|array $response
     */
    private function getResponse($response)
    {
        header('Content-Type: application/json');

        die(json_encode(['data' => $response]));
    }
}