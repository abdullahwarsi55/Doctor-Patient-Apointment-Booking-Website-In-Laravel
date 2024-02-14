<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Panel</title>
    <style>

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body {
    font-family: Arial, sans-serif;
}

header {
    background-color: #37517e;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    
}

.logo {
    font-size: 24px;
    font-weight: bold;
    z-index: 1;
}

.user-profile {
    font-size: 15px;
}

.sidebar {
    background-color: #37517e;
    width: 200px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    padding-top: 70px;
}

.sidebar ul {
    list-style: none;
}

.sidebar ul li {
    margin-bottom: 10px;
}

.sidebar ul li a {
    text-decoration: none;
    color: white;
    display: block;
    padding: 8px 20px;
}

.sidebar ul li a:hover {
    background-color: black;
}

.content {
    margin-left: 200px;
    padding: 20px;
}
.myButton {
	box-shadow: 3px 4px 0px 0px #000000;
	background:linear-gradient(to bottom, #37517e 5%, #000000 100%);
	background-color:#c62d1f;
	border-radius:18px;
	border:1px solid #000000;
	display:inline-block;
	cursor:pointer;
	color:#ffffff;
	font-family:Arial;
	font-size:17px;
	padding:7px 25px;
	text-decoration:none;
	text-shadow:0px 1px 0px #000000;
}
.myButton:hover {
	background:linear-gradient(to bottom, #37517e 5%, #c62d1f 100%);
	background-color:#37517e;
}
.myButton:active {
	position:relative;
	top:1px;
}
      </style>
</head>
<body>
    <header>
        <div class="logo">Admin Panel</div>
        <div class="user-profile">
           <h3 style="margin-bottom: 5px;margin-left:20px">Welcome {{auth()->user()->name}}</h3>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
            <a href="{{route('profile.edit')}}" class="myButton">Profile</a>
            <button class="myButton" type=submit> logout</button>
</form>
        </div>
    </header>

    <aside class="sidebar">
        <ul>
          @if(Auth::User()->usertype==0 )
            <li><a href="{{url('/doctorlisting')}}"><strong>Doctor Listing</strong></a></li>
            @endif
            @if(Auth::User()->usertype==1)
            <li><a href="{{url('/doctorlisting')}}"><strong>Doctor Information</strong></a></li>
            @endif
            @if(Auth::User()->usertype==2)
            <li><a href="{{url('/patientlisting')}}"><strong>Patient Information</strong></a></li>
           @endif
            @if(Auth::User()->usertype==0)
            <li><a href="{{url('/patientlisting')}}"><strong>Patient Listing</strong></a></li>
           @endif
           @if(Auth::User()->usertype==2)
           <li><a href="{{url('/appointments/create')}}"><strong>Create Appointment</strong></a></li>
           @endif
           @if(Auth::User()->usertype==0 ||Auth::User()->usertype==1)
            <li><a href="{{url('/appointmentlisting')}}"><strong>Appointment Listing</strong></a></li>
            @endif
           @if(Auth::User()->usertype==2)
            <li><a href="{{url('/appointmentlisting')}}"><strong>Appointment Status</strong></a></li>
            @endif
            @if(Auth::User()->usertype==2)
            <li><a href="{{url('/doctors/search')}}"><strong>Doctor Search</strong></a></li>
            @endif
        </ul>
    </aside>

    <main class="content">
        @yield('details')
    </main>
</body>
</html>

