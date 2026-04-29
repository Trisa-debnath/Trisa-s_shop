<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
   
     protected $fillable = [
      'store_name', 'slug', 'details','user_id'  
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
