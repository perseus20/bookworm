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

    public function getSortOnSaleApi(Request $request)
    {
        $books = $this->bookRepository->getSortByOnSale($request);
        return BooksResource::collection($books);
    }

    public function getPopularApi()
    {
        $books = $this->bookRepository->getPopular();
        return BooksResource::collection($books);
    }

    public function getSortByPopularApi(Request $request)
    {
        $books = $this->bookRepository->getSortByPopular($request);
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

    public function getSortByFinalPriceAscApi(Request $request)
    {
        $books = $this->bookRepository->getSortByFinalPriceAsc($request);
        return BooksResource::collection($books);
    }

    public function getSortByFinalPriceDescApi(Request $request)
    {
        $books = $this->bookRepository->getSortByFinalPriceDesc($request);
        return $books = BooksResource::collection($books);
    }

    public function show(Book $book)
    {
        $book = $this->bookRepository->getById($book->id);
        return new BooksResource($book);
    }
}
