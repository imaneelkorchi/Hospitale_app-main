<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    public function index()
    {
        $doctors = Doctor::with('user')->latest()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('doctors.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'specialite' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'medecin',
        ]);

        Doctor::create([
            'user_id' => $user->id,
            'specialite' => $validated['specialite'],
            'telephone' => $validated['telephone'] ?? null,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor created successfully.');
    }

    public function edit(Doctor $doctor)
    {
        $doctor->load('user');
        return view('doctors.edit', compact('doctor'));
    }

    public function update(Request $request, Doctor $doctor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $doctor->user_id,
            'specialite' => 'required|string|max:255',
            'telephone' => 'nullable|string|max:20',
        ]);

        $doctor->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        $doctor->update([
            'specialite' => $validated['specialite'],
            'telephone' => $validated['telephone'] ?? null,
        ]);

        return redirect()->route('admin.doctors.index')->with('success', 'Doctor updated successfully.');
    }

    public function destroy(Doctor $doctor)
    {
        // Deleting the user will cascade-delete the doctor record
        $doctor->user->delete();
        return redirect()->route('admin.doctors.index')->with('success', 'Doctor deleted successfully.');
    }
}
