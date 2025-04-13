<?php

namespace App\Livewire\StudentClass;

use App\Models\StudentClass;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentClassesUpdate extends Component
{
    public $name = '';
    public $class;

    public function mount($id)
    {
        $this->class = StudentClass::find($id);
        $this->fill([
            'name' => $this->class->name,
        ]);
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);
        $this->class->update([
            'name' => $this->name,
        ]);

        Toaster::success('Student Class Updated Successfully');
        return redirect()->route('student.class.list');
    }

    public function deleteClass()
    {
        $this->class->delete();
        Toaster::success('Student Class Deleted Successfully');
        return redirect()->route('student.class.list');
    }
    public function render()
    {
        return view('livewire.student-class.student-classes-update');
    }
}
