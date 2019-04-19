@extends('layouts.backend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')

<section class=" ">

@if($post->is_approved == false)
<form method="post" action="{{ route('post.approve',$post->id) }}" id="approval-form" class="d-inline">
@csrf
@method('PUT')
 <input class="btn btn-primary btn-sm" type="submit" value="Approved post">
</form>
@else
<button type="button" class="btn btn-primary">Post approved</button>
@endif

<div class="dropdown d-inline">
<a class="btn btn-primary btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
menu
</a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
<a class="dropdown-item" href=" {{ route('post.edit',$post->id) }}"> Edit </a>
</div>

<a class="btn btn-sm btn-primary float-right" href="{{ route('post.index') }}"> Back </a> 


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