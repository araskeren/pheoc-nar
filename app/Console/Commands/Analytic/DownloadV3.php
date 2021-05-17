<?php

namespace App\Console\Commands\Analytic;

use App\Area;
use App\Exports\Nar\AnalyticExportV2;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class DownloadV3 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'analytic:downloadV3 {--prov=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan Download Analisa Nar Mingguan V3';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $prov = @$this->option('prov');
        $this->info("Menjalankan Download Analisa Minggguan NAR - ".now()->format('Y-m-d H:i:s'));
        $current_date = Carbon::now();
        $path = "download/".$current_date->format('Y-m-d').'/nar';
        if($prov){
            $area = Area::select('id','name')->where(["name"=>$prov,"level"=>1])->first();
            Excel::store(new AnalyticExportV2($area->id,$area->name),$path."/analytic_weekly_v1_".$area->name.".xlsx");
        }else{
//            $area = Area::select('id','name')->where("level",1)->get();
            $area = Area::select('id','name')->where("level",1)->whereIn('name',['JAWA TENGAH','KALIMANTAN TIMUR','KALIMANTAN BARAT','KALIMANTAN TENGAH'])->get();
            $this->output->progressStart($area->count());
            foreach($area as $i){
                Excel::store(new AnalyticExportV2($i->id,$i->name),$path."/analytic_weekly_v1_".$i->name.".xlsx");
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
        }

        $this->info("Berhasil Melakukan Download Analisa Minggguan NAR - ".now()->format('Y-m-d H:i:s'));
    }
}
