@extends('dashboard')
@section('details')
<style>
#patient {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#patient td, #patient th {
  border: 1px solid #ddd;
  padding: 8px;
}

#patient tr:nth-child(even){background-color: #f2f2f2;}

#patient tr:hover {background-color: #ddd;}

#patient th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #37517e;
  color: white;
}
</style>
<h1>Patient Listing</h1>
<br>
<table id="patient">
  <tr>
  <th>User Id</th>
    <th>ID</th>
    <th>Name</th>
    <th>Gender</th>
    <th>PhoneNumber</th>
    <th>Email</th>
    <th>Blood Type</th>
    <th>Actions</th>
  </tr>
  
  @foreach($patients as $pat)
  <tr>
  <td>{{$pat->user_id}}</td>
    <td>{{$pat->id}}</td>
    <td>{{$pat->name}}</td>
    <td>{{$pat->gender}}</td>
    <td>{{$pat->phonenumber}}</td>
    <td>{{$pat->email}}</td>
    <td>{{$pat->bloodtype}}</td>


    <td><a href="{{url('/pedit',$pat->id)}}" class="myButton">update</a>
      @if(Auth::User()->usertype==0 )
      <script>
        function confirmDelete(event) {
            if (!confirm("Are you sure you want to delete?")) {
                event.preventDefault(); 
                alert('Deletion cancelled.');
            }
        }
        </script>
    <form action="{{url('/pdelete',$pat->id)}}" onsubmit="confirmDelete(event)">
      <button type="submit" class="myButton">Delete</button>
    </form>
    @endif
    @endforeach
    
</table>
<a href="{{url('/dashboard')}}" class="myButton">Back</a>
@endsection