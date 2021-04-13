<?php

namespace App\Exports\Nar;

use App\Area;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class AnalyticSheetWeekly implements FromView,WithTitle
{
    protected $title;
    protected $provName;
    protected $provId;

    /**
     * PKMExportSheets constructor.
     * @param String $provName
     * @param String $provId
     * @param String $title
     */
    public function __construct(String $provName,String $provId,String $title)
    {
        $this->provName = $provName;
        $this->provId = $provId;
        $this->title = $title;
    }

    public function view(): \Illuminate\Contracts\View\View
    {
        $listDate = $this->getListDate();
        $data = $this->getData($this->provName,$this->provId,'2021-01-03');
        $kabKota = Area::getDistrict($this->provId)->select("id",'name')->get();
        return view('exports.nar.analytic_weekly', [
            'datas' => $data,'kabKota' => $kabKota,'listDate' => $listDate
        ]);
    }

    public function title(): string
    {
        return $this->title;
    }

    private function getListDate()
    {
        return DB::select("
            with recursive
            cte_list_date as (
                select CAST('2021-01-03' as DATE) as tanggal,week(CAST('2021-01-03' as DATE)) as bulan_minggu
                union all
                select CAST(tanggal + interval 1 day as DATE),week(CAST(tanggal + interval 1 day as DATE)) as bulan_minggu
                from cte_list_date
                where tanggal < (select max(tanggal_lapor) from line_list_nar)
            )
            select
            bulan_minggu,
            min(tanggal) as awal,
            max(tanggal) as akhir
            from cte_list_date
            group by bulan_minggu
        ");
    }

    private function getData($provName = "JAWA TENGAH",$provId = 32676,$date = '2020-03-04')
    {
        return DB::select("
            with recursive
            cte_list_date as (
                select CAST('".$date."' as DATE) as tanggal,week(CAST('".$date."' as DATE)) as bulan_minggu
                union all
                select CAST(tanggal + interval 1 day as DATE),week(CAST(tanggal + interval 1 day as DATE)) as bulan_minggu
                from cte_list_date
                where tanggal < (select max(tanggal_lapor) from line_list_nar)
            ),
            cte_list_date_weekly as (
                select *,
                   min(tanggal) over (partition by bulan_minggu) as awal,
                   max(tanggal) over (partition by bulan_minggu) as akhir
                from cte_list_date
            ),
            kab as (
                select id,parent_id,name,kdc
                from area
                where level = 2
                  and parent_id = '".$provId."'
            ),
            cte_kab_date as (
                select *
                from kab
                         cross join cte_list_date
            ),
            cte_konfirmasi_harian as (
                select tanggal_lapor, kabupaten, count(*) as total_konfirm_harian
                from line_list_nar
                where tanggal_lapor <> '2000-00-00' and tanggal_lapor >= '".$date."'
                group by tanggal_lapor, kabupaten
            ),
            cte_sembuh_harian as (
                select tanggal_sembuh, kabupaten, count(*) as total_sembuh_harian
                from line_list_nar
                where tanggal_sembuh <> '2000-00-00' and tanggal_lapor >= '".$date."'
                group by tanggal_sembuh, kabupaten
            ),
            cte_meninggal_harian as (
                select tanggal_meninggal, kabupaten, count(*) as total_meninggal_harian
                from line_list_nar
                where tanggal_meninggal <> '2000-00-00' and tanggal_lapor >= '".$date."'
                group by tanggal_meninggal, kabupaten
            ),
            cte_test_harian as (
                select tgl,
                       faskes_kabnm,
                       sum(jml_spesimen_negatif +
                           jml_spesimen_dalam_proses +
                           jml_spesimen_inkonklusif +
                           jml_spesimen_invalid +
                           jml_spesimen_positiff) as total_test_harian,
                       sum(jml_spesimen_negatif)  as total_test_negatif
                from analytic_spesiment_nar
                where faskes_propnm = '".$provName."'
                  and faskes_kabnm is not null and tgl >= '".$date."'
                group by tgl, faskes_kabnm
            ),
            cte_test_komulatif as (
                select tgl,
                       faskes_kabnm,
                       total_test_harian,
                       total_test_negatif
                from cte_test_harian
            ),
            cte_agg as (
                select kd.name                                             as kabupaten,
                       kd.tanggal,
                       coalesce(total_konfirm_harian, 0)                   as total_konfirm_harian,
                       coalesce(total_sembuh_harian, 0)                    as total_sembuh_harian,
                       coalesce(total_meninggal_harian, 0)                 as total_meninggal_harian,
                       coalesce(total_test_negatif, 0)                     as total_test_negatif,
                       sum(coalesce(total_konfirm_harian, 0))
                           over (partition by kd.name order by kd.tanggal) as total_konfirm_kumulatif,
                       sum(coalesce(total_sembuh_harian, 0))
                           over (partition by kd.name order by kd.tanggal) as total_sembuh_kumulatif,
                       sum(coalesce(total_meninggal_harian, 0))
                           over (partition by kd.name order by kd.tanggal) as total_meninggal_kumulatif,
                       sum(coalesce(total_test_negatif, 0))
                           over (partition by kd.name order by kd.tanggal) as total_test_negatif_kumulatif
                from cte_kab_date kd
                         left join cte_konfirmasi_harian kk
                                   on kk.tanggal_lapor = kd.tanggal and
                                      kk.kabupaten = kd.name
                         left join cte_sembuh_harian sk
                                   on sk.tanggal_sembuh = kd.tanggal and
                                      sk.kabupaten = kd.name
                         left join cte_meninggal_harian mk
                                   on mk.tanggal_meninggal = kd.tanggal and
                                      mk.kabupaten = kd.name
                         left join cte_test_komulatif tk
                                   on tk.tgl = kd.tanggal and
                                      tk.faskes_kabnm = kd.name
                order by kd.name, kd.tanggal
            )
        select
        awal,
        akhir,
        bulan_minggu,
        kabupaten,
        sum(total_konfirm_harian) as total_konfirm_mingguan,
        sum(total_konfirm_kumulatif) as total_konfirm_mingguan_kumulatif,
        sum(total_sembuh_harian) as total_sembuh_mingguan,
        sum(total_sembuh_kumulatif) as total_sembuh_mingguan_kumulatif,
        sum(total_meninggal_harian) as total_meninggal_mingguan,
        sum(total_meninggal_kumulatif) as total_meninggal_mingguan_kumulatif,
        sum(total_test_negatif) as total_test_mingguan_negatif,
        sum(total_test_negatif_kumulatif) as total_test_negatif_mingguan_kumulatif
        from cte_list_date_weekly
        join cte_agg on cte_agg.tanggal = cte_list_date_weekly.tanggal
        group by bulan_minggu, akhir, awal, kabupaten;
        ");
    }
}
