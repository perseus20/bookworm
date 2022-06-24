<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AuthorsController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::apiResource('/books', BooksController::class);
// Route::apiResource('/authors', AuthorsController::class);
Route::get('/books/get-on-sale', [BooksController::class, 'getOnSaleApi']);
Route::get('/books/get-popular', [BooksController::class, 'getPopularApi']);
Route::get('/books/get-recommended', [BooksController::class, 'getRecommendedApi']);
Route::get('/books/get-sort-by-on-sale', [BooksController::class, 'getSortOnSaleApi']);
Route::get('/books/get-sort-by-recommended', [BooksController::class, 'getSortByRecommendedApi']);
Route::get('/books/get-sort-by-popular', [BooksController::class, 'getSortByPopularApi']);
Route::get('/books/get-sort-by-final-price-asc', [BooksController::class, 'getSortByFinalPriceAscApi']);
Route::get('/books/get-sort-by-final-price-desc', [BooksController::class, 'getSortByFinalPriceDescApi']);
Route::get('/books/get-sort-by-popular', [BooksController::class, 'getSortByPopularApi']);
Route::get('/books/test', [BooksController::class, 'testApi']);
Route::get('/books/test2', [BooksController::class, 'test2Api']);
Route::get('/books/get-final-price/{book}', [BooksController::class, 'getFinalPriceApi']);
