<!-- Just an image -->
<nav class="navbar text-center">
<a class="navbar-brand " href="{{ route('home') }} ">
<img src=" {{ asset('images/logo.jpg') }} " width="25%" height="40" alt="">
</a>
</nav>


<nav class="navbar navbar-expand-lg ">
<!-- <a class="navbar-brand" href="#">Navbar</a> -->
<button class="navbar-toggler btn btn-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon">  
<img src=" {{ asset('images/menu.svg') }} "  width="20" height="20" alt=" signup/login " class=""  data-placement="left" title="Menu" >

</span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav mr-md-auto">

 <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Categories
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        	@foreach($categories as $category)
          <a class="dropdown-item" href="{{ route('blog.category',$category->slug)}}">{{$category->name}}</a>
 			@endforeach
        </div>
</li>

<li class="nav-item">
<a class="nav-link " href="{{route('blog')}}"> Blog</a>
</li>

<li class="nav-item">
<a class="nav-link " href="#"> Contact</a>
</li>

<li class="nav-item">
<a class="nav-link " href="#"> About </a>
</li>

</ul>


</div>

<form class="form-inline navbar_search_space" method="GET" action="{{ route('blog.search') }}" >
<input class="form-control" type="search" placeholder="Search" aria-label="Search" name="query"  value="{{ isset($query) ? $query : '' }}" required>
<button class="btn btn-primary" type="submit"> <img src=" {{ asset('images/search.svg') }} "  width="20" height="20" alt=" search ">  </button>
</form> 


@guest
<div class="nav-item dropdown ">
<a class="nav-link dropdown-toggle btn btn-primary btn-sm" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img src=" {{ asset('images/person.svg') }} "  width="20" height="20" alt=" signup/login " class="" data-toggle="tooltip" data-placement="left" title="Login/Sign Up">
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">

<a class="dropdown-item" href=" {{ route('login') }} "> Login</a>
<a class="dropdown-item" href=" {{ route('register') }} "> Sign Up </a>
</div>
</div>
@endguest


@auth
<div class="nav-item dropdown ">
<a class="nav-link dropdown-toggle btn btn-primary btn-sm" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<img src=" {{ asset('images/logout.svg') }} "  width="20" height="20" alt=" signup/login " class="" data-toggle="tooltip" data-placement="left" title="Logout">
</a>
<div class="dropdown-menu" aria-labelledby="navbarDropdown">

<a class="dropdown-item" href="{{ route('logout') }}"
onclick="event.preventDefault();
document.getElementById('logout-form').submit();">
{{ __('Logout') }}
</a>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
@csrf
</form>

@if(Auth::user()->role_id == 1)
<a class="dropdown-item" href=" {{ route('admin.dashboard') }} "> Dashboard </a>
@endif

@if(Auth::user()->role_id == 2)
<a class="dropdown-item" href=" {{ route('author.dashboard') }} "> Dashboard </a>
@endif

</div>
</div>
@endauth


</nav>


@include('layouts.frontend.partial.error')




