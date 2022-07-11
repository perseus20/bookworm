<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthorsController;
use App\Http\Controllers\CategoriesController;


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
Route::get('/authors/', [AuthorsController::class, 'index']);
Route::get('/categories/', [CategoriesController::class, 'index']);
Route::get('/books/get-on-sale', [BooksController::class, 'getOnSaleApi']);
Route::get('/books/get-popular', [BooksController::class, 'getPopularApi']);
Route::get('/books/get-recommended', [BooksController::class, 'getRecommendedApi']);
Route::get('/books/get-sort-by-on-sale', [BooksController::class, 'getSortOnSaleApi']);
Route::get('/books/get-sort-by-recommended', [BooksController::class, 'getSortByRecommendedApi']);
Route::get('/books/get-sort-by-popular', [BooksController::class, 'getSortByPopularApi']);
Route::get('/books/get-sort-by-final-price-asc', [BooksController::class, 'getSortByFinalPriceAscApi']);
Route::get('/books/get-sort-by-final-price-desc', [BooksController::class, 'getSortByFinalPriceDescApi']);
Route::get('/books/get-sort-by-popular', [BooksController::class, 'getSortByPopularApi']);
Route::get('/books/show/{id}', [BooksController::class, 'show']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});
