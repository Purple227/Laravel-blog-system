@extends('layouts.backend.app')

@section('title')
{{ $tag->name }}
@endsection

@section('content')


<section class=" ">

<div class="row"> <!-- Row tag open -->

<div class="col-md-8 offset-md-2"> <!-- Col-md-8 tag open -->

@include('layouts.backend.partial.error')


<a class="btn btn-success btn-sm" href="{{ route('tag.index') }}">

<span>back</span>
</a>

<div class="card"> <!-- Card tag open -->

<div class="card-header"> Edit Technology</div>

<div class="card-body"> <!-- Card-body open -->

<form action="{{ route('tag.update',$tag->id) }}" method="POST">
@method('PATCH')
@csrf


<div class="form-group">
<label for="name" class=" ">Name</label>

<input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Enter tech here " value="{{ $tag->name }}">

@if ($errors->has('name'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('name') }}</strong>
</span>
@endif
</div>




<button type="submit" class="btn btn-success">Submit</button>

</form>


</div> <!-- Card-body tag close -->

</div> <!-- Card tag close -->

</div> <!-- Col-md-8 tag close -->

</div> <!-- Row tag close -->






</section>

@endsection