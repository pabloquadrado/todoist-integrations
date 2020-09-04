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
     * Consulta as tarefas do projeto chamado Habits
     * com data de vencimento para o dia atual.
     *
     * @return array
     *
     * @throws GuzzleException
     */
    public function getTodayHabits()
    {
        $response = $this->client->get(self::RESOURCE, [
            'query' => [
                'filter' => '#Habits & Today'
            ]
        ]);

        return $this->getResponse($response);
    }

    /**
     * Atualiza uma tarefa.
     *
     * @param array $task
     *
     * @return array|bool|float|int|object|string|null
     *
     * @throws GuzzleException
     */
    public function update($task)
    {
        $response = $this->client->post(self::RESOURCE . "/{$task['id']}", [
            'headers' => [
                'Content-Type' => 'application/json'
            ],
            'body' => $this->encodeBody($task)
        ]);

        return $this->getResponse($response);
    }
}