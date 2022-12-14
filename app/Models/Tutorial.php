<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'body',
    ];


    //tutorial dimiliki 1 user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //tutorial memiliki banyak comment
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
