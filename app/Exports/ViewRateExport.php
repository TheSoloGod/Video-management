<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;

class ViewRateExport implements FromCollection, WithHeadings
{
    use Exportable;

    protected $allVideoViewHistory;

    public function __construct($allVideoViewHistory)
    {
        $this->allVideoViewHistory = $allVideoViewHistory;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        foreach ($this->allVideoViewHistory as $key => $row) {
            $videoViewHistory[] = array(
                '0' => ++$key,
                '1' => $row->date,
                '2' => $row->video_id,
                '3' => $row->video->title,
                '4' => $row->today_views,
                '5' => number_format($row->yesterday_views),
                '6' => $row->view_rate,
            );
        }
        return (collect($videoViewHistory));
    }

    public function headings(): array
    {
        return [
            '#',
            'Date',
            'Video id',
            'Video title',
            'Views in day',
            'Views in day before',
            'View rate',
        ];
    }
}
