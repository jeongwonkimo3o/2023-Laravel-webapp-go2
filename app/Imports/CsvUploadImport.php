<?php

namespace App\Imports;

use App\Models\TestWord;
use App\Models\Word;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CsvUploadImport implements ToModel, WithStartRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    private $titleId;

    public function __construct($titleId)
    {
        $this->titleId = $titleId;
        Log::info("CsvUploadImport created with titleId: " . $this->titleId);

    }

    
    public function model(array $row)
    {
        return new Word([
            'title_id' => $this->titleId,
            'word' => $row[0],
            'mean' => $row[1],
            'pos' => $row[2] ?? null,
            'pronunciation' => $row[3] ?? null,
            'synonym' => $row[4] ?? null,
            'antonym' => $row[5] ?? null,
            'explain' => $row[6] ?? null,
        ]);
    }

    public function startRow(): int
    {
        return 2;
    }
}
