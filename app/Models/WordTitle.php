<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WordTitle extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'title'
    // ];

    public function words()
    {
        return $this->hasMany(Word::class, 'title_id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_word_titles')->withTimestamps();
    }
}
