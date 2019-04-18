@extends('layouts.backend.app')

@section('title')
Category
@endsection

@section('content')


<section class=" ">

@include('layouts.backend.partial.error')

<div class="row"> <!-- Row tag open -->

<div class="col-md-4"> <!-- Col-md-4 tag open -->

<div class="card"> <!-- Card tag open -->

<div class="card-header "> Add Category</div>

<div class="card-body"> <!-- Card-body open -->

<form action="{{ route('category.store') }}" method="POST">

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
@if($category_count == 0 || $category_count == 1)
Category
@else
Categories
@endif 

<span class="badge badge-light "> {{ $category_count }} </span>
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
@foreach($category as $key => $categories)
<th scope="row">{{ $key + 1 }}</th>
<td>{{ $categories->name }}</td>
<td>{{ $categories->posts->count() }}</td>
<td>{{ $categories->updated_at->diffForHumans() }}</td>

<!-- Dropdown menu for crud action -->
<td>
<div class="btn-group " role="group">
<button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
Dropdown
</button>
<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">


<a class="dropdown-item" href="{{ route('category.edit',$categories->id) }}">Edit</a>

<form action=" {{ route('category.destroy',$categories->id) }}" method="POST" class="dropdown-item" >
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

{{ $category->links() }} 

</div> <!-- Col-md-8 tag close -->

</div> <!-- Row tag close -->



</section>

@endsection