<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AutomatedAttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $startDate;

    protected $endDate;

    public function __construct($startDate, $endDate)
    {
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Attendance::whereBetween('date', [$this->startDate, $this->endDate])->get();
    }

    public function headings(): array
    {
        return [
            'Student Name',
            'Student Class',
            'Student Status',
            'Date',
        ];
    }

    public function map($row): array
    {
        return [
            $row->student->full_name,
            $row->student->studentClass->name,
            $row->status,
            $row->date,
        ];
    }
}
