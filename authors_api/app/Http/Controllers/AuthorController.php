<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class AuthorController extends Controller
{
    use ApiResponder;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Return authors list
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $authors = Author::all();

        return $this->successResponse($authors);
    }

    /**
     * Create an instance of Author
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'name' => 'required|max:255',
            'gender' => 'required|max:255|in:male,female',
            'country' => 'required|max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::create($request->all());

        return $this->successResponse($author, Response::HTTP_CREATED);
    }

    /**
     * Return an specific Author
     * @param int $author
     * @return JsonResponse
     */
    public function show(int $author): JsonResponse
    {
        $author = Author::findOrFail($author);

        return $this->successResponse($author);
    }

    /**
     * Update the information of an existing Author
     * @param Request $request
     * @param int $author
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $author): JsonResponse
    {
        $rules = [
            'name' => 'max:255',
            'gender' => 'max:255|in:male,female',
            'country' => 'max:255',
        ];

        $this->validate($request, $rules);

        $author = Author::findOrFail($author);

        $author->fill($request->all());

        if ($author->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $author->save();

        return $this->successResponse($author);
    }

    /**
     * Removes an existing Author
     * @return Illuminate\Http\Response
     */
    public function destroy($author)
    {
        $author = Author::findOrFail($author);

        $author->delete();

        return $this->successResponse($author);
    }
}
