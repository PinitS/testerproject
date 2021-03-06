<header class="c-header c-header-light c-header-fixed c-header-with-subheader">
  


        <button class="c-header-toggler c-class-toggler d-lg-none mfe-auto" type="button" data-target="#sidebar" data-class="c-sidebar-show">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>
        <div class="c-header-brand d-lg-none" href="#">
          <i class="text-danger c-icon c-icon-2xl cil-meh "></i>
        </div>
        <button class="c-header-toggler c-class-toggler mfs-3 d-md-down-none" type="button" data-target="#sidebar" data-class="c-sidebar-lg-show" responsive="true">
          <svg class="c-icon c-icon-lg">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-menu"></use>
          </svg>
        </button>
        
        <!-- <ul class="c-header-nav d-md-down-none">
          <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Dashboard</a></li>
          <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Users</a></li>
          <li class="c-header-nav-item px-3"><a class="c-header-nav-link" href="#">Settings</a></li>
        </ul> -->

        <ul class="c-header-nav ml-auto mr-4">
          <li class="c-header-nav-item d-md-down-none mx-2">
            <span class ="text-danger font-weight-bolder">Username : {{ Auth::user()->username }} </span>
          </li>

          <li class="c-header-nav-item d-md-down-none mx-2">
            <span class ="text-info font-weight-bolder">UserStatus :  @if (Auth::user()->status == 1)
                                                                          Admin
                                                                        @else
                                                                          Member
                                                                        @endif
          </li>

          <li class="c-header-nav-item d-md-down-none mx-2">

            <span class ="text-warning font-weight-bolder">test decrypt password :  {{Auth::user()->password }}

          </li>

          <li class="c-header-nav-item d-md-down-none mx-2">

            <span class ="text-success font-weight-bolder">User Id :  {{Auth::user()->id }}

          </li>

          <li class="c-header-nav-item dropdown"><a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
              <div class="c-avatar"><img class="c-avatar-img" src="assets/img/avatars/5.jpg" alt="user@email.com"></div>
            </a>

            <div class="dropdown-menu dropdown-menu-right pt-0">
              <div class="dropdown-header bg-light py-2 text-center">
                <strong>Account</strong>
              </div>
          
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user mt-0 mb-2 ml-0 mr-3"></i> 
                  <span class ="mb-2">Profile</span>   
                </a>

                <div class="dropdown-item">
                  <i class="fas fa-wrench mt-0 mb-1 ml-0"></i> 
                  <button class="btn mb-1" type="button" data-toggle="modal" data-target="#myModal">Change Password</button>
                </div>




                
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                  <i class="fas fa-unlink mt-0 mb-2 ml-0 mr-3"></i> 
                  <span class ="mb-2">Logout</span>  
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>

            </div>

          </li>
        </ul>

        <!-- <div class="c-subheader px-3">

          <ol class="breadcrumb border-0 m-0">
            <li class="breadcrumb-item">Home</li>
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">Dashboard</li>

          </ol>
        </div> -->
      </header>