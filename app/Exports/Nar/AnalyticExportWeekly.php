<?php

namespace App\Exports\Nar;

use App\Area;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AnalyticExportWeekly implements WithMultipleSheets
{
    public function sheets(): array
    {
//        $provId = 1000064;
//        $provName = 'KALIMANTAN TIMUR';
        $sheet = [];
        $listProv = Area::whereIn('id',[1000064,1000014,1000019])->get();
        foreach($listProv as $prov){
            $sheet[] = new AnalyticSheetDaily($prov->name,$prov->id,'DAILY '.$prov->name);
            $sheet[] = new AnalyticSheetWeekly($prov->name,$prov->id,'WEEKLY '.$prov->name);
        }

        return $sheet;
    }
}
