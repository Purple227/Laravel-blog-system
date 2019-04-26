@extends('layouts.backend.app')

@section('title')
Add post
@endsection

@section('content')


<section class=" ">

@include('layouts.backend.partial.error')

<a class="btn btn-primary btn-sm " href="{{ route('post.index') }}">
<span>back</span>
</a>


<div class="card"> <!-- Card tag open -->

<div class="card-header"> Post form </div>

<div class="card-body "> <!-- Card-body open -->

<form action="{{ route('post.store') }}" method="POST" enctype="multipart/form-data" >

@csrf

@include('reuse_form.reuse_create')

<button type="submit" class="btn btn-primary">Submit</button>

</form>


</div> <!-- Card-body tag close -->

</div> <!-- Card tag close -->


</section>

@endsection
