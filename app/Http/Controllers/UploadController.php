<?php

namespace App\Http\Controllers;

use App\Imports\CsvUploadImport;
use Illuminate\Http\Request;
use App\Models\WordTitle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = $request->file('file');

        // 파일 이름 추출해서 word_title에 저장
        $filenameWithExtension = $file->getClientOriginalName();
        $filename = pathinfo($filenameWithExtension, PATHINFO_FILENAME);

        // 타이틀 저장 테스트
        $word_title = new WordTitle();
        $word_title->title = $filename;
        $word_title->save();
        Log::info("WordTitle saved with ID: " . $word_title->id);

        $user = Auth::user();
        $user->wordTitles()->attach($word_title->id);

        // 단어 저장
        try {
            Excel::import(new CsvUploadImport($word_title->id), $file); 
        } catch (\Throwable $e) {
            // 오류 로깅
            Log::error($e->getMessage());
            // 또는 사용자에게 오류 메시지 반환
            return response()->json(['error' => $e->getMessage()], 500);
        }

    return redirect()->back()->with('message', '단어가 성공적으로 저장되었습니다.');
}

    // 받아온 id 값을 토대로 단어장의 언어를 설정
    public function updateLanguage(Request $request, $id) {
        Log::info("updateLanguage called with ID: " . $id);
        $word_title = WordTitle::find($id);
        $word_title->lang = $request->lang;
        $word_title->save();

        return response()->json(['success' => '단어장의 언어가 설정되었습니다.']);
    }
}
