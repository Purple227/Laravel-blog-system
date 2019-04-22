@extends('layouts.backend.app')

@section('title')
Subscribers
@endsection

@section('content')

<section class=" ">

@include('layouts.backend.partial.error')

  <div class="card"> <!-- Card body start -->

    <div class="card-head">
      <button type="button" class="btn btn-primary"> 
@if($subscribers->count() == 0 || $subscribers->count() == 1)
  Subscriber
@else
  Subscribers
@endif 

   <span class="badge badge-primary"> {{ $subscribers->count() }} </span>
</button>
    </div>

	<table class="table table-bordered text-white">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"> Email</th>
      <th scope="col"> Created_at</th>
      <th scope="col">action</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      @foreach($subscribers as $key => $subscriber)
      <th scope="row">{{ $key + 1 }}</th>
      <td>{{ str_limit($subscriber->email, 18) }}</td>
      <td>{{ $subscriber->created_at->diffForHumans() }}</td>

      <!-- Dropdown menu for crud action -->
      <td>
        <div class="btn-group " role="group">
    <button id="btnGroupDrop1" type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Dropdown
    </button>
    <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
       <form action=" {{ route('subscriber.destroy',$subscriber->id) }}" method="POST" class="dropdown-item" >
       @csrf
       @method('DELETE')
        <button class="btn btn-primary" type="submit"> Delete </button>
       </form>
    </tr>

    @endforeach
   
  </tbody>
</table>

{{ $subscribers->links() }} 


</section>



@endsection
