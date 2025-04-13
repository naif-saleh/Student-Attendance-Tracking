<?php

namespace App\Livewire\StudentClass;

use App\Models\StudentClass;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentClassesList extends Component
{
    public $classes = [];
    public $class;
    public function mount()
    {
        $this->classes = StudentClass::all();
    }

    public function deleteClass($id)
    {

        $this->class = StudentClass::find($id);
        $this->class->delete();
        Toaster::success('Student Class Deleted Successfully');
        return redirect()->route('student.class.list');
    }
    public function render()
    {
        return view('livewire.student-class.student-classes-list');
    }
}
