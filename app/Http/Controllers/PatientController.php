<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Auth::User()->usertype==0){
        $patients=Patient::all();
        return view('patientlisting',['patients'=>$patients]);
        }
    else{
        $userid=$request->user()->id;
        $patients=Patient::where('user_id',$userid)->get();
        return view('patientlisting',['patients'=>$patients]);
}
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $patient=Patient::find($id);
        return view('updatepatientlisting',['patient'=>$patient]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       
        $patient=Patient::find($id);
        $patient->name=$request->name;
        $patient->gender=$request->gender;
        $patient->phonenumber=$request->phonenumber;
        $patient->email=$request->email;
        $patient->bloodtype=$request->bloodtype;
        $patient->save();
        return redirect(route('patientlisting'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Patient::destroy($id);
        return redirect(route('patientlisting'));
    }
}
