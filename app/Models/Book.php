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

    public function getBookFinalPriceAttribute()
    {
        $book_final_price = $this->final_price;
        return $book_final_price;
    }

    public function scopeGetFinalPrice($query)
    {
        return $query->leftJoin('discount', 'book.id', '=', 'discount.book_id')
            ->selectRaw('case when discount.discount_start_date <= now() and 
    (discount.discount_end_date >= now()  or 
    discount.discount_end_date is null)
	then discount.discount_price
	else book.book_price
    end as final_price,book.*');
    }

    public function scopeOnSale($query)
    {
        return $query->join('discount', 'discount.book_id', '=', 'book.id')
            ->selectRaw('book.id, book.book_price, book.author_id,book.category_id, book.book_title, book.book_cover_photo,
            discount.discount_price as final_price,
            (book.book_price - discount.discount_price) as sub_price')
            ->where('discount_start_date', '<=', date('Y-m-d'))
            ->where(function ($query) {
                $query->where('discount_end_date', '>=', date('Y-m-d'))
                    ->orWhereNull('discount_end_date');
            })
            ->orderBy('sub_price', 'desc');
    }

    public function scopeRecommended($query)
    {
        return $query->join('review', 'book.id', '=', 'review.book_id')
            ->selectRaw('book.*,avg(rating_start) as stars')
            ->groupBy('book.id', 'discount.discount_start_date', 'discount.discount_end_date', 'discount.discount_price')
            ->orderBy('stars', 'desc')
            ->getFinalPrice()
            ->orderBy('final_price');
    }

    public function scopePopular($query)
    {
        return $query->join('review', 'book.id', '=', 'review.book_id')
            ->selectRaw('book.*,count(review.id) as popular')
            ->groupBy('book.id', 'discount.discount_start_date', 'discount.discount_end_date', 'discount.discount_price')
            ->orderBy('popular', 'desc')
            ->getFinalPrice()
            ->orderBy('final_price');
    }

    public function scopeStars($query)
    {
        return $query->join('review', 'book.id', '=', 'review.book_id')
            ->selectRaw('book.*,avg(rating_start) as stars')
            ->groupBy('book.id', 'discount.discount_start_date', 'discount.discount_end_date', 'discount.discount_price')
            ->orderBy('stars', 'desc');
    }
}
