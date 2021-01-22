<?php

namespace App\Services;

use App\Traits\ConsumesExternalService;
use GuzzleHttp\Exception\GuzzleException;

class BookService
{
    use ConsumesExternalService;

    /**
     * The base uri to consume the books service
     * @var string
     */
    public $baseUri;

    /**
     * The secret to consume the authors service
     * @var string
     */
    public $secret;

    public function __construct()
    {
        $this->baseUri = config('services.books.base_uri');
        $this->secret = config('services.books.secret');
    }

    /**
     * Get the full list of books from the books service
     * @return string
     * @throws GuzzleException
     */
    public function obtainBooks(): string
    {
        return $this->performRequest('GET', '/books');
    }

    /**
     * Create an instance of book using the books service
     * @param $data
     * @return string
     * @throws GuzzleException
     */
    public function createBook($data): string
    {
        return $this->performRequest('POST', '/books', $data);
    }

    /**
     * Obtain one single book from the books service
     * @param $book
     * @return string
     * @throws GuzzleException
     */
    public function obtainBook($book): string
    {
        return $this->performRequest('GET', "/books/{$book}");
    }

    /**
     * Update an instance of book using the books service
     * @param $data
     * @param $book
     * @return string
     * @throws GuzzleException
     */
    public function editBook($data, $book): string
    {
        return $this->performRequest('PUT', "/books/{$book}", $data);
    }

    /**
     * Remove a single book using the books service
     * @param $book
     * @return string
     * @throws GuzzleException
     */
    public function deleteBook($book)
    {
        return $this->performRequest('DELETE', "/books/{$book}");
    }

}
