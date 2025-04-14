<?php

namespace App\Livewire\Attendance;

use Livewire\Component;
use App\Models\StudentClass;
use App\Models\Student;
class AttendanceList extends Component
{

    public $classes = [];
    public $students = [];
    public $year = '';
    public $month = '';
    public $class = '';

    public function mount()
    {
        $this->classes = StudentClass::all();
    }

    public function fechStudent()
    {
        if($this->year && $this->month && $this->class){
            $this->students = Student::where('class_id', $this->class)->get();
            foreach($this->students as $student){
                // foreach(range(1, Carbon::create($this->year, $this->month)->daysMonth()) as $day)
            }
        }

    }
    public function render()
    {
        return view('livewire.attendance.attendance-list');
    }
}
