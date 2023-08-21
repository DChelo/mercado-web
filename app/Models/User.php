<?php

namespace App\Models;

use App\Models\Shopping;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasRoles, HasApiTokens, HasFactory, Notifiable, SoftDeletes;
    protected $fillable = [
        'number_id',
        'name',
        'last_name',
        'email',
        'password',
    ];

	protected $appends = ['full_name'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

	// Casting
    // protected $casts = [
    //     'created_at' => 'datatime:Y-m-d',
    //     'updated_at' => 'datatime:Y-m-d',
    // ];

	// Accesores
	public function getFullNameAttribute()
	{
		return "{$this->name} {$this->last_name}";
	}

	// Mutadores
	public function setRememberTokenAttribute()
	{
		$this->attributes['remember_token'] = Str::random(30);
	}
	// Mutadores
	public function setPasswordAttribute($value)
	{
		$this->attributes['password'] = bcrypt($value);
	}


	public function customerShopping()
	{
		return $this->hasMany(Shopping::class, 'customer_user_id', 'id');
	}

}
