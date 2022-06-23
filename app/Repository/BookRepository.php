<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\Book;
use App\Models\Category;
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
            ->select(DB::raw('book.id,book.book_price,book.author_id,book.book_title,book.book_cover_photo, (book.book_price - discount.discount_price) as sub_price'))
            ->where('discount_start_date', '<=', date('Y-m-d'))
            ->where(function ($query) {
                $query->where('discount_end_date', '>=', date('Y-m-d'))
                    ->orWhereNull('discount_end_date');
            })
            ->orderBy('sub_price', 'desc')
            ->take(config('app.get_on_sale'))
            ->get();
        return $books;
    }

    public function getSortByOnSale()
    {
        $books = Book::leftJoin('discount', 'discount.book_id', '=', 'book.id')
            ->select(DB::raw('book.id,book.book_price,book.author_id,book.book_title,book.book_cover_photo,case 
	when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
	then book.book_price - discount.discount_price
	else 0
end as sub_price,case 
	when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
	then discount.discount_price
	else book.book_price
end as final_price'))
            ->orderBy('sub_price', 'desc')
            ->orderBy('final_price', 'asc')
            ->take(config('app.get_on_sale'))
            ->get();
        return $books;
    }

    public function getRecommendedBooks()
    {
        $books = Book::leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->select(
                DB::raw('book.id,book.book_price,book.author_id,book.book_title,book.book_cover_photo, avg(review.rating_start) as stars,discount.discount_price,
case 
	when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
	then discount.discount_price
	else book.book_price
end as final_price')
            )
            ->join('review', 'book.id', '=', 'review.book_id')
            ->groupBy('book.id', 'discount.discount_price', 'discount_start_date', 'discount_end_date')
            ->orderBy('stars', 'desc')
            ->orderBy('final_price', 'asc')
            ->take(config('app.get_recommmended'))
            ->get();
        return $books;
    }

    public function getSortByRecommendedBooks()
    {
        $books = Book::leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->select(
                DB::raw('book.id,book.book_price,book.author_id,book.book_title,book.book_cover_photo, avg(review.rating_start) as stars,discount.discount_price,
case 
	when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
	then discount.discount_price
	else book.book_price
end as final_price')
            )
            ->join('review', 'book.id', '=', 'review.book_id')
            ->groupBy('book.id', 'discount.discount_price', 'discount_start_date', 'discount_end_date')
            ->orderBy('stars', 'desc')
            ->orderBy('final_price', 'asc')
            ->get();
        return $books;
    }

    public function getPopular()
    {
        $books = Book::leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->select(
                DB::raw('book.id,book.book_price,book.author_id,book.book_title,book.book_cover_photo, count(review.id) as popular,discount.discount_price,
case 
	when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
	then discount.discount_price
	else book.book_price
end as final_price')
            )
            ->join('review', 'book.id', '=', 'review.book_id')
            ->groupBy('book.id', 'discount.discount_price', 'discount_start_date', 'discount_end_date')
            ->orderBy('popular', 'desc')
            ->orderBy('final_price', 'asc')
            ->take(config('app.get_popular'))
            ->get();
        return $books;
    }

    public function getSortByPopular()
    {
        $books = Book::leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->select(
                DB::raw('book.id,book.book_price,book.author_id,book.book_title,book.book_cover_photo, count(review.id) as popular,discount.discount_price,
case 
	when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
	then discount.discount_price
	else book.book_price
end as final_price')
            )
            ->join('review', 'book.id', '=', 'review.book_id')
            ->groupBy('book.id', 'discount.discount_price', 'discount_start_date', 'discount_end_date')
            ->orderBy('popular', 'desc')
            ->orderBy('final_price', 'asc')
            ->take(config('app.get_popular'))
            ->get();
        return $books;
    }

    public function getSortByFinalPriceAsc()
    {
        $books =
            Book::leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->select(
                DB::raw('book.id,book.book_price,book.author_id,book.book_title,book.book_cover_photo,discount.discount_price,
case 
	when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
	then discount.discount_price
	else book.book_price
end as final_price')
            )
            ->orderBy('final_price', 'asc')
            ->get();
        return $books;
    }
    public function getSortByFinalPriceDesc($id)
    {
        $books =
            Book::leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->select(
                DB::raw('book.id,book.category_id,discount.discount_price,
                case 
                when discount.discount_start_date <= now() and (discount.discount_end_date >= now()  or discount.discount_end_date is null)
                then discount.discount_price
                else book.book_price
                end as final_price')
            )
            ->join('category', 'book.category_id', '=', 'category.id')
            ->where('category.id', '=', $id)
            ->orderBy('final_price', 'desc')
            ->get();
        return $books;
    }

    public function test($id)
    {
        $categories = Category::with('books')->whereId($id);
        $categories = $categories->select(['id'])->get();
        return $categories;
    }
}
