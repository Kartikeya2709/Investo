<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'amount_invested',
        'annual_return_percentage',
        'investment_date',
        'compounding',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
