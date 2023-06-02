<?php

namespace App\Models;

use App\Http\Controllers\Api\BasketController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'user_id', 'product_id', 'amount'];
}
