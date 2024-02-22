<?php

namespace App\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $hasAccess = $this->bookAccess()->where('account_id', auth()->id())->exists();
        return [
            'id' => $this->book_id,
            'title' => $this->title,
            'total_pages' => $this->total_pages,
            'rating' => $this->rating,
            'isbn' => $this->isbn,
            'publisher' => $this->publisher,
            'published_date' => $this->published_date,
            'book_url' => $this->book_url,
            'author' => $this->author_name,
            'has_access'=> $hasAccess,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}