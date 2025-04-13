<?php

namespace App\Livewire\StudentClass;

use App\Models\StudentClass;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentClassesCreate extends Component
{
    public $name = '';

    public function create()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        StudentClass::create([
            'name' => $this->name,
        ]);

        Toaster::success('Class created successfully');
        return redirect()->route('student.class.list');
    }
    public function render()
    {
        return view('livewire.student-class.student-classes-create');
    }
}
