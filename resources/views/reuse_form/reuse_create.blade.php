

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

<input type="text" class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" id="title" name="title" placeholder="Enter title" value="{{ old('title') }}" required>

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
  @foreach($category as $categories)
  <option value="{{ $categories->id }}">{{$categories->name }} <span class="badge badge-success"  data-placement="left" title="No. of post"> {{$categories->posts->count()}} </span> </option> @endforeach
</select>
</div>


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
<label for="description" class=" "> description </label> 
<textarea class="form-control blur {{ $errors->has('description') ? ' is-invalid' : '' }} " id="description" rows="2" name="description" value="{{ old('description') }}" >  </textarea>
@if ($errors->has('description'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('description') }}</strong>
</span>
@endif
</div>

<div class="form-check form-group">
  <input class="form-check-input" type="checkbox" value="1" id="publish" name="status">
  <label class="form-check-label" for="defaultCheck1">
    Publish
  </label>
</div>