@extends('layouts.backend.app')

@section('title')
Dashboard
@endsection

@section('content')

@include('layouts.backend.partial.error')

<div class="row">

	<div class="col col-sm">
		<div class="text-center">
			<a href="{{route('author.post.index')}}" class="btn btn-primary btn-lg p-3"> All post <span class="badge badge-primary">{{$posts}} </span> </a>
		</div>
	</div>

	<div class="col col-sm">
		<div class="text-center">
			<a href="{{route('author.post.pending')}}" class="btn btn-primary btn-lg p-3"> Pending post <span class="badge badge-primary">{{$pending}} </span> </a>
		</div>
	</div>

	<div class="col col-sm">
		<div class="text-center">
			<button class="btn btn-primary btn-lg p-3">  All post view <span class="badge badge-primary">{{$total_view}} </span> </button>
		</div>
	</div>

</div>

<div class="row">

	<div class="col-md-9">
		
		<div class="card">

	 <div class="card-header">
      <button type="button" class="btn btn-primary"> 
Your top 
   <span class="badge badge-primary"> {{ $top_post->count() }} post </span>
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
    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

<hr>
@foreach($top_author as $author)
@if($author->id == Auth::id())
<div class="card-header"> You among the top 5 congrat </div>
@else
<div class="card-header"> Write quality post to get among top 5 </div>
@endif
@endforeach
<hr>

<div class="card">

	 <div class="card-header">
      <button type="button" class="btn btn-primary"> 
Top 
   <span class="badge badge-primary"> {{ $top_author->count() }} </span> author
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
    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
    <span class="badge badge-primary badge-pill"> {{$category}}</span>
  </a>
  <a href="{{ route('tag.index')}}" class="list-group-item d-flex justify-content-between align-items-center">
    Tags
    <span class="badge badge-primary badge-pill">{{$tag}}</span>
  </a>
</ul>
</div>
</div>

<!-- Will like to show author profile later -->
<div class="card">
<div class="card-header"> Top  <span class="badge badge-primary badge-pill"> {{ $most_active_user->count()}} </span> users </div>
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
<div class="card-header"> Latest <span class="badge badge-primary badge-pill"> {{ $latest_author->count()}} </span> author </div>
<div class="card-body">
	<ul class="list-group">
		@foreach($latest_author as $author)
  <a  href="{{route('user.profile',$author->id)}}" class="list-group-item d-flex justify-content-between align-items-center">
    {{ str_limit($author->name, 8) }}
  </a>
  @endforeach
</ul>
</div>
</div>

</div>

</div>



@endsection
