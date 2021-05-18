<?php


namespace App\Exports\Nar;


use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AnalyticExportV4 implements FromCollection,WithTitle,WithMapping,WithHeadings,WithColumnFormatting,WithColumnWidths
{
    protected $provId;
    protected $provName;

    /**
     * AnalyticExportV4 constructor.
     * @param $provId
     * @param $provName
     */
    public function __construct($provId, $provName)
    {
        $this->provId = $provId;
        $this->provName = $provName;
    }

    public function collection()
    {
        $data = $this->getData($this->provName,$this->provId);
        return collect($data);
    }

    public function headings(): array
    {
        return [
            'TANGGAL PELAPORAN',
            'Mgg ke-',
            'Thn',
            'Provinsi',
            'Kabupaten',
            'Konfirmasi Harian',
            'Konfirmasi Komulatif',
            'Konfirmasi Komulatif 2021',
            'Sembuh Harian',
            'Sembuh Kumulatif',
            'Meninggal Harian',
            'Meninggal Kumulatif',
            'Recv Rate (%)',
            'CFR %',
            'Kasus Aktif',
            'Kasus Test Harian',
            'Kasus Test Kum',
            'Kasus Neg Harian',
            'Kasus Neg Kum',
            'Pos Rate (%)',
            'Pos Rate Harian (%)',
            'Target Suspek per minggu ',
            'Capaian Target (%)',
        ];
    }

    public function map($data): array
    {
        if($data->tanggal >= '2020-12-27'){
            return [
                Date::stringToExcel($data->tanggal),
                $data->week,
                $data->year,
                $this->provName,
                $data->kabupaten,
                $data->total_konfirm_harian,
                $data->total_konfirm_kumulatif,
                $data->total_konfirm_kumulatif_2021,
                $data->total_sembuh_harian,
                $data->total_sembuh_kumulatif,
                $data->total_meninggal_harian,
                $data->total_meninggal_kumulatif,
                number_format($data->recovery_rate,2),
                number_format($data->cfr,2),
                $data->kasus_aktif,
                $data->total_test_harian,
                $data->total_test_harian_kumulatif,
                $data->total_test_negatif,
                $data->total_test_negatif_kumulatif,
                number_format($data->positivity_rate,2),
                number_format($data->positivity_rate_daily,2),
                $data->target_suspek_perminggu,
                number_format($data->capaian_target,2)
            ];
        }
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 15,
        ];
    }

    public function title(): string
    {
        return $this->provName;
    }


    private function getData($provName = "JAWA TENGAH",$provId = 32676)
    {
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
            where level = 2 and parent_id = " . $provId . "
        ),
        cte_kab_date as (
            select *,week(tanggal)+1 as week,year(tanggal) as year
            from kab
            cross join cte_list_date
        ),
        cte_konfirmasi_harian as (
            select tanggal_lapor, kabupaten, count(*) as total_konfirm_harian
            from line_list_nar
            where tanggal_lapor <> '2000-00-00' and propinsi = '" . $provName . "'
            group by tanggal_lapor, kabupaten
        ),
        cte_sembuh_harian as (
            select tanggal_sembuh, kabupaten, count(*) as total_sembuh_harian
            from line_list_nar
            where tanggal_sembuh <> '2000-00-00' and propinsi = '" . $provName . "'
            group by tanggal_sembuh, kabupaten
        ),
        cte_meninggal_harian as (
            select tanggal_meninggal, kabupaten, count(*) as total_meninggal_harian
            from line_list_nar
            where tanggal_meninggal <> '2000-00-00' and propinsi = '" . $provName . "'
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
            where faskes_propnm = '" . $provName . "'
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
        cte_penduduk as (
          select
            kdc,kabupaten_kota,target_suspek_perminggu
         from area_penduduk
         where provinsi = '" . $provName . "'
        ),
        cte_agg as (
            select kd.name                                             as kabupaten,
                   kd.tanggal,
                   kd.week,
                   kd.year,
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
                       over (partition by kd.name order by kd.tanggal) as total_test_negatif_kumulatif,
                   cp.target_suspek_perminggu
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
                     left join cte_penduduk cp on cp.kabupaten_kota = kd.name
                     left join analytic_patient_nar apn on apn.tgl = kd.tanggal and apn.faskes_kabnm = kd.name
            order by kd.name, kd.tanggal
        )
    select *,
           total_sembuh_kumulatif / total_konfirm_kumulatif * 100                         as recovery_rate,
           total_meninggal_kumulatif / total_konfirm_kumulatif * 100                      as cfr,
           total_konfirm_kumulatif - (total_sembuh_kumulatif + total_meninggal_kumulatif) as kasus_aktif,
           (total_konfirm_kumulatif_2021 / (total_konfirm_kumulatif_2021+total_test_negatif_kumulatif)) * 100                    as positivity_rate,
           (total_konfirm_harian / (total_konfirm_harian+total_test_negatif)) * 100                    as positivity_rate_daily,
           ((total_konfirm_harian + total_test_negatif)/target_suspek_perminggu) * 100                 as capaian_target
    from cte_agg
    where tanggal >= '2020-12-27';
        ");
    }
}
