@extends('dashboard')
@section('details')
<!DOCTYPE html>
<html>
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

input[type=submit] {
  width: 100%;
  background-color: blue;
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
<h1>Update Patient Form</h1>
<br>

<div>
  <form action="" method="POST">
  @csrf
    @method('PUT')
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{$patient->name}}" >
    <label for="gender">Gender</label>
    <input type="text" id="gender" name="gender"value="{{$patient->gender}}" >
    <label for="pnumber">Phone Number</label>
    <input type="text" id="pnumber" name="phonenumber" value="{{$patient->phonenumber}}">
    <label for="email">Email</label>
    <input type="text" id="email" name="email" value="{{$patient->email}}">
    <label for="bloodtype">Blood Type</label>
    <input type="text" id="bloodtype" name="bloodtype" value="{{$patient->bloodtype}}">
   
  
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
@endsection


