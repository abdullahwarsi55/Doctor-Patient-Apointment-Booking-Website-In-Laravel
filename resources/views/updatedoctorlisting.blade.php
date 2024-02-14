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

<h1>Update Doctor Form</h1>
<br>
<div>
  <form action="" method="POST">
  @csrf
    @method('PUT')
    <label for="name">Name</label>
    <input type="text" id="name" name="name" value="{{$doctor->name}}">
    <label for="specialization">Specialization</label>
    <input type="text" id="specialization" name="specialization" value="{{$doctor->specialization}}">
    <label for="contact">Contact</label>
    <input type="text" id="contact" name="contact" value="{{$doctor->phonenumber}}">
    <label for="address">Address</label>
    <input type="text" id="address" name="address" value="{{$doctor->address}}" >
    
  
    <input type="submit" value="Submit">
  </form>
</div>

</body>
</html>
@endsection


