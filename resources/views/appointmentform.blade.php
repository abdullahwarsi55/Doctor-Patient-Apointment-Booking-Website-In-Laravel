@extends('dashboard')
@section('details')

<style>
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type=number], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
input[type="date"], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}


input[type=submit] {
  width: 100%;
  background-color: #37517e;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}


input[type=submit]:hover {
  background-color: black;
}

</style>
<body>
<h1>Appointment Form</h1>
<br>
<div>
  <form action="{{ route('appointments.store') }}" method="POST">
    @csrf
            @foreach($patientid as $patid)
            <input type="hidden" id="pid" name="patient_id" value="{{ $patid }}">
            @endforeach
</select>
    <label for="did">Doctor Name</label>
        <select id="did" name="doctor_id">
            @foreach($doctors as $doc)
                <option value="{{ $doc->id }}">{{ $doc->name }}</option>
            @endforeach
</select>
@foreach($patientname as $patname)
    <input type="hidden" id="name" name="name" value="{{ $patname }}">
    @endforeach
    @foreach($patientemail as $patemail)
    <input type="hidden" id="email" name="email" value="{{ $patemail }}">
    @endforeach
    <label for="appointmenttype">Appointment Type</label>
    <select id="appointmenttype" name="appointmenttype"> 
    <option value="Regular">Regular </option>
    <option value="Consulation">Consulation</option>
    <option value="Follow Up">Follow Up</option>
  <select>
    <label for="appointmentdate">Appointment Date</label>
    <input type="date" id="appointmentdate" name="appointmentdate" >
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
               <strong> {{ $error }}</strong>
            @endforeach
        </ul>
    </div>
@endif
    <label for="appointmenttime">Select Appointment Time:</label>
<select id="appointmenttime" name="appointmenttime">
    <option value="09:00">09:00 AM</option>
    <option value="09:30">09:30 AM</option>
    <option value="10:00">10:00 AM</option>
    <option value="10:30">10:30 AM</option>
    <option value="11:00">11:00 AM</option>
    <option value="11:30">11:30 AM</option>
    <option value="12:00">12:00 PM</option>
    <option value="12:30">12:30 PM</option>
    <option value="01:00">01:00 PM</option>
    <option value="01:30">01:30 PM</option>
    <option value="02:00">02:00 PM</option>
    <option value="02:30">02:30 PM</option>
    <option value="03:00">03:00 PM</option>
    <option value="03:30">03:30 PM</option>
    <option value="04:00">04:00 PM</option>
    <option value="04:30">04:30 PM</option>
    <option value="05:00">05:00 PM</option>
    <option value="05:30">05:30 PM</option>
    <option value="06:00">06:00 PM</option>
    <option value="06:30">06:30 PM</option>
    <option value="07:00">07:00 PM</option>
</select>
    <input type="submit"  value="Submit">
  </form>
</div>

@endsection


