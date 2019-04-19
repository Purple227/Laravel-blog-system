@extends('layouts.backend.app')

@section('title')
Tag
@endsection

@section('content')


<section class=" ">

@include('layouts.backend.partial.error')

<div class="row"> <!-- Row tag open -->

<div class="col-md-4"> <!-- Col-md-4 tag open -->

<div class="card"> <!-- Card tag open -->

<div class="card-header "> Add Tag</div>

<div class="card-body"> <!-- Card-body open -->

<form action="{{ route('tag.store') }}" method="POST">

@csrf



<div class="form-group">
<label for="name" class=" ">Name</label>

<input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" name="name" placeholder="Enter tech here " value="{{ old('name') }}" required>

@if ($errors->has('name'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('name') }}</strong>
</span>
@endif
</div>




<button type="submit" class="btn btn-primary">Submit</button>
</form>


</div> <!-- Card-body tag close -->

</div> <!-- Card tag close -->

</div> <!-- Col-md-4 tag close -->





<div class="col-md-8"> <!--Col-md-8 tag open -->


<div class="card third_layer"> <!-- Card body start -->

<div class="card-head ">
<button type="button" class="btn btn-primary"> 
@if($tag_count == 0 || $tag_count == 1)
Tag
@else
Tags
@endif 

<span class="badge badge-light "> {{ $tag_count }} </span>
</button>
</div>

<table class="table table-bordered">
<thead>
<tr>
<th scope="col">#</th>
<th scope="col">name</th>
<th scope="col">post_count</th>
<th scope="col">date</th>
<th scope="col">action</th>
</tr>
</thead>
<tbody>
<tr>
@foreach($tag as $key => $tags)
<th scope="row">{{ $key + 1 }}</th>
<td>{{ $tags->name }}</td>
<td>{{ $tags->posts->count() }}</td>
<td>{{ $tags->updated_at->diffForHumans() }}</td>

<!-- Dropdown menu for crud action -->
<td>
<div class="btn-group " role="group">
<button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Dropdown
</button>
<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">

<a class="dropdown-item" href="{{ route('tag.edit',$tags->id) }}">Edit</a>

<form action=" {{ route('tag.destroy',$tags->id) }}" method="POST" class="dropdown-item" >
@csrf
@method('DELETE')
<button class="btn btn-primary" type="submit"> Delete </button>
</form>

</div>
</div>
</td>
</tr>

@endforeach

</tbody>
</table>

{{ $tag->links() }} 

</div> <!-- Col-md-8 tag close -->

</div> <!-- Row tag close -->



</section>

@endsection