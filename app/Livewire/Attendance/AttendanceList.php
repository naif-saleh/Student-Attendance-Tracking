<?php

namespace App\Livewire\Attendance;

use App\Exports\AttendanceExport;
use App\Models\Attendance;
use App\Models\Student;
use App\Models\StudentClass;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Masmerise\Toaster\Toaster;

class AttendanceList extends Component
{
    public $classes = [];

    public $students = [];

    public $attendance = [];

    public $year = '';

    public $month = '';

    public $class = '';

    public function mount()
    {
        $this->classes = StudentClass::all();
    }

    public function fechStudent()
    {
        if ($this->year && $this->month && $this->class) {
            $this->students = Student::where('class_id', $this->class)->get();
            foreach ($this->students as $student) {
                foreach (range(1, Carbon::create($this->year, $this->month)->daysInMonth()) as $day) {
                    $date = Carbon::create($this->year, $this->month, $day);
                    $this->attendance[$student->id][$day] = Attendance::where('student_id', $student->id)->whereDate('date', $date)->value('status') ?? 'present';
                }
            }
        }
    }

    public function updateStatus($studentId, $day, $status)
    {
        $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');
        Attendance::updateOrCreate(
            [
                'student_id' => $studentId,
                'date' => $date,
            ],
            [
                'status' => $status,
                'class_id' => $this->class,
            ]
        );

        $this->attendance[$studentId][$day] = $status;
        Toaster::success('Student Stuatus Updated to '.$status.'For '.$date);
    } 

    public function markAll($day, $status)
    {
        foreach ($this->students as $student) {
            $this->updateStatus($student->id, $day, $status);
        }
    }

    public function exportToExcel()
    {
       return Excel::download(new AttendanceExport($this->year, $this->month, $this->class), 'Attendace.xlsx');
    }

    public function render()
    {
        return view('livewire.attendance.attendance-list', [
            'daysOfMonth' => range(1, Carbon::create($this->year, $this->month, 1, 0, 0, 0, 'UTC')->daysInMonth),
        ]);
    }
}
