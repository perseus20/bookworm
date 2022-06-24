<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BooksResource;
use App\Repository\BookRepository;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     *
     * @return \Illuminate\Http\Response
     */
    private BookRepository $bookRepository;

    public function __construct(BookRepository $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function getOnSaleApi()
    {
        $books = $this->bookRepository->getOnSale();
        return BooksResource::collection($books);
    }

    public function getSortOnSaleApi()
    {
        $books = $this->bookRepository->getSortByOnSale();
        return BooksResource::collection($books);
    }

    public function getFinalPriceApi(Book $book)
    {
        $book = new BooksResource($book);
        return ($book)->book_final_price;
    }

    public function getPopularApi()
    {
        $books = $this->bookRepository->getPopular();
        return BooksResource::collection($books);
    }

    public function getSortByPopularApi()
    {
        $books = $this->bookRepository->getSortByPopular();
        return BooksResource::collection($books);
    }

    public function getRecommendedApi()
    {
        $books = $this->bookRepository->getRecommendedBooks();
        return BooksResource::collection($books);
    }

    public function getSortByRecommendedApi()
    {
        $books = $this->bookRepository->getSortByRecommendedBooks();
        return BooksResource::collection($books);
    }

    public function getSortByFinalPriceAscApi()
    {
        $books = $this->bookRepository->getSortByFinalPriceAsc();
        return BooksResource::collection($books);
    }

    public function getSortByFinalPriceDescApi(Request $request)
    {
        $books = $this->bookRepository->getSortByFinalPriceDesc($request->get('cate'));
        return BooksResource::collection($books);
    }

    public function show(Book $book)
    {
        $book = $this->bookRepository->getById($book->id);
        return new BooksResource($book);
    }

    public function testApi()
    {
        $books = $this->bookRepository->test();
        return BooksResource::collection($books);
    }
    public function test2Api()
    {
        $books = $this->bookRepository->test2();
        // dd($books);
        // return $books;
        // return BooksResource::collection($books);
        $books = BooksResource::collection($books);
        return view('index')->with('books', $books);
    }
}
