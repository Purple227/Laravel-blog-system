@extends('layouts.frontend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')

<section class=" ">

	<div class="card">
	 <img class=""  src="{{asset('Storage/post/'.$post->image) }}" alt="Card image cap" >
  <div class="card-header lead" >
    {{ $post->title}}
  </div>
  <div class="card-body">
    <h5 class="card-subtitle">
     
  <a href="{{route('blog.author',$post->user->name)}}" type="button" class="btn btn-outline-primary btn-sm">
  <img src=" {{ asset('images/author.svg') }} "  width="20" height="20" alt="Author"> 
   <span class="badge badge-primary">By {{ str_limit($post->user->name, 6) }} </span>
  <span class="sr-only">Author</span>
</a>

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
  <img src=" {{ asset('images/tags.svg') }} "  width="20" height="20" alt="Tag"> <span class="badge badge-primary">{{$post->tags->count()}}</span>
  <span class="sr-only">Tags</span>
</button>
    @foreach($post->tags as $tag)
    <a href="{{route('blog.tag',$tag->slug)}}" class="card-link btn btn-primary btn-sm"> {{$tag->name}} </a>
    @endforeach
  </div>
  <div class="card-foote">
   {{ $post->updated_at->diffForHumans()}}
  </div>
</div>

<div class="text-center mt-3">
<h2 class="lead btn btn-primary btn-sm"> Most read post</h2>
</div>


<div class="row">
  
@foreach($most_read as $most_read)
<div class="col">
<div class="card ">
  <img class="card-img-top" src="{{asset('Storage/post/'.$most_read->image) }}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{$most_read->title}}</h5>
    <a href="{{route('blog.single',$most_read->slug)}}" class="btn btn-primary btn-sm"> Read more </a>
    </div>
  </div>
</div>
   @endforeach
  
</div>




</section>

@endsection