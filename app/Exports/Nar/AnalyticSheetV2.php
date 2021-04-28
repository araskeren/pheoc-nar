<?php

namespace App\Exports\Nar;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class AnalyticSheetV2 implements FromCollection,WithTitle,WithMapping,WithHeadings,WithColumnFormatting,WithColumnWidths
{
    protected $data;
    protected $title;

    /**
     * PKMExportSheets constructor.
     * @param $data
     * @param String $title
     */
    public function __construct($data,String $title)
    {
        $this->data = $data;
        $this->title = $title;
    }

    public function collection()
    {
        return collect($this->data);
    }

    public function map($data): array
    {
        if($data->tanggal >= '2020-12-27'){
            return [
                Date::stringToExcel($data->tanggal),
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
                number_format($data->positivity_rate,2)
            ];
        }
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_DATE_DDMMYYYY
        ];
    }

    public function headings(): array
    {
        return [
            'TANGGAL PELAPORAN',
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
            'Pos Rate (%)'
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
        return $this->title;
    }
}
