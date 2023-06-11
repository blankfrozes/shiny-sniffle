<?php

namespace App\Imports;

use App\Models\Tournament;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class WinnerImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new Tournament([
            'username'  => $row['Pemain'],
            'amount' => $row['TurnOver'],
        ]);
    }
}