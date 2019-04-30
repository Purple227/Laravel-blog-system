@extends('layouts.backend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')


<section class=" ">

@include('layouts.backend.partial.error')

<a class="btn btn-success btn-sm " href="{{ route('post.index') }}">
<span>back</span>
</a>


<div class="card"> <!-- Card tag open -->

<div class="card-header"> Post form </div>

<div class="card-body "> <!-- Card-body open -->

<form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
 @csrf

@include('reuse_form.reuse_edit')

<button type="submit" class="btn btn-success">Submit</button>

</form>


</div> <!-- Card-body tag close -->

</div> <!-- Card tag close -->


</section>

@endsection
