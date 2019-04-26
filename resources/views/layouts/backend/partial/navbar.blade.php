<!-- Just an image -->
<nav class="navbar text-center">
  <a class="navbar-brand " href="#">
    <img src=" {{ asset('images/logo.jpg') }} " width="25%" height="40" alt="">
  </a>
</nav>


<nav class="navbar navbar-expand-lg ">
 <!-- <a class="navbar-brand" href="#">Navbar</a> -->
  <button class="navbar-toggler btn btn-outline-primary" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon">  
  <img src=" {{ asset('images/menu.svg') }} "  width="20" height="20" alt=" signup/login" class=""  data-placement="left" title="Menu">

    </span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">

    <ul class="navbar-nav mr-md-auto">

    </ul>


 <ul class="navbar-nav ">

     <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle " href=" " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Blog
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          @if(Auth::check() && Auth::user()->role_id == 1)
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('post.create') }} ">Create post</a>

          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('post.index') }} "> Post table</a>
          @else
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('author.post.create') }} ">Create post</a>

          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('author.post.index') }} "> Post table</a>
          @endif
      </li>

       <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href=" " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Tag
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('tag.index') }} ">Add/Create tag</a>
      </li>

       <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle" href=" " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Category
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('category.index') }} ">Add/Create category</a>
      </li>

        <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle " href=" " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Roles
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('auth.user') }} "> Users </a>
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('author') }} "> Authors </a>
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('author') }} "> Admin </a>
      </li>

       <li class="nav-item dropdown ">
        <a class="nav-link dropdown-toggle " href=" " id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         {{ str_limit(Auth::user()->name, 7) }}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">

          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('subscriber' ) }} "> subscribers </a>

          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('profile.edit',Auth::id() ) }} "> Update profile </a>
      </li>

  </ul>

  </div>

</nav>