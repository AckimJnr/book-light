<?php

namespace App\Http\Controllers;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookResource;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Spatie\QueryBuilder\QueryBuilder;
use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = QueryBuilder::for(Book::class)
            ->allowedFields(['title', 'total_pages', 'rating', 'isbn', 'publisher', 'published_date', 'book_url', 'author_account_id'])
            ->allowedFilters(['title', 'total_pages', 'rating', 'isbn', 'publisher', 'published_date', 'book_url', 'author_account_id'])
            ->allowedSorts(['title', 'total_pages', 'rating', 'isbn', 'publisher', 'published_date', 'book_url', 'author_account_id'])
            ->allowedIncludes(['author'])
            ->defaultSort('created_at')
            ->paginate();

            return new BookCollection($books);
    }

    public function show(Request $request, Book $book)
    {
        return new BookResource($book);
    }

    public function store(StoreBookRequest $request)
    {
        $validated = $request->validated();

        $book = Book::create($validated);

        return new BookResource($book);
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $validated = $request->validated();

        $book->update($validated);

        return new BookResource($book);
    }
    public function destroy(Request $request, Book $book)
    {
        $book->delete();

        return response()->noContent();
    }
}
