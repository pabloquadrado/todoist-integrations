<?php

namespace App\Resource;

/**
 * Fábrica de recursos.
 *
 * @package App\Resource
 */
class Factory
{
    /**
     * Retorna um recurso para operações nas tarefas.
     *
     * @return Task
     */
    public function createTask()
    {
        return new Task();
    }
}