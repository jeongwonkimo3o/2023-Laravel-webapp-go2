<?php

namespace App\Http\Controllers;

use App\Models\Word;
use App\Models\WordTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;

class WordsController extends Controller
{
 // 단어장에 속한 단어들을 조회
 public function getWords(Request $request, $id)
 {
     // 현재 로그인한 유저의 ID를 가져옴
    $userId = Auth::id();

    // 로그인한 사용자가 접근 권한이 있는지 확인
    $hasAccess = WordTitle::whereHas('users', function ($query) use ($userId) {
        $query->where('users.id', $userId);
    })->where('id', $id)->exists();

    if (!$hasAccess) {
        // 접근 권한이 없으면 오류 메시지 반환
        return response()->json(['error' => '접근 권한이 없습니다.'], 403);
    }

    $words = Word::where('title_id', $id)->get();

    // ajax 요청에 따라 JSON 데이터 또는 Inertia 렌더링 반환
    if ($request->ajax()) {
        return response()->json($words);
    }

    return Inertia::render("WordDetail", ['words' => $words]);
  }
  
 
 // 해당 단어장에 단어를 추가
    public function addWord(Request $request)
    {
        $word = new Word();
        // 받은 모든 값을 한꺼번에 저장
        $word->fill($request->all());
        $word->save();
    
        return response()->json(['success' => '단어를 추가하였습니다.']);
    }

 // id값을 조회하여 단어를 삭제
  public function deleteWord($id)
  {
      $word = Word::find($id);
      $word->delete();
  
      return response()->json(['success' => '단어를 삭제하였습니다.']);
  }
}
