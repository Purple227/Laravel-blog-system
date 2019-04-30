@extends('layouts.backend.app')

@section('title')
{{ $post->title }}
@endsection

@section('content')

<section class=" ">

@if($post->is_approved == false)
<button type="button" class="btn btn-danger btn-sm" disabled>Not approved</button>
@endif

<div class="dropdown d-inline">
<a class="btn btn-success btn-sm dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
menu
</a>
<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
<a class="dropdown-item" href=" {{ route('author.post.edit',$post->id) }}"> Edit </a>
</div>

<a class="btn btn-sm btn-success float-right" href="{{ route('author.post.index') }}"> Back </a> 

@include('reuse_form.reuse_show')

</section>

@endsection