@extends('dashboard')
@section('details')

<style>
#doctor {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#doctor td, #doctor th {
  border: 1px solid #ddd;
  padding: 8px;
}

#doctor tr:nth-child(even){background-color: #f2f2f2;}

#doctor tr:hover {background-color: #ddd;}

#doctor th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #37517e;
  color: white;
}

</style>
<h1>Doctor List</h1>
<br>
<table id="doctor" >
  <tr>
    <th>User ID</th>
    <th>ID</th>
    <th>Name</th>
    <th>Specialization</th>
    <th>Phone Number</th>
    <th>Address</th>
    <th>Action</th>
  </tr>
  
  @foreach($doctors as $doc)
  <tr>
  <td>{{$doc->user_id}}</td>
    <td>{{$doc->id}}</td>
    <td>{{$doc->name}}</td>
    <td>{{$doc->specialization}}</td>
    <td>{{$doc->phonenumber}}</td>
    <td>{{$doc->address}}</td>


    <td><a href="{{url('/dedit',$doc->id)}}" class="myButton">update</a>
      @if(Auth::User()->usertype==0 )
      <script>
        function confirmDelete(event) {
            if (!confirm("Are you sure you want to delete?")) {
                event.preventDefault(); 
                alert('Deletion cancelled.');
            }
        }
        </script>
    <form action="{{url('/ddelete',$doc->id)}}" onsubmit="confirmDelete(event)">
      <button type="submit" class="myButton">Delete</button>
    </form>
  </td>
    @endif
    @endforeach
  
    
</table>
<a href="{{url('/dashboard')}}" class="myButton">Back</a>

@endsection

