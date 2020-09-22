    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">

      <div class="c-sidebar-brand d-lg-down-none h4 text-warning">
        <a href="/test">
        <i class="c-icon c-icon-2xl cil-meh mr-2 text-warning"></i> </a>
        <span class ="text-uppercase">TENT-OFFicial</span>
      </div>

      <ul class="c-sidebar-nav ps ps--active-y">
        <li class="c-sidebar-nav-item">
          <a class="c-sidebar-nav-link disabled" href="#">
            <i class="fas fa-tachometer-alt mt-0 mb-2 ml-1 mr-4 h5"></i> 
            <span class ="mb-2">Dashboard </span>
            <span class="badge badge-danger">Disabled</span>
          </a>
        </li>

        <li class="c-sidebar-nav-item">
          <a class="c-sidebar-nav-link disabled" href="#">
            <i class="fas fa-tv mt-0 mb-2 ml-1 mr-4 h5"></i> 
            <span class ="mb-2">Cashier </span>  
            <span class="badge badge-danger">Disabled</span>
          </a>
        </li>

        <li class="c-sidebar-nav-item">
          <a class="c-sidebar-nav-link disabled" href="#">
          <i class="far fa-folder-open mt-0 mb-2 ml-1 mr-4 h5"></i> 
            <span class ="mb-2">Order list </span>  
            <span class="badge badge-danger">Disabled</span>
          </a>
        </li>

        @if(Auth::user()->status == 1)

        <li class="c-sidebar-nav-item disabled">
          <a class="c-sidebar-nav-link disabled">
          <i class="fas fa-folder-open mt-0 mb-2 ml-1 mr-4 h5"></i> 
            <span class ="mb-2">Order list </span>  
            <span class="badge badge-warning">admin</span>
            <span class="badge badge-danger">Disabled</span>
          </a>
        </li>
        
        @endif

        <li class="c-sidebar-nav-item">
          <a class="c-sidebar-nav-link" href="/CustomShow+0+{{Auth::user()->id}}">
            <i class="fas fa-shopping-cart mt-0 mb-2 ml-0 mr-4 h5"></i> 
              <span class ="mb-2">Order food</span> 
            </a>
          </a>
        </li>
        
        <li class="c-sidebar-nav-item">
          <a class="c-sidebar-nav-link disabled" href="productinfo">
            <i class="fas fa-utensils 2x mt-0 mb-2 ml-1 mr-4 h5"></i> 
              <span class ="mb-2 ml-1">Product information</span> 
            </a>
          </a>
        </li>

        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
          <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle disabled" href="#">
            <i class="fas fa-chart-line 2x mt-0 mb-2 ml-1 mr-4 h5"></i> 
              <span class ="mb-2">Report</span> 
              <span class="badge badge-danger">Disabled</span>
            </a>
          <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"><span class="c-sidebar-nav-icon"></span> Report Sale </a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"><span class="c-sidebar-nav-icon"></span> Report Sale Employee of day</a></li>
            <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="#"><span class="c-sidebar-nav-icon"></span> Report Sale Employee</a></li>
          </ul>
        </li>

        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">

          <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#">
            <i class="fab fa-whmcs 2x mt-0 mb-2 ml-1 mr-4 h5"></i> 
            <span class ="mb-2">Manage</span> 
          </a>


          <ul class="c-sidebar-nav-dropdown-items">
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="userinfo">
                <i class="fas fa-caret-right mt-0 mb-2 ml-0 mr-2"></i> 
                <span class ="mb-2">User information</span> 
                
              </a>
            </li>

            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="hashtag">
                <i class="fas fa-caret-right mt-0 mb-2 ml-0 mr-2"></i> 
                <span class ="mb-2">Hastag information</span> 

              </a>
            </li>

            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="material">
                <i class="fas fa-caret-right mt-0 mb-2 ml-0 mr-2"></i> 
                <span class ="mb-2">Material information</span> 

              </a>
            </li>
            @if(Auth::user()->status == 1)
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="job">
                <i class="fas fa-caret-right mt-0 mb-2 ml-0 mr-2"></i> 
                <span class ="mb-2">Job information</span> 
                <span class="badge badge-warning">admin</span>
              </a>
            </li>
            
            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="role">
                <i class="fas fa-caret-right mt-0 mb-2 ml-0 mr-2"></i> 
                <span class ="mb-2">Roles information</span> 
                <span class="badge badge-warning">admin</span>
              </a>
            </li>

            <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="category">
                <i class="fas fa-caret-right mt-0 mb-2 ml-0 mr-2"></i> 
                <span class ="mb-2">Category information</span> 
                <span class="badge badge-warning">admin</span>
              </a>
            </li>

            {{-- <li class="c-sidebar-nav-item">
              <a class="c-sidebar-nav-link" href="#">
                <i class="fas fa-caret-right mt-0 mb-2 ml-0 mr-2"></i> 
                <span class ="mb-2">Bar information</span> 
                <span class="badge badge-warning">admin</span>
              </a>
            </li> --}}
            @endif
          </ul>
        </li>

    </div>