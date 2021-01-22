<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\AuthorService;
use GuzzleHttp\Exception\GuzzleException;


class AuthorController extends Controller
{
    use ApiResponder;

    public AuthorService $authorService;

    /**
     * Create a new controller instance.
     *
     * @param AuthorService $authorService
     */
    public function __construct(AuthorService $authorService)
    {
        $this->authorService = $authorService;
    }

    /**
     * @return Response
     * @throws GuzzleException
     */
    public function index(): Response
    {
        return $this->successResponse($this->authorService->obtainAuthors());
    }

    /**
     * @param Request $request
     * @return Response
     * @throws GuzzleException
     */
    public function store(Request $request): Response
    {
        return $this->successResponse($this->authorService->createAuthor($request->all()), Response::HTTP_CREATED);
    }

    /**
     * @param $author
     * @return Response
     * @throws GuzzleException
     */
    public function show($author): Response
    {
        return $this->successResponse($this->authorService->obtainAuthor($author));
    }

    /**
     * @param Request $request
     * @param $author
     * @return Response
     * @throws GuzzleException
     */
    public function update(Request $request, $author): Response
    {
        return $this->successResponse($this->authorService->editAuthor($request->all(), $author));
    }

    /**
     * @param $author
     * @return Response
     * @throws GuzzleException
     */
    public function destroy($author): Response
    {
        return $this->successResponse($this->authorService->deleteAuthor($author));
    }
}
