<?php

namespace App\Http\Controllers;

use App\Models\BookAccess;
use App\Http\Requests\StoreBookAccessRequest;
use App\Http\Requests\UpdateBookAccessRequest;
use App\Http\Resources\BookAccessResource;
use App\Http\Resources\BookAccessCollection;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\Request;

class BookAccessController extends Controller
{
    public function index()
    {
        $book_accesses = QueryBuilder::for(BookAccess::class)
            ->allowedFields(['book_id', 'user_id', 'created_at', 'updated_at'])
            ->allowedIncludes(['book', 'user'])
            ->defaultSort('created_at')
            ->paginate();

            return new BookAccessCollection($book_accesses);
    }

    public function show(Request $request, BookAccess $book_access)
    {
        return new BookAccessResource($book_access);
    }

    public function store(StoreBookAccessRequest $request)
    {
            $validated = $request->validated();

            $book_access = BookAccess::create($validated);

            return new BookAccessResource($book_access);
    }

    public function update(UpdateBookAccessRequest $request, BookAccess $book_access)
    {
        $validated = $request->validated();

        $book_access->update($validated);

        return new BookAccessResource($book_access);
    }
}
