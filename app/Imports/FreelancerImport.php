<?php

namespace App\Imports;

use App\Models\Freelancer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FreelancerImport implements ToModel,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Freelancer([
            'created_at' => $row[0],
            'name' => $row[1],
            'age' => $row[2],
            'country' => $row[3],
            'type' => $row[4],
            'certificate' => $row[5],
            'main_field_id' => $row[6],
            'sub_field_id' => $row[7],
            'products' => $row[8],
            'languages' => $row[9],
            'wphone' => $row[10],
            'vphone' => $row[11],
            'email' => $row[12],
            'cv' => $row[13],
            // 'user_id' => $row[13],
        ]);
    }
}
