<?php

namespace App\Livewire\Student;

use App\Models\Student;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentList extends Component
{

     public $students = [];
     public $student;

    public function mount()
    {
        $this->students = Student::with('studentClass')->whereNotNull('class_id')->get();
    }
    public function deleteStudent($id)
    {

        $this->student = Student::find($id);
        $this->student->delete();
        Toaster::success('Student Deleted Successfully');
        return redirect()->route('student.list');
    }
    public function render()
    {
        return view('livewire.student.student-list');
    }
}
