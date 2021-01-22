<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorService;
use App\Services\BookService;
use App\Traits\ApiResponder;
use GuzzleHttp\Exception\GuzzleException;


class BookController extends Controller
{
    use ApiResponder;

    public BookService $bookService;
    public AuthorService $authorService;

    /**
     * Create a new controller instance.
     *
     * @param BookService $bookService
     * @param AuthorService $authorService
     */
    public function __construct(BookService $bookService, AuthorService $authorService)
    {
        $this->bookService = $bookService;
        $this->authorService = $authorService;
    }

    /**
     * @return Response
     * @throws GuzzleException
     */
    public function index(): Response
    {
        return $this->successResponse($this->bookService->obtainBooks());
    }

    /**
     * @param Request $request
     * @return Response
     * @throws GuzzleException
     */
    public function store(Request $request): Response
    {
        $this->authorService->obtainAuthor($request->author_id);

        return $this->successResponse($this->bookService->createBook($request->all()), Response::HTTP_CREATED);
    }

    /**
     * @param $book
     * @return Response
     * @throws GuzzleException
     */
    public function show($book): Response
    {
        return $this->successResponse($this->bookService->obtainBook($book));
    }

    /**
     * @param Request $request
     * @param $book
     * @return Response
     * @throws GuzzleException
     */
    public function update(Request $request, $book): Response
    {
        return $this->successResponse($this->bookService->editBook($request->all(), $book));
    }

    /**
     * @param $book
     * @return Response
     * @throws GuzzleException
     */
    public function destroy($book): Response
    {
        return $this->successResponse($this->bookService->deleteBook($book));
    }
}
