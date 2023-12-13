<?php
namespace App\Exports;

use App\Models\User;
use App\Models\WordTitle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;
use Illuminate\Support\Facades\Log;

/**
 * 특정 사용자의 특정 단어장의 단어들을 CSV 형식으로 내보내기 위한 클래스.
 */
class CSVWordsExport implements FromCollection, WithHeadings, WithTitle
{
    protected $userId;
    protected $wordTitleId;
    protected $wordTitleName;

    /**
     * 생성자.
     *
     * @param int $userId 사용자 ID.
     * @param int $wordTitleId 단어장 ID.
     */
    public function __construct(int $userId, int $wordTitleId)
    {
        $this->userId = $userId;
        $this->wordTitleId = $wordTitleId;
        $this->wordTitleName = WordTitle::where('id', $wordTitleId)->value('title');
        Log::info('WordTitle Name:', ['wordTitleId' => $wordTitleId, 'wordTitleName' => $this->wordTitleName]);

    }

    /**
     * Excel 파일에 포함될 컬렉션을 반환.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // 사용자의 특정 단어장을 조회
        $wordTitle = WordTitle::with(['words'])
            ->where('id', $this->wordTitleId)
            ->whereHas('users', function ($query) {
                $query->where('users.id', $this->userId);
            })
            ->first();
    
        $words = collect();
    
        if ($wordTitle) {
            foreach ($wordTitle->words as $word) {
                $words->push([
                    '단어' => $word->word,
                    '의미' => $word->mean,
                    '품사' => $word->pos,
                    '발음' => $word->pronunciation,
                    '동의어' => $word->synonym,
                    '반의어' => $word->antonym,
                    '설명' => $word->explain,
                ]);
            }
        }
    
        return $words;
    }

    /**
     * 엑셀 파일의 헤더를 정의.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            '단어', 
            '의미', 
            '품사', 
            '발음', 
            '동의어', 
            '반의어', 
            '설명'
        ];
    }

    /**
     * 생성될 엑셀 파일의 타이틀을 정의.
     *
     * @return string
     */
    public function title(): string
    {
      return $this->wordTitleName;
    }
}
