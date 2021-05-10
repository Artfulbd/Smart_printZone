<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center" style="background: #06265F">
    <a class="navbar-brand brand-logo" href="/">
      <img src="{{asset('assets/images/nsu_logo.png')}}" alt="logo" /> </a>
    <a class="navbar-brand brand-logo-mini" href="/">
      <img src="{{asset('assets/images/nsu_logo_small.png')}}" alt="logo"> </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <ul class="navbar-nav">
      <li class="nav-item font-weight-semibold d-none d-lg-block">NSU IT : +880-2-55668200</li>

    </ul>

    <ul class="navbar-nav ml-auto">


      <li class="nav-item dropdown d-none d-xl-inline-block user-dropdown">
        <a class="nav-link dropdown-toggle" id="UserDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
          <img class="img-xs rounded-circle" src="{{asset('assets/images/faces/face8.jpg')}}" alt="Profile image"> </a>
        <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
          <div class="dropdown-header text-center">
            <img class="img-md rounded-circle" src="{{asset('assets/images/faces/face8.jpg')}}" alt="Profile image">
            <p class="mb-1 mt-3 font-weight-semibold">{{auth()->user()->name}}</p>
            <p class="font-weight-light text-muted mb-0">{{auth()->user()->email}}</p>
          </div>
          <a class="dropdown-item">My Profile <span class="badge badge-pill badge-danger">1</span><i class="dropdown-item-icon ti-dashboard"></i></a>
          <a class="dropdown-item">Messages<i class="dropdown-item-icon ti-comment-alt"></i></a>
          <a class="dropdown-item">Activity<i class="dropdown-item-icon ti-location-arrow"></i></a>
          <a class="dropdown-item">FAQ<i class="dropdown-item-icon ti-help-alt"></i></a>
          <a class="dropdown-item" href="{{ route('logout') }}"
             onclick="event.preventDefault();
             document.getElementById('logout-form').submit();" >Sign Out<i class="dropdown-item-icon ti-power-off"></i></a>


            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
      </li>
    </ul>
    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
      <span class="mdi mdi-menu"></span>
    </button>
  </div>
</nav>
