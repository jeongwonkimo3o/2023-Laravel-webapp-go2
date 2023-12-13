<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Word;
use App\Models\WordTitle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class WordTitlesController extends Controller
{
    // 업로드한 단어장 이름을 클라이언트에 반환
    public function getUploadWordTitles()
    {

        $userId = Auth::id(); // 현재 로그인한 유저의 ID를 가져옴

        // 중간 테이블 user_word_titles을 사용하여 현재 유저와 관련된 WordTitle들을 찾음
        $wordTitle = WordTitle::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })
            ->latest()
            ->first();

        return response()->json([$wordTitle]);
    }

    // 단어장 삭제
    public function deleteWordTitle($id)
    {

        $wordTitle = WordTitle::find($id); // 해당 ID를 가진 데이터를 조회

        if ($wordTitle) {
            // 해당 WordTitle에 연결된 모든 Word들을 삭제
            $wordTitle->words()->delete();

            // 해당 WordTitle과 연결된 모든 사용자 관계를 끊음
            $wordTitle->users()->detach();

            // WordTitle 자체를 삭제
            $wordTitle->delete();

            return response()->json(['success' => '단어장을 삭제(취소)하였습니다.']);
        }

        return response()->json(['error' => '단어장을 찾을 수 없습니다.'], 404);
    }

    // 유저가 업로드한 모든 단어장을 조회
    public function getAllWordTitles()
    {
        $userId = Auth::id(); // 현재 로그인한 유저의 ID를 가져옴

        // 현재 유저가 업로드한 모든 단어장을 조회
        $wordTitles = User::find($userId)->wordTitles;

        return response()->json($wordTitles); // JSON 형태로 반환
    }

    // 유저가 선택한 언어별로 단어장을 조회
    public function getWordTitlesByLang($lang)
    {
        $wordTitles = WordTitle::with('users')
            ->where('lang', $lang)->get();

        return response()->json($wordTitles);
    }
}
