<nav class="px-4 py-0 navbar navbar-expand bg-light navbar-light sticky-top">
    <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
        <h2 class="mb-0 text-primary"><i class="fa fa-hashtag"></i></h2>
    </a>
    <a href="#" class="flex-shrink-0 sidebar-toggler">
        {{-- <i class="fa fa-bars"></i> --}}
        <img src="{{asset('img/menu8.png')}}" alt="" height="90%" width="90%;">
    </a>
    <form class="d-none d-md-flex ms-4">
        <input class="border-0 form-control" id="searchInput" type="search" placeholder="Search">
    </form>
    <div class="navbar-nav align-items-center ms-auto">


        <div class="nav-item dropdown">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img class="rounded-circle me-lg-2" src="{{asset('img/user3.webp')}}" alt="" style="width: 35px; height: 35px;">
                @if (auth()->check())
                <span class="d-none d-lg-inline-flex">  {{ auth()->user()->name }} </span>
                @endif
             </a>
            <div class="m-0 border-0 dropdown-menu dropdown-menu-end bg-light rounded-0 rounded-bottom">
                <a href="profile" class="dropdown-item">My Profile</a>
                <a href="setting" class="dropdown-item">Settings</a>
               <form action="{{route('logout')}}" method="post">
            @csrf
            <a href="#" class="dropdown-item"><input type="submit" value="Logout" style="background: inherit;border:0px;"></a>

        </form>
            </div>
        </div>
    </div>
</nav>
