<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    public $year;
    public $month;
    public $class;

    public function __construct($year, $month, $class)
    {
        $this->year = $year;
        $this->month = $month;
        $this->class = $class;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Attendance::whereYear('date', $this->year)->whereMonth('date', $this->month)->whereHas('student', function ($query){
            $query->where('class_id', $this->class);
        })->get();
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
