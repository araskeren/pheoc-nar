<?php

namespace App\Exports\Nar;

use App\Area;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Facades\Excel;

class AnalyticExportWeekly implements WithMultipleSheets
{
    protected $provName;

    /**
     * AnalyticExportWeekly constructor.
     * @param $provName
     */
    public function __construct(String $provName = null)
    {
        $this->provName = $provName;
    }


    public function sheets(): array
    {
        $sheet = [];
        $prov = $this->provName;
        if($prov){
            $area = Area::select('id','name')->where(["name"=>$prov,"level"=>1])->first();
            $sheet[] = new AnalyticSheetDaily($area->name,$area->id,'DAILY '.$area->name);
            $sheet[] = new AnalyticSheetWeekly($area->name,$area->id,'WEEKLY '.$area->name);
        }else{
            $area = Area::select('id','name')->where("level",1)->get();
            foreach($area as $i){
                $sheet[] = new AnalyticSheetDaily($i->name,$i->id,'DAILY '.$i->name);
                $sheet[] = new AnalyticSheetWeekly($i->name,$i->id,'WEEKLY '.$i->name);
            }
        }

        return $sheet;
    }
}
