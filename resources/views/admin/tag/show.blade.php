@extends('layouts.backend.app')

@section('title')
{{ $tag->name }}
@endsection

@section('content')

<section class="second_layer p-md-5">

<a class="btn btn-primary btn-sm" href="{{ route('tag.index') }}">
<span>back</span>
</a>


<a class="btn btn-primary btn-sm float-right" href="{{ route('tag.edit',$tag->id) }}">
<span>edit</span>
</a>

 <div class="card mb-3 third_layer p-md-5"> <!-- Card body start -->

    <div class="card-head text-center">
      <button type="button" class="btn btn-primary"> 
      Work in {{ $tag->name}}
   <span class="badge badge-light font-weight-bold lead"> {{ $tag->posts->count() }} </span>
</button>
  </div>


  <table class="table table-bordered text-white">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">post_title</th>
      <th scope="col">tag</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($post as $key => $post)
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ str_limit($post->title, 18) }}</td>
      <td>
     <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    	@foreach($post->tags as $tag) 
    	@if($tag->count() == 0 || $tag->count() == 1)
      <i class="dropdown-item"> {{ $tag->name }} </i>
      @else
      <i class="dropdown-item"> {{ $tag->name }}s </i>
      @endif
      	@endforeach
    </div>
  </div>
      </td>
      </td>


      <td>
 			<a href="{{ route('tag.show', $tag->id ) }}" class="btn btn-primary btn-sm">View</a>
      </td>
    </tr>

    @endforeach
   
  </tbody>
</table>

{{ $post->links() }} 


</section>


@endsection

