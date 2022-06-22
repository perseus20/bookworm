<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\Book;
use App\Models\Discount;
use Illuminate\Support\Facades\DB;

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
        $books = Book::join('discount', 'discount.book_id', '=', 'book.id')
            ->select(DB::raw('book.*, (book.book_price - discount.discount_price) as sub_price'))
            ->where('discount_start_date', '<=', date('Y-m-d'))
            ->where(function ($query) {
                $query->where('discount_end_date', '>=', date('Y-m-d'))
                    ->orWhereNull('discount_end_date');
            })
            ->orderBy('sub_price', 'asc')
            ->take(config('app.get_on_sale'))
            ->get();
        return $books;
    }

    public function getRecommendedBooks()
    {
        $books = Book::join('review', 'book.id', '=', 'review.book_id')
            ->select(DB::raw('book.*, avg(review.rating_start) as stars,(book.book_price - discount.discount_price) as sub_price '))
            ->groupBy('book.id', 'discount.discount_price')
            ->orderBy('stars', 'desc')
            ->join('discount', 'discount.book_id', '=', 'book.id')
            ->orderBy('sub_price', 'asc')
            ->take(config('app.get_recommmanded'))
            ->get();
        return $books;
    }

    public function getPopular()
    {
        $books = Book::join('review', 'book.id', '=', 'review.book_id')
            ->select(DB::raw('book.*, count(review.id) as popular,(book.book_price - discount.discount_price) as sub_price '))
            ->groupBy('book.id', 'discount.discount_price')
            ->orderBy('popular', 'desc')
            ->join('discount', 'discount.book_id', '=', 'book.id')
            ->orderBy('sub_price', 'asc')
            ->take(config('app.get_popular'))
            ->get();
        return $books;
    }

    // public function getFinalPrice(Book $book)
    // {
    //     $discount_price = Discount::where('discount.book_id', '=', $book->id)
    //         ->where('discount_start_date', '<=', date('Y-m-d'))
    //         ->where(function ($query) {
    //             $query->where('discount_end_date', '>=', date('Y-m-d'))
    //                 ->orWhereNull('discount_end_date');
    //         })->first();
    //     $discount_price = $discount_price->discount_price ?? 0;
    //     $book_final_price = $book->book_price - $discount_price;
    //     return $book_final_price;
    // }

    public function getListPagination($type)
    {
        return Book::paginate($type);
    }
}
