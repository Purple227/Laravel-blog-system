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
          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('post.create') }} ">Create post</a>

          <a class="dropdown-item {{ url()->current() ? 'active' : '' }}" href="{{ route('post.index') }} "> Post table</a>
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

  </ul>

    
  </div>

   
</nav>