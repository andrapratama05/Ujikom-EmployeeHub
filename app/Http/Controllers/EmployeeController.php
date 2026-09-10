<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    
    public function dashboard() 
    {
        $sex = Employee::selectRaw('sex, count(*) as total')->groupBy('sex')->get();
        
        $age = Employee::selectRaw('age, count(*) as total')
            ->groupBy('age')
            ->get()
            ->sortBy(function ($item) {
                return (int) $item->age;
            })
            ->values();

        $educationOrder = ['SMA', 'D3', 'D4', 'S1', 'S2'];
        $last_education = Employee::selectRaw('last_education, count(*) as total')
            ->groupBy('last_education')
            ->get()
            ->sortBy(function ($item) use ($educationOrder) {
                $index = array_search($item->last_education, $educationOrder);
                return $index !== false ? $index : 99;
            })
            ->values();

        return view('dashboard', compact('sex', 'age', 'last_education'));
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'asc')->get();

        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'sex' => 'required|in:L,P',
            'age'=> 'required|integer|min:20|max:60',
            'last_education' => 'required|string',
        ]);

        Employee::create($validated);

        return redirect()->route('employees.index')->with('success', 'Data berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Employee $employee)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'sex' => 'required|in:L,P',
            'age' => 'required|integer|min:20|max:60',
            'last_education' => 'required|string',
        ]);

        $employee->update($validated);

        return redirect()->route('employees.index')->with('success', 'Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index')->with('success', 'Data berhasil dihapus');
    }
}
