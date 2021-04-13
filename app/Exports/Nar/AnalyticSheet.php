<?php

namespace App\Exports\Nar;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithTitle;

class AnalyticSheet implements FromView,WithTitle
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

    public function view(): \Illuminate\Contracts\View\View
    {
        return view('exports.nar.analytic', [
            'data' => $this->data
        ]);
    }

    public function title(): string
    {
        return $this->title;
    }
}
