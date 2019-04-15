@extends('layouts.backend.app')

@section('title')
{{ $post->title }}
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

<form action="{{ route('post.update',$post->id) }}" method="POST" enctype="multipart/form-data">
  @method('PATCH')
 @csrf

<div class="form-group"> 
<label for="image" class=" ">Enter image</label>
<input type="file" name="image" class="form-control-file  {{ $errors->has('image') ? ' is-invalid' : '' }}" id="image"> 
@if ($errors->has('image'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('image') }}</strong>
</span>
@endif

<div class="form-group">
<label for="title" class=" ">Title</label>

<input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Enter title" value="{{ $post->title }}" required>

@if ($errors->has('title'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('title') }}</strong>
</span>
@endif
</div>


<div class="form-group mb-2">
	<!-- Add tech button--->
<a class="btn btn-primary btn-sm float-right" href="{{ route('category.index') }}">
<span>Add New Cat</span>
</a> <!-- Tag close here -->
<label for="category"> Category </label>
<div class="form-line {{ $errors->has('category') ? 'focused error' : '' }}">
<select class="custom-select form-control" name="category_id" required>
  <option disabled> Tap here to select category</option>
  @foreach($category as $categories)
  <option value="{{ $categories->id }}" {{ $model->category_id == $categories->id ? 'selected' : '' }}>  <span class="badge badge-success"  data-placement="left" title="No. of post"> {{$categories->posts->count()}} </span> </option> @endforeach
</select>
</div>

 <option value="$category->id" {{ $model->category_id == $category->id ? 'selected' : '' }}>


<div class="form-group mt-2">
<a class="btn btn-primary btn-sm float-right" href="{{route('tag.index') }}">
<span>Add New Tag</span>
</a> <!-- Tag close here -->
<label for="tag"> Tag </label>
<div class="form-line {{ $errors->has('tags') ? 'focused error' : '' }}">
<select class="custom-select form-control" name="tags[]"  size="3" multiple required>
  <option disabled> Morethan one can be selected</option>
  @foreach($tag as $tags)
  <option value="{{ $tags->id }}"> {{$tags->name}} <span class="badge badge-primary"  data-placement="left" title="No. of post"> {{$tags->posts->count()}} </span></option> @endforeach
  
</select>
</div>
</div>


<div class="form-group"> 
<label for="body" class=" "> description </label> 
<textarea class="form-control blur {{ $errors->has('body') ? ' is-invalid' : '' }} " id="body" rows="2" name="body" value="{{ old('body') }}" > {{ $post->body }} </textarea>
@if ($errors->has('body'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('body') }}</strong>
</span>
@endif
</div>

<div class="form-check form-group">
  <input class="form-check-input" type="checkbox" value="1" id="publish" name="status">
  <label class="form-check-label" for="defaultCheck1">
    Publish
  </label>
</div>

<button type="submit" class="btn btn-primary">Submit</button>

</form>


</div> <!-- Card-body tag close -->

</div> <!-- Card tag close -->


</section>

@endsection
