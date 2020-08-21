<?php

namespace App\Resource;

use GuzzleHttp\Exception\GuzzleException;

/**
 * Recurso para operações relacionadas a tarefas.
 *
 * @package App\Resource
 */
class Task extends Base
{
    /** @var string Recurso da api. */
    const RESOURCE = '/rest/v1/tasks';

    /**
     * Consulta as tarefas do projeto chamado Habits.
     *
     * @return array
     *
     * @throws GuzzleException
     */
    public function getHabitsTasks()
    {
        $response = $this->client->get(self::RESOURCE, [
            'query' => [
                'filter' => '#Habits'
            ]
        ]);

        return $this->getResponse($response);
    }

    /**
     * Atualizar o nome de uma tarefa.
     *
     * @param string $task
     *
     * @return array|bool|float|int|object|string|null
     *
     * @throws GuzzleException
     */
    public function updateContent($task)
    {
        $response = $this->client->post(self::RESOURCE . "/{$task['id']}", [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => $this->encodeBody([
                'content' => $task['content']
            ])
        ]);

        return $this->getResponse($response);
    }
}