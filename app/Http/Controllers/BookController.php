<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Http\Resources\BooksResource;
use App\Http\Resources\BooksResourceCollection;
use App\Models\Book;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return $this->respondWithResourceCollection(new BooksResourceCollection(Book::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBookRequest $request
     * @return JsonResponse
     */
    public function store(StoreBookRequest $request): JsonResponse
    {
        $book = Book::create($request->validated());
        return $this->respondSuccess(['book' => new BooksResource($book)], 201, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function show(Book $book): JsonResponse
    {
        return $this->respondSuccess(new BooksResource($book), 200, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateBookRequest $request
     * @param Book $book
     * @return JsonResponse
     */
    public function update(UpdateBookRequest $request, Book $book): JsonResponse
    {
        $name  = $book->name;
        $book->update($request->validated());
        return $this->respondWithMessage(
            200,
            200,
            "The book " . $name . " was updated successfully",
            'success',
            new BooksResource($book->refresh()),
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Book $book
     * @return JsonResponse
     */
    public function destroy(Book $book): JsonResponse
    {
        $name = $book->name;
        $book->delete();
        return $this->respondWithMessage(Response::HTTP_NO_CONTENT, Response::HTTP_OK, "The book " . "'{$name}'" . " was deleted successfully");
    }
}
