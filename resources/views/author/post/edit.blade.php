@extends('layouts.backend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')


<section class=" ">

@include('layouts.backend.partial.error')

<a class="btn btn-primary btn-sm " href="{{ route('author.post.index') }}">
<span>back</span>
</a>


<div class="card"> <!-- Card tag open -->

<div class="card-header"> Post form </div>

<div class="card-body "> <!-- Card-body open -->

<form action="{{ route('author.post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
 @csrf

@include('reuse_form.reuse_edit')

<button type="submit" class="btn btn-primary">Submit</button>

</form>


</div> <!-- Card-body tag close -->

</div> <!-- Card tag close -->


</section>

@endsection
