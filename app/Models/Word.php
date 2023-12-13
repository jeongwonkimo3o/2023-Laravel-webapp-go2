<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Word extends Model
{
    use HasFactory;

    protected $fillable = [
      'title_id',      // 단어장 ID
      'word',          // 단어
      'mean',          // 의미
      'pos',           // 품사
      'pronunciation', // 발음
      'synonym',       // 동의어
      'antonym',       // 반의어
      'explain'        // 설명
     ];

     public function wordTitle()
     {
         return $this->belongsTo(WordTitle::class, 'title_id');
     }
    
}
