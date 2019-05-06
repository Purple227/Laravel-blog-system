@extends('layouts.backend.app')

@section('title')
Dashboard
@endsection

@section('content')

@include('layouts.backend.partial.error')

<div class="row">

	<div class="col col-sm">
		<div class="text-center">
			<a href="{{route('post.index')}}" class="btn btn-success btn-lg p-3"> All post <span class="badge badge-success">{{$posts}} </span> </a>
		</div>
	</div>

	<div class="col col-sm">
		<div class="text-center">
			<a href="{{route('post.pending')}}" class="btn btn-success btn-lg p-3"> Pending post <span class="badge badge-success">{{$pending}} </span> </a>
		</div>
	</div>

	<div class="col col-sm">
		<div class="text-center">
			<button class="btn btn-success btn-lg p-3">  All post view <span class="badge badge-success">{{$total_view}} </span> </button>
		</div>
	</div>

	<div class="col col-sm">
		<div class="text-center">
			<a href="{{route('author')}}" class="btn btn-success btn-lg p-3"> All author <span class="badge badge-success">{{$authors}} </span></a>
		</div>
	</div>

</div>

<div class="row">

	<div class="col-md-9">
		
		<div class="card">

	 <div class="card-header">
      <button type="button" class="btn btn-success"> 
Top 
   <span class="badge badge-success"> {{ $top_post->count() }} post </span>
</button>
    </div>

	<table class="table table-bordered ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">title</th>
      <th scope="col">author</th>
      <th scope="col">view</th>
      <th scope="col">comment_count</th>
      <th scope="col">created At</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($top_post as $key => $posts)
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ str_limit($posts->title, 18) }}</td>
      <td>{{ str_limit($posts->user->name, 8) }}</td>
      <td>{{ $posts->view_count }}</td>
      <td>{{ $posts->comments->count() }}</td>
      <td>{{ $posts->created_at->diffForHumans() }}</td>

      <!-- Dropdown menu for crud action -->
      <td>
        <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{route('post.show',$posts->id) }}"> View</a> 
  </div>
</div>
</td>
     
    </tr>

    @endforeach
   
  </tbody>
</table>
</div>


<div class="card">

	 <div class="card-header">
      <button type="button" class="btn btn-success"> 
Top 
   <span class="badge badge-success"> {{ $top_author->count() }} </span> author
</button>
    </div>

	<table class="table table-bordered ">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">post_count</th>
      <th scope="col">comment_count</th>
      <th scope="col">Join</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($top_author as $key => $author)
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ $author->name}} </td>
      <td>{{ $author->posts->count() }}</td>
      <td>{{ $author->comments->count() }}</td>
      <td>{{ $author->created_at->diffForHumans() }}</td>

      <!-- Dropdown menu for crud action -->
      <td>
        <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
      <a class="dropdown-item" href="{{route('user.profile',$author->id) }}"> View</a> 
  </div>
</div>
</td>
     
    </tr>

    @endforeach
   
  </tbody>
</table>

		</div>




</div>

	<div class="col-md-3">

<div class="card">
<div class="card-header"> Cat/Tag </div>
<div class="card-body">
	<ul class="list-group">
  <a href="{{route('category.index')}}" class="list-group-item d-flex justify-content-between align-items-center">
    Category
    <span class="badge badge-success badge-pill"> {{$category}}</span>
  </a>
  <a href="{{ route('tag.index')}}" class="list-group-item d-flex justify-content-between align-items-center">
    Tags
    <span class="badge badge-success badge-pill">{{$tag}}</span>
  </a>
</ul>
</div>
</div>

<div class="card">
<div class="card-header"> Top  <span class="badge badge-success badge-pill"> {{ $most_active_user->count()}} </span> users </div>
<div class="card-body">
	<ul class="list-group">
		@foreach($most_active_user as $user)
  <a href="{{route('user.profile',$user->id)}}" class="list-group-item d-flex justify-content-between align-items-center ">
    {{ str_limit($user->name, 8) }}
  </a>
  @endforeach
</ul>
</div>
</div>


<div class="card">
<div class="card-header"> Latest <span class="badge badge-success badge-pill"> {{ $latest_author->count()}} </span> author </div>
<div class="card-body">
	<ul class="list-group">
		@foreach($latest_author as $author)
  <a href="{{route('user.profile',$author->id)}}" class="list-group-item d-flex justify-content-between align-items-center">
    {{ str_limit($author->name, 8) }}
  </a>
  @endforeach
</ul>
</div>
</div>

</div>

</div>



@endsection
