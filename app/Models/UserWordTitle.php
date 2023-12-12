<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWordTitle extends Model


{
    protected $table = 'user_word_titles';

    protected $fillable = ['user_id', 'word_title_id'];
}
