@extends('layouts.backend.app')

@section('title')
Super user
@endsection

@section('content')

<section class=" ">

@include('layouts.backend.partial.error')

<a class="btn btn-primary btn-sm" href="{{ route('admin.dashboard') }}">
<span> Dashboard </span>
</a>

<div class="card"> <!-- Card body start -->

<div class="card-header">
<button type="button" class="btn btn-primary"> 
@if($user_count == 0 || $user_count == 1)
Super user
@else
Super users
@endif 



<span class="badge badge-primary"> {{ $user_count }} </span>
</button>
</div>

@include('admin.user.reuse_table')

{{ $user->links() }} 


</section>



@endsection
