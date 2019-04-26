@extends('layouts.frontend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')

<section class=" ">

  <div class="row"> <!-- row tag open -->

    <div class="col-md-9"> <!-- col-md-8 tag ope -->

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

@guest
<div class="card m-2">
  <div class="card-body">
    <a href="{{route('login')}}" class="card-link"> Please login to comment </a>
  </div>
</div>
@endguest

@auth
<form method="POST" action="{{route('comment.store',$post->id)}}" autocomplete>
  @csrf
 <div class="m-2">
    <label for="comment">Comment</label>
    <textarea class="form-control" id="comment" rows="3" name="comment" placeholder="Enter comment here" required></textarea>
    <button type="submit" class="btn btn-primary btn-sm card-link ">Submit</button>
  </div>
</form>
@endauth

@foreach($post->comments as $comment)
<div class="card m-2">
  <div class="card-title">by {{ str_limit($comment->user->name, 8) }} </div>
  <div class="card-body">
    {{$comment->comment}}
  </div>
  <div class="footer"> {{$comment->created_at->diffForhumans()}} </div>
</div>
@endforeach
 
</div> <!-- Col-md-8 tag close -->

<div class="col-md-3"> <!-- col-md-4 tag open -->

   <div class="card mt-2">
      <div class="card-body">
        <h5 class="card-title"> ADspace</h5>
        <p class="card-text"> Adspace</p>
        <a href="#" class="btn btn-primary"> see advert</a>
      </div>
    </div>

     <div class="card mt-2">
      <div class="card-body">
        <h5 class="card-title"> ADspace</h5>
        <p class="card-text"> Adspace</p>
        <a href="#" class="btn btn-primary"> see advert</a>
      </div>
    </div>

</div> <!-- col-md-4 tag close --> 

</div> <!-- row tag close -->


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
    <div class="card-footer">
     <button type="button" class="btn btn-outline-primary btn-sm">
    <img src=" {{ asset('images/chat.svg') }} "  width="20" height="20" alt="Comment">  <span class="badge badge-primary"> {{$most_read->comments->count()}} </span>
  <span class="sr-only">Comment</span>
</button>

 <button type="button" class="btn btn-outline-primary btn-sm">
    <img src=" {{ asset('images/view.svg') }} "  width="20" height="20" alt="Views">  <span class="badge badge-primary"> {{$post->view_count}} </span>
  <span class="sr-only">Views</span>
</button>
  </div>
  </div>
</div>
   @endforeach
  
</div>




</section>

@endsection