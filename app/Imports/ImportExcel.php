<?php

namespace App\Imports;

use App\Models\FixedAsset;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportExcel implements ToCollection, ToModel
{
    private $num = 0;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        //dd($collection);
    }

    public function model(array $row)
    {
        $this->num ++;
        if($this->num > 1)
        {
            $fixedAssets = new FixedAsset();
            $fixedAssets->fa_category = $row[0];
            $fixedAssets->fa_number = $row[1];
            $fixedAssets->description = $row[2];
            $fixedAssets->cost = $row[3];
            $fixedAssets->nbv = $row[4];
            $fixedAssets->doc = $row[5];
            $fixedAssets->location = $row[6];
            $fixedAssets->save();
        }

        //dd($row);
    }
}
