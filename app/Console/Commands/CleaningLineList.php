<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class CleaningLineList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cleaning:linelist {--part=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Melakukan format data tanggal sesuai aturan yang berlaku';

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
        $part = @$this->option('part');
        $this->info("Menjalankan Cleaning Line List - ".now()->format('Y-m-d H:i:s'));

        $this->info("");
        if($part == 0 or $part == 1){
            $this->info("Cleaning Tanggal Lapor");
            $lapor = DB::table("line_list_nar")->select("id","tanggal_lapor")->whereRaw('length(tanggal_lapor) < 10 and tanggal_lapor != "0/0/0"')->get();
            $this->output->progressStart($lapor->count());
            foreach ($lapor as $i){
                $split = explode("/",$i->tanggal_lapor);
                $date = (int) $split[0];
                $date = ($date<=9)?"0".$date:$date;
                $month = (int) $split[1];
                $month = ($month<=9)?"0".$month:$month;
                $year = $split[2];
                $tanggalLapor = $date."/".$month."/".$year;
                DB::table('line_list_nar')->where('id', $i->id)
                    ->update(['tanggal_lapor' => $tanggalLapor]);
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
            $this->info("End Cleaning Tanggal Lapor");
        }

        if($part == 0 or $part == 2){
            $meninggal = DB::table("line_list_nar")->select("id","tanggal_meninggal")->whereRaw('length(tanggal_meninggal) < 10 and tanggal_meninggal != "0/0/0"')->get();

            $this->info("");
            $this->info("Cleaning Meninggal");
            $this->output->progressStart($meninggal->count());
            foreach ($meninggal as $i){
                $split = explode("/",$i->tanggal_meninggal);
                $date = (int) $split[0];
                $date = ($date<=9)?"0".$date:$date;
                $month = (int) $split[1];
                $month = ($month<=9)?"0".$month:$month;
                $year = $split[2];
                $tanggalMeninggal = $date."/".$month."/".$year;
                DB::table('line_list_nar')->where('id', $i->id)
                    ->update(['tanggal_meninggal' => $tanggalMeninggal]);
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
            $this->info("End Cleaning Meninggal");
        }

        if($part == 0 or $part == 3){
            $sembuh = DB::table("line_list_nar")->select("id","tanggal_sembuh")->whereRaw('length(tanggal_sembuh) < 10 and tanggal_sembuh != "0/0/0"')->get();

            $this->info("");
            $this->info("Cleaning Sembuh");
            $this->output->progressStart($sembuh->count());
            foreach ($sembuh as $i){
                $split = explode("/",$i->tanggal_sembuh);
                $date = (int) $split[0];
                $date = ($date<=9)?"0".$date:$date;
                $month = (int) $split[1];
                $month = ($month<=9)?"0".$month:$month;
                $year = $split[2];
                $tanggalSembuh = $date."/".$month."/".$year;
                DB::table('line_list_nar')->where('id', $i->id)
                    ->update(['tanggal_sembuh' => $tanggalSembuh]);
                $this->output->progressAdvance();
            }
            $this->output->progressFinish();
            $this->info("End Cleaning Sembuh");
        }

        $this->info("Berhasil menjalankan Cleaning Line List - ".now()->format('Y-m-d H:i:s'));
    }
}
