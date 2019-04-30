@extends('layouts.backend.app')

@section('title')
Super user
@endsection

@section('content')

<section class=" ">

@include('layouts.backend.partial.error')

<a class="btn btn-success btn-sm" href="{{ route('admin.dashboard') }}">
<span> Dashboard </span>
</a>

<div class="card"> <!-- Card body start -->

<div class="card-header">
<button type="button" class="btn btn-success"> 
@if($user_count == 0 || $user_count == 1)
Super user
@else
Super users
@endif 



<span class="badge badge-success"> {{ $user_count }} </span>
</button>
</div>



  <table class="table table-bordered ">
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
    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">


<form method="post" action="{{ route('update.author',$users->id) }}"  class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make author">
</form>

<form method="post" action="{{ route('update.user',$users->id) }}" class="dropdown-item">
@csrf
@method('PUT')
<input class="btn btn-success btn-sm" type="submit" value="Make user">
</form>

<form action=" {{ route('user.destroy',$users->id) }}" method="POST" class="dropdown-item" >
@csrf
@method('DELETE')
<button class="btn btn-success" type="submit"> Delete </button>
</form>
</tr>

    @endforeach
   
  </tbody>
</table>



{{ $user->links() }} 




{{ $user->links() }} 


</section>



@endsection
