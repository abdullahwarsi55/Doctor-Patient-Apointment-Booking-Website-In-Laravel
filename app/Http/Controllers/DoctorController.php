<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if(Auth::User()->usertype==0){
        $doctors=Doctor::all();
        return view('doctorlisting',['doctors'=>$doctors]);
        }
        else{
            $userid=$request->user()->id;
            $doctors=Doctor::where('user_id',$userid)->get();
            return view('doctorlisting',['doctors'=>$doctors]); 
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
        $doctor=Doctor::find($id);
        return view('updatedoctorlisting',['doctor'=>$doctor]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $doctor=Doctor::find($id);
        $doctor->name=$request->name;
        $doctor->specialization=$request->specialization;
        $doctor->contact=$request->contact;
        $doctor->address=$request->address;
        $doctor->save();
        return redirect(route('doctorlisting'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Doctor::destroy($id);
        return redirect(route('doctorlisting'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $doctors = Doctor::where('name', 'like', "%$query%")
            ->orWhere('specialization', 'like', "%$query%")
            ->get();

        return view('search', compact('doctors', 'query'));
    }
}




