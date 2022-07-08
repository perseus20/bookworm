<?php

namespace App\Repository;

use App\Repository\RepositoryAbstract;
use App\Models\Book;
use Illuminate\Http\Request;

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
        $books = Book::onSale()
            ->take(config('app.get_on_sale'))
            ->get();
        return $books;
    }

    public function getSortByOnSale(Request $request)
    {
        $books = Book::onSale();
        if ($request->category && $request->category != 0) {
            $books->where('category_id', $request->category);
        }
        if ($request->author && $request->author != 0) {
            $books->where('author_id', $request->author);
        }
        if ($request->star) {
            $books->stars()->havingRaw("avg(rating_start) >= $request->star");
        }
        if ($request->perPage) {
            $perPage = $request->perPage;
        } else {
            $perPage = config('app.perPage');
        }
        $books = $books->orderBy('final_price', 'asc')->paginate($perPage);
        $input = $request->input();
        $books->appends($input);
        return $books;
        return $books;
    }

    public function getRecommendedBooks()
    {
        $books = Book::Recommended()
            ->take(config('app.get_recommmended'))
            ->get();
        return $books;
    }

    public function getSortByRecommendedBooks()
    {
        $books = Book::Recommended()
            ->get();
        return $books;
    }

    public function getPopular()
    {
        $books = Book::Popular()
            ->take(config('app.get_popular'))
            ->get();
        return $books;
    }

    public function getSortByPopular(Request $request)
    {
        $books = Book::Popular();
        if ($request->category && $request->category != 0) {
            $books->where('category_id', $request->category);
        }
        if ($request->author && $request->author != 0) {
            $books->where('author_id', $request->author);
        }
        if ($request->star) {
            $books->havingRaw("avg(rating_start) >= $request->star");
        }
        if ($request->perPage) {
            $perPage = $request->perPage;
        } else {
            $perPage = config('app.perPage');
        }
        $books = $books->orderBy('final_price', 'asc')->paginate($perPage);
        $input = $request->input();
        $books->appends($input);
        return $books;
    }

    public function getSortByFinalPriceAsc(Request $request)
    {
        $books = Book::getFinalPrice();
        if ($request->category && $request->category != 0) {
            $books->where('category_id', $request->category);
        }
        if ($request->author && $request->author != 0) {
            $books->where('author_id', $request->author);
        }
        if ($request->star) {
            $books->stars()->havingRaw("avg(rating_start) >= $request->star");
        }
        if ($request->perPage) {
            $perPage = $request->perPage;
        } else {
            $perPage = config('app.perPage');
        }
        $books = $books->orderBy('final_price', 'asc')->paginate($perPage);
        $input = $request->input();
        $books->appends($input);
        return $books;
    }
    public function getSortByFinalPriceDesc(Request $request)
    {
        $books = Book::getFinalPrice();
        if ($request->category && $request->category != 0) {
            $books->where('category_id', $request->category);
        }
        if ($request->author) {
            $books->where('author_id', $request->author);
        }
        if ($request->star) {
            $books->stars()->havingRaw("avg(rating_start) >= $request->star");
        }
        if ($request->perPage) {
            $perPage = $request->perPage;
        } else {
            $perPage = config('app.perPage');
        }
        $books = $books->orderBy('final_price', 'desc')->paginate($perPage);
        $input = $request->input();
        $books->appends($input);
        return $books;
    }
}
