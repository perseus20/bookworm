<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\Book;

class BookRepository extends RepositoryAbstract
{
    public function getAll()
    {
        return Book::all();
    }
    public function getById($bookId)
    {
        return Book::findOrFail($bookId);
    }
    public function delete($bookId)
    {
        Book::destroy($bookId);
    }
    public function create(array $bookDetails)
    {
        return Book::create($bookDetails);
    }
    public function update($bookId, array $newDetails)
    {
        return Book::whereId($bookId)->update($newDetails);
    }

    public function getOnSale()
    {
        $books = Book::join('discount', 'book.id', '=', 'discount.book_id')
            ->where('discount_start_date', '<=', date('Y-m-d'))
            ->where(function ($query) {
                $query->where('discount_end_date', '>=', date('Y-m-d'))
                    ->orwhereNull('discount_end_date');
            })
            ->take(10)
            ->get();
        return $books;
    }

    public function getFeaturedBooks()
    {
    }
}
