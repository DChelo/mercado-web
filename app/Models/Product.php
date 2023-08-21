<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Shopping;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
{
	use HasFactory, SoftDeletes;
	protected $fillable = [
		'category_id',
		'name',
		'price',
		'description',
		'stock',
		'color',
	];

	protected $appends = ['format_description'];

	public function FormatDescription(): Attribute{
		return Attribute::make(
			get: function ($value, $attributes) {
				return Str::limit($attributes['description'], 50, '...');
			}
		);
	}

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id', 'id');
	}

	public function shopping()
	{
		return $this->hasMany(Shopping::class, 'product_id', 'id');
	}

	public function file()
	{
		return $this->morphOne(File::class, 'fileable');
	}
}
