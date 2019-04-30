@extends('layouts.backend.app')

@section('title')
Author
@endsection

@section('content')

<section class=" ">

@include('layouts.backend.partial.error')

<a class="btn btn-success btn-sm" href="{{ route('admin.dashboard') }}">
<span> Dashboard </span>
</a>

<div class="card"> <!-- Card body start -->

<div class="card-header">
<button type="button" class="btn btn-success"> 
@if($user_count == 0 || $user_count == 1)
Author
@else
Authors
@endif 



<span class="badge badge-success"> {{ $user_count }} </span>
</button>
</div>

@include('admin.user.reuse_table')



{{ $user->links() }} 




{{ $user->links() }} 


</section>



@endsection
