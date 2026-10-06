<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use App\Models\Patient;
use App\Models\Doctor;
use Illuminate\Http\Request;

class MedicalRecordController extends Controller
{
    public function index()
    {
        $records = MedicalRecord::with(['patient', 'doctor.user'])->latest('date')->paginate(10);
        return view('medical_records.index', compact('records'));
    }

    public function create(Request $request)
    {
        $patients = Patient::orderBy('nom')->get();
        $doctors = Doctor::with('user')->get();

        // Pre-fill from query parameters (e.g. when coming from medecin dashboard)
        $selectedPatientId = $request->query('patient_id');
        $selectedDoctorId = $request->query('doctor_id');

        // If a medecin is creating the record, auto-select their doctor profile
        if (!$selectedDoctorId && auth()->user()->role === 'medecin' && auth()->user()->doctor) {
            $selectedDoctorId = auth()->user()->doctor->id;
        }

        return view('medical_records.create', compact('patients', 'doctors', 'selectedPatientId', 'selectedDoctorId'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnostic' => 'required|string',
            'traitement' => 'required|string',
            'date' => 'required|date',
        ]);

        MedicalRecord::create($validated);
        return redirect()->route('medical_records.index')->with('success', 'Medical record created successfully.');
    }

    public function edit(MedicalRecord $medicalRecord)
    {
        $patients = Patient::orderBy('nom')->get();
        $doctors = Doctor::with('user')->get();
        return view('medical_records.edit', compact('medicalRecord', 'patients', 'doctors'));
    }

    public function update(Request $request, MedicalRecord $medicalRecord)
    {
        $validated = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            'doctor_id' => 'required|exists:doctors,id',
            'diagnostic' => 'required|string',
            'traitement' => 'required|string',
            'date' => 'required|date',
        ]);

        $medicalRecord->update($validated);
        return redirect()->route('medical_records.index')->with('success', 'Medical record updated successfully.');
    }

    public function destroy(MedicalRecord $medicalRecord)
    {
        $medicalRecord->delete();
        return redirect()->route('medical_records.index')->with('success', 'Medical record deleted successfully.');
    }
}
