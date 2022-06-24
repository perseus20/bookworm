<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'book';

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function discounts()
    {
        return $this->hasOne(Discount::class);
    }

    protected $book_final_price = ['book_final_price'];

    // public function getBookFinalPriceAttribute()
    // {
    //     $book = Book::where('id', $this->id)->first();
    //     $discount_price = Discount::where('discount.book_id', '=', $book->id)
    //         ->where('discount_start_date', '<=', date('Y-m-d'))
    //         ->where(function ($query) {
    //             $query->where('discount_end_date', '>=', date('Y-m-d'))
    //                 ->orWhereNull('discount_end_date');
    //         })->first();
    //     $book_final_price = $discount_price->discount_price ?? $book->book_price;
    //     return $book_final_price;
    // }
    public function getBookFinalPriceAttribute()
    {
        $book_final_price = $this->discounts->discount_price ?? $this->book_price;
        return $book_final_price;
    }
}
