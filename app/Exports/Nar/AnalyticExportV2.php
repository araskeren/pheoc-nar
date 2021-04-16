<?php

namespace App\Exports\Nar;

use App\Area;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AnalyticExportV2 implements WithMultipleSheets
{
    protected $provId;
    protected $provName;

    /**
     * AnalyticExport constructor.
     * @param $provId
     * @param $provName
     */
    public function __construct(int $provId,String $provName)
    {
        $this->provId = $provId;
        $this->provName = $provName;
    }


    public function sheets(): array
    {
        $provId = $this->provId;
        $provName = $this->provName;
        $area = Area::getDistrict($provId)->select("id",'name')->get();
        $sheet = [];
        $data = $this->getData($provName,$provId);
        foreach($area as $i){
            $_data = [];
            if($data){
                foreach($data as $j){
                    if($i->name == $j->kabupaten){
                        $_data[] = $j;
                    }
                }
            }
            $sheet[] = new AnalyticSheetV2($_data,$i->name);
        }
        return $sheet;
    }

    private function getData($provName = "JAWA TENGAH",$provId = 32676)
    {
        // Update Data
//        DB::statement("
//            update line_list_nar
//            set tanggal_lapor = DATE_FORMAT('2017-06-15', STR_TO_DATE(tanggal_lapor, '%d/%m/%Y')),
//                tanggal_sembuh = DATE_FORMAT('2017-06-15', STR_TO_DATE(tanggal_sembuh, '%d/%m/%Y')),
//                tanggal_meninggal = DATE_FORMAT('2017-06-15', STR_TO_DATE(tanggal_meninggal, '%d/%m/%Y'))
//
//        ");

        return DB::select("
        with recursive
        cte_list_date as (
            select CAST('2020-02-01' as DATE) as tanggal
            union all
            select CAST(tanggal + interval 1 day as DATE)
            from cte_list_date
            where tanggal < CURDATE()
        ),
        kab as (
            select *
            from area
            where level = 2 and parent_id = ".$provId."
        ),
        cte_kab_date as (
            select *
            from kab
            cross join cte_list_date
        ),
        cte_konfirmasi_harian as (
            select tanggal_lapor, kabupaten, count(*) as total_konfirm_harian
            from line_list_nar
            where tanggal_lapor <> '2000-00-00' and propinsi = '".$provName."'
            group by tanggal_lapor, kabupaten
        ),
        cte_sembuh_harian as (
            select tanggal_sembuh, kabupaten, count(*) as total_sembuh_harian
            from line_list_nar
            where tanggal_sembuh <> '2000-00-00' and propinsi = '".$provName."'
            group by tanggal_sembuh, kabupaten
        ),
        cte_meninggal_harian as (
            select tanggal_meninggal, kabupaten, count(*) as total_meninggal_harian
            from line_list_nar
            where tanggal_meninggal <> '2000-00-00' and propinsi = '".$provName."'
            group by tanggal_meninggal, kabupaten
        ),
        cte_test_harian as (
            select tgl,
                   faskes_kabnm,
                   sum(jml_spesimen_negatif +
                       jml_spesimen_dalam_proses +
                       jml_spesimen_inkonklusif +
                       jml_spesimen_invalid +
                       jml_spesimen_positiff) as total_test_harian
            from analytic_spesiment_nar
            where faskes_propnm = '".$provName."'
              and faskes_kabnm is not null
            group by tgl, faskes_kabnm
        ),
        cte_komulatif_2021 as (
            select
                kd.name                                             as kabupaten,
                kd.tanggal                                          as tanggal_lapor,
                sum(coalesce(total_konfirm_harian, 0))
                    over (partition by kd.name order by kd.tanggal) as total
            from cte_kab_date kd
                     left join cte_konfirmasi_harian kh on kh.tanggal_lapor = kd.tanggal and kh.kabupaten = kd.name
            where kd.tanggal >= '2020-12-27'
        ),
        cte_agg as (
            select kd.name                                             as kabupaten,
                   kd.tanggal,
                   coalesce(total_konfirm_harian, 0)                   as total_konfirm_harian,
                   coalesce(total_sembuh_harian, 0)                    as total_sembuh_harian,
                   coalesce(total_meninggal_harian, 0)                 as total_meninggal_harian,
                   coalesce(total_test_harian, 0)                      as total_test_harian,
                   coalesce(jml_pasien_negatif, 0)                     as total_test_negatif,
                   sum(coalesce(total_konfirm_harian, 0))
                       over (partition by kd.name order by kd.tanggal) as total_konfirm_kumulatif,
                   ck.total as total_konfirm_kumulatif_2021,
                   sum(coalesce(total_sembuh_harian, 0))
                       over (partition by kd.name order by kd.tanggal) as total_sembuh_kumulatif,
                   sum(coalesce(total_meninggal_harian, 0))
                       over (partition by kd.name order by kd.tanggal) as total_meninggal_kumulatif,
                   sum(coalesce(total_test_harian, 0))
                       over (partition by kd.name order by kd.tanggal) as total_test_harian_kumulatif,
                   sum(coalesce(jml_pasien_negatif, 0))
                       over (partition by kd.name order by kd.tanggal) as total_test_negatif_kumulatif
            from cte_kab_date kd
                     left join cte_konfirmasi_harian kk
                               on kk.tanggal_lapor = kd.tanggal and
                                  kk.kabupaten = kd.name
                     left join cte_komulatif_2021 ck
                               on ck.tanggal_lapor = kd.tanggal and
                                  ck.kabupaten = kd.name
                     left join cte_sembuh_harian sk
                               on sk.tanggal_sembuh = kd.tanggal and
                                  sk.kabupaten = kd.name
                     left join cte_meninggal_harian mk
                               on mk.tanggal_meninggal = kd.tanggal and
                                  mk.kabupaten = kd.name
                     left join cte_test_harian tk
                               on tk.tgl = kd.tanggal and
                                  tk.faskes_kabnm = kd.name
                     left join analytic_patient_nar apn on apn.tgl = kd.tanggal and apn.faskes_kabnm = kd.name
            order by kd.name, kd.tanggal
        )
    select *,
           total_sembuh_kumulatif / total_konfirm_kumulatif * 100                         as recovery_rate,
           total_meninggal_kumulatif / total_konfirm_kumulatif * 100                      as cfr,
           total_konfirm_kumulatif - (total_sembuh_kumulatif + total_meninggal_kumulatif) as kasus_aktif,
           (total_konfirm_kumulatif_2021 / (total_konfirm_kumulatif_2021+total_test_negatif_kumulatif)) * 100                    as positivity_rate
    from cte_agg
    where tanggal >= '2020-12-27';
        ");
    }
}
