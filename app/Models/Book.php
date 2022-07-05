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
end as final_price');
    }
}
