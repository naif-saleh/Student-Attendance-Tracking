<?php

namespace App\Livewire\Student;

use App\Models\Student;
use App\Models\StudentClass;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentUpdate extends Component
{
    public $firstName = '' ;
    public $lastName = '' ;
    public $image = '' ;
    public $age = '' ;
    public $address = '' ;
    public $studentClasses = [] ;
    public $classId = '' ;
    public $student;


    public function mount($id)
    {
      $this->studentClasses = StudentClass::all();
      $this->student = Student::find($id);
      $this->fill([
        'firstName' => $this->student->first_name,
        'lastName' => $this->student->last_name,
        'image' => $this->student->avatar,
        'age' => $this->student->age,
        'address' => $this->student->address,
        'classId' => $this->student->class_id,
      ]);
 
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

    public function update(){
        $this->validate($this->rules());
        $this->student->first_name = $this->firstName;
        $this->student->last_name = $this->lastName;
        if ($this->image) {
            $this->student->avatar = $this->image;
        }
        $this->student->age = $this->age;
        $this->student->address = $this->address;
        $this->student->class_id = $this->classId;
        $this->student->user_id = auth()->id();
        $this->student->save();
        
        Toaster::success('Student Updated Successfully');
        return redirect()->route('student.list');
    }
    public function render()
    {
        return view('livewire.student.student-update',[
            'student'=>$this->student
        ]);
    }
}
