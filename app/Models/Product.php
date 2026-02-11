<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\category;
use App\Models\subcategory;
use App\Models\store;
use App\Models\User;
use App\Models\productimage;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Comment;
use App\Models\Review;


class Product extends Model
{
    protected $fillable = [
      'product_name',
      'description',
       'sku',
        'seller_id',
         'category_id',
          'subcategory_id',
           'store_id',
            'regular_price',
            'discount_percent',
             'discounted_price',
             'tax_rate',
             'stock_quantity',
             'stock_status',
             'slug',
             'visibility',
             'meta_title',
             'meta_description',
             'status'
    ];

       
    public function category() {
    return $this->belongsTo(Category::class, 'category_id');
}
    public function subcategory() {
    return $this->belongsTo(Subcategory::class);
}
    public function store() {
    return $this->belongsTo(Store::class);
}
    public function seller() {
    return $this->belongsTo(User::class);
}

public function images(){
    return $this->hasMany(Productimage::class);
}

public function orders()
{
    return $this->belongsToMany(Order::class, 'order_items')->withPivot('quantity');
}
public function orderItems()
{
    return $this->hasMany(OrderItem::class);
}

public function comments()
{
    return $this->hasMany(Comment::class)->whereNull('parent_id')->with('replies');
}

public function reviews()
{
    return $this->hasMany(Review::class)
                ->where('status','approved');
}




}
