<?php

namespace App\Console\Commands\Analytic;

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
    protected $signature = 'analytic:downloadV1';

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
        $this->info("Menjalankan Download Analisa Minggguan NAR - ".now()->format('Y-m-d H:i:s'));
        $current_date = Carbon::now();
        $path = "download/".$current_date->format('Y-m-d').'/nar';
        if(!File::exists($path)) {
            File::makeDirectory($path, 0755, true, true);
        }
        Excel::store(new AnalyticExport,$path."/analytic_weekly_v1.xlsx");

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
