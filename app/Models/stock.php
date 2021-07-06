<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stock extends Model
{
    protected $table = 'stocks';
   

    protected $fillable = ['name', 'description', 'category_id', 'expiredate', 'supplierprice', 'stock_alert', 'item_taken', 'stock_img'];

    public function category()
    {
        return $this->belongsTo('App\Models\category');   
    }
}
