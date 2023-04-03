<?php

namespace App\Models;

use App\Traits\UUIDAsPrimaryKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory, UUIDAsPrimaryKey;
    protected $guarded;

    public function category()
    {
        $this->belongsTo(Categorie::class, 'category_id');
    }

    public function product()
    {
        $this->belongsTo(Product::class, 'product_id');
    }
}
