<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['patient', 'doctor.user'])->latest('date')->paginate(10);
        return view('appointments.index', compact('appointments'));
    }

    public function create()
    {
        $patients = Patient::orderBy('nom')->get();
        $doctors = Doctor::with('user')->get();
        return view('appointments.create', compact('patients', 'doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'status' => 'required|in:pending,done,cancelled',
        ]);

        Appointment::create($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment created successfully.');
    }

    public function edit(Appointment $appointment)
    {
        $patients = Patient::orderBy('nom')->get();
        $doctors = Doctor::with('user')->get();
        return view('appointments.edit', compact('appointment', 'patients', 'doctors'));
    }

    public function update(Request $request, Appointment $appointment)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date',
            'status' => 'required|in:pending,done,cancelled',
        ]);

        $appointment->update($validated);
        return redirect()->route('appointments.index')->with('success', 'Appointment updated successfully.');
    }

    public function destroy(Appointment $appointment)
    {
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully.');
    }

    public function patientCreateAppointment()
    {
        $doctors = Doctor::with('user')->get();
        return view('patient.create_appointment', compact('doctors'));
    }

    public function patientStoreAppointment(Request $request)
    {
        $patient = Patient::where('user_id', auth()->id())->first();

        if (!$patient) {
            abort(403, 'No patient profile linked to this user.');
        }

        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date' => 'required|date|after:now',
        ]);

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $validated['doctor_id'],
            'date' => $validated['date'],
            'status' => 'pending',
        ]);

        return redirect()->route('patient.dashboard')->with('success', 'Appointment booked successfully!');
    }
}
