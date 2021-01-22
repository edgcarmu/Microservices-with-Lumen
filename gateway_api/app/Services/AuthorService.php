<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use GuzzleHttp\Exception\GuzzleException;

class AuthorService
{
    use ConsumesExternalService;

    /**
     * The base uri to be used to consume the authors service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to be used to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.authors.base_uri');
        $this->secret = config('services.authors.secret');
    }

    /**
     * Get the full list of authors from the authors service
     * @return string
     * @throws GuzzleException
     */
    public function obtainAuthors(): string
    {
        return $this->performRequest('GET', '/authors');
    }

    /**
     * Create an instance of author using the authors service
     * @param $data
     * @return string
     * @throws GuzzleException
     */
    public function createAuthor($data): string
    {
        return $this->performRequest('POST', '/authors', $data);
    }

    /**
     * Obtain one single author from the author service
     * @param $author
     * @return string
     * @throws GuzzleException
     */
    public function obtainAuthor($author): string
    {
        return $this->performRequest('GET', "/authors/{$author}");
    }

    /**
     * Update an instance of author using the author service
     * @param $data
     * @param $author
     * @return string
     * @throws GuzzleException
     */
    public function editAuthor($data, $author): string
    {
        return $this->performRequest('PUT', "/authors/{$author}", $data);
    }

    /**
     * Remove a single author using the author service
     * @param $author
     * @return string
     * @throws GuzzleException
     */
    public function deleteAuthor($author): string
    {
        return $this->performRequest('DELETE', "/authors/{$author}");
    }

}
