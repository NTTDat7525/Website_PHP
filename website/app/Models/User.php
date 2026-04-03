<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $fillable = ['name', 'email', 'password', 'role', 'phone'];
    protected $hidden = ['password'];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    
    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    
    public function isCustomer()
    {
        return $this->role === 'customer';
    }
}
