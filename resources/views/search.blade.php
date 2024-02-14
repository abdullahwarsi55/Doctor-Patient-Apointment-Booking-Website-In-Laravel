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
input[type=text], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

</style>
    <div class="container">
        <h2>Doctor Search</h2>

        <form action="{{ route('doctors.search') }}" method="get">
                <input type="text" class="form-control" placeholder="Search by name and specialization" name="query" value="{{ $query }}">
                    <button class="myButton" type="submit">Search</button>
                </div>
            </div>
        </form>
<br>
        @if(count($doctors) > 0)
            <h3>Search Results:</h3>
            <table id="doctor" >
  <tr>

    <th>Name</th>
    <th>Specialization</th>
    <th>Contact</th>
    <th>Address</th>
    <th>Action</th>
  </tr>
 @foreach($doctors as $doc)
 <tr>

    <td>{{$doc->name}}</td>
    <td>{{$doc->specialization}}</td>
    <td>{{$doc->phonenumber}}</td>
    <td>{{$doc->address}}</td>
    <td><a href="{{ route('appointments.create') }}" class="myButton">Book Appointment</a>
@endforeach
        @else
            <p>No results found.</p>
        @endif
    </div>
@endsection