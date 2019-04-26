@extends('layouts.backend.app')

@section('title')
Author
@endsection

@section('content')

<section class=" ">

@include('layouts.backend.partial.error')

<a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}">
<span> Dashboard </span>
</a>

<div class="card"> <!-- Card body start -->

<div class="card-head">
<button type="button" class="btn btn-primary"> 
@if($user_count == 0 || $user_count == 1)
Author
@else
Authors
@endif 



<span class="badge badge-primary"> {{ $user_count }} </span>
</button>
</div>



  <table class="table table-bordered text-white">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Post_count</th>
      <th scope="col">Comment_count</th>
      <th scope="col">created At</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($user as $key => $users)
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ str_limit($users->name, 18) }}</td>
      <td>{{ str_limit($users->email, 18) }}</td>
      <td>{{ $users->posts->count() }}</td>
      <td>{{ $users->comments->count() }}</td>
      <td>{{ $users->created_at->diffForHumans() }}</td>
     
      <!-- Dropdown menu for crud action -->
      <td>
        <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

         
<form method="post" action="{{ route('update.user',$users->id) }}"  class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-primary btn-sm" type="submit" value="Make user">
</form>

<form method="post" action="{{ route('update.admin',$users->id) }}" class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-primary btn-sm" type="submit" value="Make admin">
</form>

<form action=" {{ route('user.destroy',$users->id) }}" method="POST" class="dropdown-item" >
@csrf
@method('DELETE')
<button class="btn btn-primary" type="submit"> Delete </button>
</form>
    </tr>

    @endforeach
   
  </tbody>
</table>



{{ $user->links() }} 




{{ $user->links() }} 


</section>



@endsection
