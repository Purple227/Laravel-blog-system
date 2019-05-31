
<footer class="">

<div class="row"> <!-- Row tag open -->

<div class="col border-right">
<a href="#">
<img src="{{ asset('images/logo.jpg') }}" width="25" height="25"  alt="logo">    
<span class=" "> {{ config('app.name') }} © {{ date("Y")}} </span> </a>

</div>

<div class="col border-right">
<h6 class=""> Categories </h6>
<ul class="">
@foreach($categories as $category)
<li class=" "> <a href="{{ route('blog.category',$category->slug) }}"> {{ str_limit($category->name, 12) }} </a> </li>
@endforeach   
</ul>
</div>

<div class="col border-right">
<h6 class=""> Links </h6> 
<ul class="">
<li class=" "> <a href="#"> About </a> </li>
<li class=" "> <a href="#"> Contact  </a> </li>
<li class=" "> <a href="#"> Home </a> </li>
</ul>
</div>


<div class="col ">
<h6 class=""> Subscribe </h6> 
<form method="POST" action="{{ route('subscriber.store') }} ">
@csrf
<input class="form-control form-control-sm" name="email" type="email" placeholder="Type mail here" required>
<button class="btn btn-primary btn-sm " type="submit">Submit</button>
</form>
</div>

</div> <!-- row tag closes -->

</footer>