<?php

namespace App\Models;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shopping extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'customer_user_id',
        'product_id',
		'status'
    ];

	public function product()
	{
		return $this->belongsTo(Product::class, 'product_id', 'id');
	}

	public function customer()
	{
		return $this->belongsTo(User::class, 'customer_user_id', 'id');
	}
}
