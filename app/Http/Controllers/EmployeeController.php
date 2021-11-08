<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Services\Feeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::with('branchName','department')
            ->get();
        $branches = Feeder::branches();
        $depts = Feeder::depts();
        return view('dashboard.employees',compact('employees','branches','depts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

        ]);

        $employee = Employee::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'location' => $request->location,
            'email' => $request->email,
            'password' => Employee::generatePassword($request->first_name,$request->last_name),
            'joined' => $request->joined,
            'branch' => $request->branch,
            'employee_id' => Hash::make(Employee::generatePassword($request->first_name,$request->last_name)),
            'status',
            'department_id' => $request->dept,
            'position' => $request->position
        ]);

        if ($employee){
            return redirect()->route('employees.index')->with('success','Employee Created Successfully.');
        }else{
            return redirect()->route('employees.index')->with('success','Failed to create Employee.');

        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
