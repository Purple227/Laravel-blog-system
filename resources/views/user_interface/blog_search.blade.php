@extends('layouts.frontend.app')

@section('title')
 {{ $query }}
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
  <button type="button" class="btn btn-primary m-2 btn-sm">
   Results for {{ $query }} <span class="badge badge-light">{{$posts->count()}}</span>
  <span class="sr-only"> Results for {{ $query }}</span>
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

     <div class="card mt-2">
      <div class="card-body">
        <h5 class="card-title"> ADspace</h5>
        <p class="card-text"> Adspace</p>
        <a href="#" class="btn btn-primary"> see advert</a>
      </div>
    </div>

</div>

</div>




</section>

@endsection
