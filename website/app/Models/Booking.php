<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'table_id', 'date', 'time', 'guest_count', 'status', 'email', 'phone', 'special_requests', 'total_price', 'payment_method', 'payment_status'];
    protected $dates = ['date', 'time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}