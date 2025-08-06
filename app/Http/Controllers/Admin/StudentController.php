<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        $query = Student::with('user');

        if ($request->has('class') && $request->class != '') {
            $query->where('class', $request->class);
        }

        $students = $query->paginate(10);
        $classes = Student::select('class')->distinct()->orderBy('class')->get()->pluck('class');

        return view('admin.students.index', compact('students', 'classes'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis',
            'class' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Create user account
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verified_at' => now(),
        ]);
        $user->assignRole('user');

        // Create student record
        Student::create([
            'nis' => $request->nis,
            'name' => $request->name,
            'class' => $request->class,
            'phone' => $request->phone,
            'address' => $request->address,
            'user_id' => $user->id,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student created successfully.');
    }

    public function show(Student $student)
    {
        $student->load(['user', 'sppBills']);
        return view('admin.students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, Student $student)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nis' => 'required|string|unique:students,nis,' . $student->id,
            'class' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'email' => 'required|email|unique:users,email,' . $student->user_id,
        ]);

        // Update user
        $student->user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Update student
        $student->update([
            'nis' => $request->nis,
            'name' => $request->name,
            'class' => $request->class,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Student updated successfully.');
    }

    public function destroy(Student $student)
    {
        $student->user->delete(); // This will cascade delete the student
        return redirect()->route('admin.students.index')
            ->with('success', 'Student deleted successfully.');
    }

    public function byClass()
    {
        $studentsByClass = Student::with('user')
            ->get()
            ->groupBy('class')
            ->sortKeys();

        $classStats = [];
        foreach ($studentsByClass as $class => $students) {
            $classStats[$class] = [
                'total_students' => $students->count(),
                'total_bills' => $students->sum(function ($student) {
                    return $student->sppBills->count();
                }),
                'paid_bills' => $students->sum(function ($student) {
                    return $student->sppBills->where('status', 'paid')->count();
                }),
                'unpaid_bills' => $students->sum(function ($student) {
                    return $student->sppBills->where('status', 'unpaid')->count();
                }),
            ];
        }

        return view('admin.students.by-class', compact('studentsByClass', 'classStats'));
    }
}
