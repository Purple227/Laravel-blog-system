<div class="col">

<div class="card m-2">
  <img class="card-img-top" src="{{asset('Storage/post/'.$post->image) }}" alt="Card image cap">
  <div class="card-header"> {{ str_limit($post->title, 20) }} </div>
  <div class="card-body">
    <p class="card-text">{{ str_limit($post->description, 60) }}</p>
     <a href="{{route('blog.single',$post->slug)}}" class="btn btn-primary btn-sm"> Read more </a>
  </div>
  <div class="card-footer">
     <button type="button" class="btn btn-outline-primary btn-sm">
    <img src=" {{ asset('images/chat.svg') }} "  width="20" height="20" alt="Comment">  <span class="badge badge-primary"> {{$post->comments->count()}} </span>
  <span class="sr-only">Comment</span>
</button>

 <button type="button" class="btn btn-outline-primary btn-sm">
    <img src=" {{ asset('images/view.svg') }} "  width="20" height="20" alt="Views">  <span class="badge badge-primary"> {{$post->view_count}} </span>
  <span class="sr-only">Views</span>
</button>
  </div>
</div>

</div>


