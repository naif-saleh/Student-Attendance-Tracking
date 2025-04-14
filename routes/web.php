<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Attendance\AttendanceList;
use App\Livewire\Student\StudentCreate;
use App\Livewire\Student\StudentList;
use App\Livewire\Student\StudentUpdate;
use App\Livewire\StudentClass\StudentClassesCreate;
use App\Livewire\StudentClass\StudentClassesList;
use App\Livewire\StudentClass\StudentClassesUpdate;
use App\Livewire\Teacher\TeacherDashboard;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', function () {
    return view('welcome');
})->name('home');
 


Route::middleware(['auth', 'teacher'])->prefix('/teacher')->group(function (){
    Route::get('/dashboard', TeacherDashboard::class)->name('teacher.dashboard');
});

Route::middleware(['auth', 'admin'])->prefix('/admin')->group(function () {
    Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
    // Student Routes
    Route::get('/student/student-list', StudentList::class)->name('student.list');
    Route::get('/student/student-register', StudentCreate::class)->name('student.register');
    Route::get('/student/student-edit/{id}', StudentUpdate::class)->name('student.edit');
    // Student Classes Routes
    Route::get('/class/class-list', StudentClassesList::class)->name('student.class.list');
    Route::get('/class/class-create', StudentClassesCreate::class)->name('student.class.create');
    Route::get('/class/class-edit/{id}', StudentClassesUpdate::class)->name('student.class.edit');

});






Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');

    // Student Attendance Routes
    Route::get('/attendance/attendance-list/', AttendanceList::class)->name('attendance.list');
});

require __DIR__.'/auth.php';
