@extends('layouts.backend.app')

@section('title')
Post pending table
@endsection

@section('content')

<section class=" ">

@include('layouts.backend.partial.error')

  <a class="btn btn-primary btn-sm" href="{{ route('dashboard') }}">
      <span>back</span>
  </a>

  <div class="card"> <!-- Card body start -->

    <div class="card-head">
      <button type="button" class="btn btn-primary"> 
@if($post->count() == 0 || $post->count() == 1)
  Pending post
@else
  Pending posts
@endif 

   <span class="badge badge-primary"> {{ $post->count() }} </span>
</button>
    </div>

	<table class="table table-bordered text-white">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">title</th>
      <th scope="col">author</th>
      <th scope="col">is_approved</th>
      <th scope="col">status</th>
      <th scope="col">created At</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($post as $key => $posts)
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ str_limit($posts->title, 18) }}</td>
      <td>{{ str_limit($posts->user->name, 8) }}</td>
      <td>
      @if($posts->is_approved == true)
      <span class="badge bg-primary">Approved</span>
      @else
      <span class="badge bg-danger">Pending</span>
      @endif
      </td>
       <td>
      @if($posts->status == true)
      <span class="badge bg-primary">Published</span>
      @else
      <span class="badge bg-danger">unpublished</span>
      @endif
      </td>
      <td>{{ $posts->created_at->diffForHumans() }}</td>

      <!-- Dropdown menu for crud action -->
      <td>
        <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{route('post.show',$posts->id) }}"> View</a>



<form action=" {{ route('post.destroy',$posts->id) }}" method="POST" class="dropdown-item" >
@csrf
@method('DELETE')
<button class="btn btn-primary" type="submit"> Delete </button>
</form>
</tr>

@endforeach
   
  </tbody>
</table>

{{ $post->links() }} 


</section>



@endsection
