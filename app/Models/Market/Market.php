<?php

namespace App\Models\Market;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Market extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'address', 'identification', 'market_phone', 'mobile', 'postal_code', 'email', 'lat', 'lang', 'market_type', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
