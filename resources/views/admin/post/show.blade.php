@extends('layouts.backend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')

<section class=" ">

<a class="btn btn-sm btn-primary" href="{{ route('post.index') }}"> Back </a> 

@if($post->is_approved == false)
<form method="post" action="{{ route('post.approve',$post->id) }}" id="approval-form">
@csrf
@method('PUT')
<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
 <div class="btn-group " role="group" aria-label="Third group">
 <input class="btn btn-primary btn-sm" type="submit" value="Approved post">
</div>
</form>
@else

<div class="btn-group" role="group" aria-label="Third group">
 <button class="btn btn-primary btn-sm" type="button" disabled> Post approved
</div>
</div>
@endif


<div class="dropdown d-inline float-right">
  <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Menu
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
   <a class="dropdown-item" href=" {{ route('post.edit',$post->id) }}"> Edit </a>
   
  </div>
</div>





	<div class="card">
    <div class="card-header"> <a href="{{ url("/post/{$post->slug}") }}" class="lead"> Post link for share </a>
    </div> 
	 <img class=""  src="{{asset('Storage/post/'.$post->image) }}" alt="Card image cap" >
  <div class="card-header lead" >
    {{ $post->title}}
  </div>
  <div class="card-body">
    <h5 class="card-subtitle">
     
  <button type="button" class="btn btn-outline-primary btn-sm">
  <img src=" {{ asset('images/author.svg') }} "  width="20" height="20" alt="Author"> 
   <span class="badge badge-primary">By {{ str_limit($post->user->name, 6) }} </span>
  <span class="sr-only">Author</span>
</button>

      <button type="button" class="btn btn-outline-primary btn-sm">
    <img src=" {{ asset('images/chat.svg') }} "  width="20" height="20" alt="Comment">  <span class="badge badge-primary"> {{$post->comments->count()}} </span>
  <span class="sr-only">Comment</span>
</button>

 <button type="button" class="btn btn-outline-primary btn-sm">
    <img src=" {{ asset('images/view.svg') }} "  width="20" height="20" alt="Views">  <span class="badge badge-primary"> {{$post->view_count}} </span>
  <span class="sr-only">Views</span>
</button>
    </h5>


    <p class="card-text mt-2">{{ $post->title }}</p>

<button type="button" class="btn btn-outline-primary btn-sm">
  <img src=" {{ asset('images/tags.svg') }} "  width="20" height="20" alt="Tag"> <span class="badge badge-light">{{$post->tags->count()}}</span>
  <span class="sr-only">Tags</span>
</button>
    @foreach($post->tags as $tag)
    <a href="#" class="card-link btn btn-primary btn-sm"> {{$tag->name}} </a>
    @endforeach
  </div>
  <div class="card-foote">
   {{ $post->updated_at->diffForHumans()}}
  </div>
</div>


</section>

@endsection