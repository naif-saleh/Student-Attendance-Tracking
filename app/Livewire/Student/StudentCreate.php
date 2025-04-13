<?php

namespace App\Livewire\Student;

use App\Models\StudentClass;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentCreate extends Component
{
    public $firstName = '' ;
    public $lastName = '' ;
    public $image = '' ;
    public $age = '' ;
    public $address = '' ;
    public $studentClasses = [] ;
    public $classId = '' ;

    public function mount()
    {
      $this->studentClasses = StudentClass::all();
    }

    private function rules()
    {
        return [
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'image' => 'nullable|image|max:1024',
            'age' => 'required|integer|min:1|max:100',
            'address' => 'required|string|max:255',
            'classId' => 'required|exists:student_classes,id',
        ];
    }
    public function register()
    {
        $this->validate($this->rules());
        // Handle file upload
        // if ($this->image) {
        //     $this->image = $this->image->store('images', 'public');
        // }
        // Create student
        $student = new \App\Models\Student();
        $student->first_name = $this->firstName;
        $student->last_name = $this->lastName;
        // $student->avatar = $this->image;
        $student->age = $this->age;
        $student->address = $this->address;
        $student->class_id = $this->classId;
        $student->user_id = auth()->id();
        $student->save();
        // Reset form fields
        $this->reset(['firstName', 'lastName', 'image', 'age', 'address', 'classId']);
        Toaster::success('Student Registered Successfully');
         return redirect()->route('student.list');

    }
    public function render()
    {
        return view('livewire.student.student-create');
    }
}
