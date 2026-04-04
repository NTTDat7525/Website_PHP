<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Food extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category'];

    protected $table = 'foods';
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}