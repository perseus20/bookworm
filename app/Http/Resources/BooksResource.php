<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BooksResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => (string)$this->id,
            'type' => 'Books',
            'attributes' => [
                'book_title' => $this->book_title,
                'book_cover' => $this->book_cover_photo,
                'book_summary' => $this->book_summary,
                'book_price' => $this->book_price,
            ]
        ];
    }
}
