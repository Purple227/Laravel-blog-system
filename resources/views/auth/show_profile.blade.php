@extends('layouts.backend.app')

@section('title')
{{ $user->name }}
@endsection

@section('content')

<div class="row">
	<div class="col-md-8 offset-2">

@if(Auth::user()->role_id == 1)
<a class="btn btn-success btn-sm" href="{{ route('admin.dashboard') }}">
<span>back</span>
</a>
@else
<a class="btn btn-success btn-sm" href="{{ route('author.dashboard') }}">
<span>back</span> 
</a>
@endif


<div class="card">

	<div class="text-center">
  <img class=" img-thumbnail" src="{{asset('Storage/profile/'.$user->image) }}" height="25%" width="25%" alt="Card image cap" >
</div>

  <div class="card-body">
    <h5 class="card-title">{{$user->name}}</h5>
    <div class="card-subtitle font-weight-bold"> Rank ::
    @switch($user->id)
    @case(2)
        Author
        @break

     @case(3)
        User
        @break

    @default
        You must live in everest
@endswitch
</div>

<div class="card-subtitle font-weight-bold"> 
Email :: {{$user->email}}
</div>


<div class="card-header"> About author </div>

    <p class="card-text">{{$user->about}}</p>

@if(Auth::check() && Auth::user()->role_id == 1)
<div class="btn-group " role="group">
<button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Change role
</button>

<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

@switch($user->role_id)

@case(1)

<form method="post" action="{{ route('update.author',$user->id) }}"  class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make author">
</form>

<form method="post" action="{{ route('update.user',$user->id) }}" class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make user">
</form>

@break

@case(2)

<form method="post" action="{{ route('update.user',$user->id) }}"  class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make user">
</form>

<form method="post" action="{{ route('update.admin',$user->id) }}" class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make admin">
</form>

@break

@case(3)

<form method="post" action="{{ route('update.author',$user->id) }}"  class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make author">
</form>

<form method="post" action="{{ route('update.admin',$user->id) }}" class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make admin">
</form>
        
@break

@default
        You must live in everest
@endswitch

</div>
</div>
@endif


  </div>
</div>

</div>
</div>


@endsection


