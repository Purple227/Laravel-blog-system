@extends('layouts.backend.app')

@section('title')
{{ $tag->name }}
@endsection

@section('content')

<section class="">

<a class="btn btn-success btn-sm" href="{{ route('tag.index') }}">
<span>back</span>
</a>


<a class="btn btn-success btn-sm float-right" href="{{ route('tag.edit',$tag->id) }}">
<span>edit</span>
</a>

 <div class="card"> <!-- Card body start -->

    <div class="card-header">
      <button type="button" class="btn btn-success"> 
      Post in {{ $tag->name}}
   <span class="badge badge-success"> {{ $tag->posts->count() }} </span>
</button>
  </div>


  <table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">post_title</th>
      <th scope="col">view_tag</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($post as $key => $posts)
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ str_limit($posts->title, 18) }}</td>
      <td>
     <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      View_tags
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
    	@foreach($posts->tags as $tag) 
      <a  href="{{route('tag.show', $tag->id) }}" class="dropdown-item"> {{ $tag->name }} </a>
      	@endforeach
    </div>
  </div>
      </td>

    </tr>

    @endforeach
   
  </tbody>
</table>

{{ $post->links() }} 


</section>


@endsection

