@extends('layouts.backend.app')

@section('title')
{{ $user->name }}
@endsection

@section('content')


<div class="container mt-2">
<div class="row justify-content-center">
<div class="col-md-8">
<div class="card">
<div class="card-header">{{ __('Update profile ') }}</div>

<div class="card-body">

<form action="{{ route('update.profile',$user->id) }}" method="POST" enctype="multipart/form-data">

 @method('PUT')
 @csrf

<div class="form-group row">
<label for="image" class="col-md-4 col-form-label text-md-right">{{ __('Image') }}</label>
<div class="col-md-6">
<input type="file" name="image" class="form-control-file  {{ $errors->has('image') ? ' is-invalid' : '' }}" id="image"> 
@if ($errors->has('image'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('image') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group row">
<label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

<div class="col-md-6">
<input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name}}" required>

@if ($errors->has('name'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('name') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group row">
<label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

<div class="col-md-6">
<input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email}}" required>

@if ($errors->has('email'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('email') }}</strong>
</span>
@endif
</div>
</div>


<div class="form-group row">
<label for="about" class="col-md-4 col-form-label text-md-right">{{ __('About yourself') }}</label>
<div class="col-md-6">
<textarea class="form-control blur {{ $errors->has('about') ? ' is-invalid' : '' }} " id="about" rows="2" name="about" value="{{ old('about') }}" > {{ $user->about }} </textarea>
@if ($errors->has('about'))
<span class="invalid-feedback" role="alert">
<strong>{{ $errors->first('about') }}</strong>
</span>
@endif
</div>
</div>

<div class="form-group row mb-0">
<div class="col-md-6 offset-md-4">
<button type="submit" class="btn btn-success">
{{ __('Update') }}
</button>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
