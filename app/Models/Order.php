<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string|null $name
 * @property string|null $Phone
 * @property string|null $email
 * @property string|null $address
 * @property int|null $user_id
 * @property float $total
 * @property string $payment_method
 * @property string $payment_status
 * @property string|null $transaction_id
 * @property string $status
 * @property string|null $note
 */
class Order extends Model
{
    protected $fillable = [
        'name',
        'Phone',
        'email',
        'address',
        'user_id',
        'total',
        'payment_method',
        'payment_status',
        'transaction_id',
        'status',
        'note',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_items', 'order_id', 'product_id')
            ->withPivot('quantity', 'price', 'product_name');
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

}
