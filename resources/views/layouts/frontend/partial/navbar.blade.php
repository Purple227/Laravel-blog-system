<!-- Just an image -->
<nav class="navbar text-center">
<a class="navbar-brand " href="{{ route('home') }} ">
<img src=" {{ asset('images/logo.jpg') }} " width="25%" height="40" alt="">
</a>
</nav>


<nav class="navbar navbar-expand-lg ">
<!-- <a class="navbar-brand" href="#">Navbar</a> -->
<button class="navbar-toggler btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon">  
<img src=" {{ asset('images/menu.svg') }} "  width="20" height="20" alt=" signup/login " class=""  data-placement="left" title="Menu" >

</span>
</button>

<div class="collapse navbar-collapse" id="navbarSupportedContent">

<ul class="navbar-nav mr-md-auto">

<li class="nav-item">
<a class="nav-link " href="{{route('post.pending')}}"> blah 1 </a>
</li>

<li class="nav-item">
<a class="nav-link " href="#">Blah 2</a>
</li>

<li class="nav-item">
<a class="nav-link " href="#">Blah 3</a>
</li>

<li class="nav-item">
<a class="nav-link " href="#"> Contact</a>
</li>

<li class="nav-item">
<a class="nav-link " href="#"> About </a>
</li>

</ul>


</div>

<form class="form-inline navbar_search_space">
<input class="form-control" type="search" placeholder="Search" aria-label="Search">

<button class="btn btn-outline-primary" type="submit"> <img src=" {{ asset('images/search.svg') }} "  width="20" height="20" alt=" search ">  </button>
</form> 


@guest
<div class="nav-item dropdown ">
<a class="nav-link dropdown-toggle btn btn-outline-primary btn-sm" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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
<a class="nav-link dropdown-toggle btn btn-outline-primary btn-sm" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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

</div>
</div>
@endauth


</nav>
