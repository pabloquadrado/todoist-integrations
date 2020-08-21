<?php

namespace App\Component;

/**
 * Fábrica de componentes.
 *
 * @package App\Component
 */
class Factory
{
    /**
     * Retorna um componente de tarefas.
     *
     * @return Task
     */
    public function createTask()
    {
        return new Task();
    }
}