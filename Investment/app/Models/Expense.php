<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

    protected $dates = ['date'];
    // Add user_id and other fields you want to mass assign to the $fillable property
    protected $fillable = [
        'user_id', 
        'title',
        'category',
        'amount',
        'date',
    ];

    /**
     * Define the relationship with the User model.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
