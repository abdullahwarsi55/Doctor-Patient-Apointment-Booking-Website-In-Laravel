<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Notification;
use App\Notifications\SendEmailNotification;
class AppointmentController extends Controller
{
    public function index(Request $request)
    {
        if(Auth::User()->usertype==0){
        $appointments=Appointment::all();
        return view('appointmentlisting',['appointments'=>$appointments]);
        }
        else if(Auth::User()->usertype==2){
            $user = Auth::user();
            $patientId = $user->patients->pluck('id')->toArray();
            $appointments=Appointment::where('patient_id',$patientId)->get();
            return view('appointmentlisting',['appointments'=>$appointments]);
        }
        else if(Auth::User()->usertype==1){
            $user = Auth::user();
            $doctorId = $user->doctors->pluck('id')->toArray();
            $appointments=Appointment::where('doctor_id',$doctorId)->get();
            return view('appointmentlisting',['appointments'=>$appointments]); 
        }   
    }

    public function create()
    {
        $user = Auth::user();
        $patientid = $user->patients->pluck('id')->toArray();
        $patientname = $user->patients->pluck('name')->toArray();
        $patientemail = $user->patients->pluck('email')->toArray();
        $doctors = Doctor::select('id','name')->get();
        return view('appointmentform', compact('doctors','patientid','patientname','patientemail'));
    }


    public function store(Request $request)
    {  
        $request->validate([
            'patient_id' => 'required',
            'doctor_id' => 'required',
            'name' => 'required',
            'email'=>'required',
            'appointmenttype' => 'required',
            'appointmentdate' => 'required|date',
            'appointmenttime' => 'required|date_format:H:i',
        ]);
        $appointmentDate = $request->input('appointmentdate');
        $appointmentTime = $request->input('appointmenttime');
        $doctorId = $request->input('doctor_id');
        $endTime = \Carbon\Carbon::parse("$appointmentDate $appointmentTime")->addMinutes(29);
        $existingAppointment = Appointment::where('doctor_id', $doctorId)
            ->where(function ($query) use ($appointmentDate, $appointmentTime, $endTime) {
                $query->where(function ($innerQuery) use ($appointmentDate, $appointmentTime) {
                    $innerQuery->where('appointmentdate', $appointmentDate)
                        ->where('appointmenttime', $appointmentTime);
                })
                ->orWhere(function ($innerQuery) use ($appointmentDate, $appointmentTime, $endTime) {
                    $innerQuery->whereBetween('appointmentdate', [$appointmentDate, $endTime->format('Y-m-d')])
                        ->whereBetween('appointmenttime', [$appointmentTime, $endTime->format('H:i:s')]);
                });
            })
            ->first();
        if ($existingAppointment) {
            return redirect()->back()->withErrors("The selected time slot is not available for this doctor.");
        }
        $appointment = Appointment::create([
            "patient_id"=> $request->get('patient_id'),
            "doctor_id"=> $request->get('doctor_id'),
            "name"=>$request->get('name'),
            "email"=>$request->get('email'),
            "appointmenttype"=>$request->get('appointmenttype'),
            "appointmentdate"=>$appointmentDate,
            "appointmenttime"=>$appointmentTime,
            "appointmentendtime"=>$endTime,
        ]);
            $user = Auth::user();
            $patientId = $user->patients->pluck('id')->toArray();
            $appointments=Appointment::where('patient_id',$patientId)->get();
            return view('appointmentlisting',['appointments'=>$appointments]);
    }

    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Appointment::destroy($id);
        return redirect(route('appointmentlisting'));
    }

    public function approve($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->status = 'approved';
            $appointment->save();
            return redirect()->back()->with('approved','Appointment Approved Successfully');
        }
    }
     
    public function cancel($id)
    {
        $appointment = Appointment::find($id);
        if ($appointment) {
            $appointment->status = 'cancelled';
            $appointment->save();
            return redirect()->back()->with('cancelled','Appointment Cancelled Successfully');
    }
}


    public function sendemail($id){
        $data=Appointment::find($id);
        $details=[
            'greeting'=> 'Hello from Doc',
            'body'=> 'Your appointment has been approved',
            'actiontext'=> 'Check appointment',
            'actionurl'=> 'http://127.0.0.1:8000/appointmentlisting',
            'endpart'=> 'Thanks for booking the appointment',
        ];
        Notification::send($data,new SendEmailNotification($details));
        return redirect()->back()->with('success', 'Mail Send Successfully');
    }
    
}
