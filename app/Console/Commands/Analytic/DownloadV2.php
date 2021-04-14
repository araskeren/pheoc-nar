<?php

namespace App\Console\Commands\Analytic;

use App\Area;
use App\Exports\Nar\AnalyticExport;
use App\Exports\Nar\AnalyticExportWeekly;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\File;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;

class DownloadV2 extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'analytic:downloadV2 {--prov=}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Melakukan Download Analisa Nar Mingguan';

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
        Excel::store(new AnalyticExportWeekly($prov),$path."/analytic_weekly_v2.xlsx");

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
