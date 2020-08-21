<?php

namespace App\Resource;

/**
 * Recurso de integração relacionado aos projetos no Todoist.
 *
 * @package App\Resource
 */
class Project extends Base
{
    /** @var string Recurso da api. */
    const RESOURCE = '/rest/v1/projects';

    public function getAll()
    {
        $response = $this->client->get(self::RESOURCE);

        return $this->getResponse($response);
    }
}