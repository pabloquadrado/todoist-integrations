<?php

namespace App\Resource;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use function GuzzleHttp\json_decode as jsonDecode;
use function GuzzleHttp\json_encode as jsonEncode;

/**
 * Base para todos os recursos.
 *
 * @package App\Resource
 */
abstract class Base
{
    /** @var string Url base da integração. */
    protected $baseUri = 'https://api.todoist.com/rest/v1';

    /** @var Client Client para requisições HTTP. */
    protected $client;

    /**
     * Construtor da base de recursos.
     */
    public function __construct()
    {
         $this->client = new Client(
             [
                 'base_uri' => $this->baseUri,
                 'headers' => [
                     'Authorization' => 'Bearer ' . API_KEY
                 ]
            ]
         );
    }

    /**
     * Obtém o body do response da requisição.
     *
     * @param ResponseInterface $response
     *
     * @return array|bool|float|int|object|string|null
     */
    protected function getResponse(ResponseInterface $response)
    {
        $responseContent = $response->getBody()->getContents();

        if (empty($responseContent)) {
            return [];
        }

        return jsonDecode($responseContent, true);
    }

    /**
     * Converte o corpo da requisição para JSON.
     *
     * @param string|array $body
     *
     * @return string
     */
    protected function encodeBody($body)
    {
        return jsonEncode($body);
    }
}