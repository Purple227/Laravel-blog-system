@extends('layouts.frontend.app')

@section('title')
{{ $author->name }}
@endsection

@section('content')

<section class="">

<div class="card">
<div class="card-body">
Ads space
</div>
</div>

<div class="row">
	<div class="col-md-8">

<div class="text-center">
  <button type="button" class="btn btn-success m-2 btn-sm">
  {{$author->name}} <span class="badge badge-success">{{$posts->count()}}</span>
  <span class="sr-only">{{$author->name}}</span>
</button>
</div>
	
<div class="row">
@foreach($posts as $post)
@include('user_interface.reuse_blog')
@endforeach
</div>
</div>

<div class="col-md-4">

	<div class="card mt-2">
  <img class="card-img-top" src="{{asset('Storage/profile/'.$author->image) }}" alt="Card image cap">
  <div class="card-body">
    <h5 class="card-title">{{$author->name}}</h5>
    <div class="card-subtitle lead"> About author </div>
    <p class="card-text">{{$author->about}}</p>
    <!--a href="#" class="btn btn-success">Go somewhere</a-->
  </div>
</div>

     <div class="card mt-2">
      <div class="card-body">
        <h5 class="card-title"> ADspace</h5>
        <p class="card-text"> Adspace</p>
        <a href="#" class="btn btn-success"> see advert</a>
      </div>
    </div>

</div>

</div>




</section>

@endsection
