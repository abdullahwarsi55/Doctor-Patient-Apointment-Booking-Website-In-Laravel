@extends('dashboard')
@section('details')
<style>
#appointment {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#appointment td, #appointment th {
  border: 1px solid #ddd;
  padding: 8px;
}

#appointment tr:nth-child(even){background-color: #f2f2f2;}

#appointment tr:hover {background-color: #ddd;}

#appointment th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #37517e;
  color: white;
}
.alert.alert-success {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
  font-size: 20px;
}
.alert.alert-approve {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
  font-size: 20px;
}
.alert.alert-cancel {
  color: #155724;
  background-color: #d4edda;
  border-color: #c3e6cb;
  font-size: 20px;
}
</style>
<h1>Appointment list</h1>
<br>
@if (\Session::has('success'))
<div class="alert alert-success">
<strong>{!! \Session::get('success') !!}</strong>
</div>
@endif
@if (\Session::has('approved'))
<div class="alert alert-approve">
<strong>{!! \Session::get('approved') !!}</strong>
</div>
@endif
@if (\Session::has('cancelled'))
<div class="alert alert-cancel">
<strong>{!! \Session::get('cancelled') !!}</strong>
</div>
@endif
<br>
<table id="appointment">
  <tr>
    <th>D.ID</th>
    <th>Name</th>
    <th>Email</th>
    <th>Type</th>
    <th>Date</th>
    <th>Time</th>
    <th>End Time</th>
    <th>Status</th>
    @if(Auth::User()->usertype==0 ||Auth::User()->usertype==1)
    <th>Approved</th>
    <th>Cancel</th>
    <th>Email</td>
      @endif
      @if(Auth::User()->usertype==0)
      <th>delete</th>
    @endif
  </tr>
  
  @foreach($appointments as $app)
  <tr>
    <td>{{$app->doctor_id}}</td>
    <td>{{$app->name}}</td>
    <td>{{$app->email}}</td>
    <td>{{$app->appointmenttype}}</td>
    <td>{{$app->appointmentdate}}</td>
    <td>{{$app->appointmenttime}}</td>
    <td>{{$app->appointmentendtime}}</td>
    <td>{{$app->status}}</td>
    @if(Auth::User()->usertype==0 ||Auth::User()->usertype==1)
   <td>
    <form method="POST" action="{{route('appointments.approve',['id' => $app->id])}}">
    @csrf
    @method('PATCH')
    <button class="myButton" type="submit">Approve</button>
</form>
</td>
<td>
<form method="POST" action="{{route('appointments.cancel',['id' => $app->id])}}">
    @csrf
    @method('PATCH')
    <button class="myButton" type="submit">Cancel</button>
</form>
</td>
<td>
<a href="{{route('appointments.sendemail',['id' => $app->id])}}" class="myButton">Mail</a>
</td>
@endif
@if(Auth::User()->usertype==0)
<script>
  function confirmDelete(event) {
      if (!confirm("Are you sure you want to delete?")) {
          event.preventDefault(); 
          alert('Deletion cancelled.');
      }
  }
  </script>
<td>
<form action="{{url('/appointmentdelete',$app->id)}}" onsubmit="confirmDelete(event)">
  <button type="submit" class="myButton">Delete</button>
</form>
  
  </td>
@endif

    @endforeach
    
</table>
<a href="{{url('/dashboard')}}" class="myButton">Back</a>
@endsection
