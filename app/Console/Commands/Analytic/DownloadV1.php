<?php

namespace App\Console\Commands\Analytic;

use App\Area;
use App\Exports\Nar\AnalyticExport;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Console\Command;

class DownloadV1 extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'analytic:downloadV1 {--prov=}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Melakukan Download Analisa Nar Mingguan V1';

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
        if(!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        if($prov){
            $area = Area::select('id','name')->where(["name"=>$prov,"level"=>1])->first();
            Excel::store(new AnalyticExport($area->id,$area->name),$path."/analytic_weekly_v1_".$area->name.".xlsx");
        }else{
            $area = Area::select('id','name')->where("level",1)->get();
            $this->output->progressStart($area->count());
            foreach($area as $i){
                Excel::store(new AnalyticExport($i->id,$i->name),$path."/analytic_weekly_v1_".$i->name.".xlsx");
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
        }

        $this->info("Berhasil Melakukan Download Analisa Minggguan NAR - ".now()->format('Y-m-d H:i:s'));
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
