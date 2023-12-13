<?php

namespace App\Http\Controllers;

use App\Models\UserWordTitle;
use App\Models\WordTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class StoreController extends Controller
{
    // word_titles에 있는 store 컬럼을 true로 바꿈

    public function toggleStoreWordTitle(Request $request, $id)
    {

        // 현재 로그인한 유저의 ID를 가져옴
        $userId = Auth::id();

        // 로그인한 사용자 해당 단어장에 권한이 있는지 확인
        $wordTitle = WordTitle::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->find($id);

        if (!$wordTitle) {
            // 접근 권한이 없거나 단어장이 존재하지 않으면 오류 메시지 반환
            return response()->json(['error' => '접근 권한이 없거나 단어장이 존재하지 않습니다.'], 403);
        }

        // store 컬럼을 true로 설정
        $wordTitle->store = true;
        $wordTitle->save();

        return response()->json(['success' => '단어장이 저장되었습니다.']);
    }

    public function getStoredWordTitles()
    {
        // store 컬럼이 true인 모든 WordTitle 조회, 연관된 사용자 정보 포함
        $storedWordTitles = WordTitle::with('users')
            ->where('store', true)
            ->get();

        return response()->json($storedWordTitles);
    }

    // 공유된 단어장을 저장하는 메서드
    public function downloadWordTitle(Request $request, $wordTitleId)
    {
        $userId = auth()->id(); // 현재 로그인한 사용자의 ID

        // user_word_titles에 사용자와 단어장 관계 저장
        UserWordTitle::firstOrCreate([
            'user_id' => $userId,
            'word_title_id' => $wordTitleId
        ]);

        return response()->json(['message' => 'Word title downloaded successfully']);
    }
    
}
