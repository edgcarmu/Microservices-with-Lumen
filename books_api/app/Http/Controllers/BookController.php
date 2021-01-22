<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Traits\ApiResponder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;


class BookController extends Controller
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
     * Return books list
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $books = Book::all();

        return $this->successResponse($books);
    }

    /**
     * Create an instance of book
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $rules = [
            'title' => 'required|max:255',
            'description' => 'required|max:1000',
            'price' => 'required|min:1',
            'author_id' => 'required|min:1',
        ];

        $this->validate($request, $rules);

        $book = Book::create($request->all());

        return $this->successResponse($book, Response::HTTP_CREATED);
    }

    /**
     * Return an specific book
     * @param int $book
     * @return JsonResponse
     */
    public function show(int $book): JsonResponse
    {
        $book = Book::findOrFail($book);

        return $this->successResponse($book);
    }

    /**
     * Update the information of an existing book
     * @param Request $request
     * @param int $book
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, int $book): JsonResponse
    {
        $rules = [
            'title' => 'max:255',
            'description' => 'max:1000',
            'price' => 'min:1',
            'author_id' => 'min:1',
        ];

        $this->validate($request, $rules);

        $book = Book::findOrFail($book);

        $book->fill($request->all());

        if ($book->isClean()) {
            return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $book->save();

        return $this->successResponse($book);
    }

    /**
     * Removes an existing book
     * @return JsonResponse
     */
    public function destroy($book)
    {
        $book = Book::findOrFail($book);

        $book->delete();

        return $this->successResponse($book);
    }
}
