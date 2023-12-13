<?php

namespace App\Http\Controllers;

use App\Exports\CSVWordsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class CSVExportController extends Controller
{
    public function export($wordTitleId)
    {
        // 현재 인증된 사용자의 ID를 가져옴
        $userId = Auth::id();


        // RFC 5987 지원하지 않는 브라우저에서 한글 파일명이 깨지는 문제 있음.. -> 단어장 id 값으로 파일명 설정해주기로 함
        // CSVWordsExport 클래스 인스턴스를 생성하고, Excel 파일로 다운로드
        return Excel::download(new CSVWordsExport($userId, $wordTitleId), 'WordTitle-' . $wordTitleId . '.csv');
    }
}
