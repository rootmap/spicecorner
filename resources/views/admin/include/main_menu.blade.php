<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('dashboard')}}" class="brand-link">
      <img src="{{ url('admin/dist/img/AdminLTELogo.png') }}"
           alt="Admin Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Spicecorner Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ url('admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          {{-- <li class="nav-item">
            <a href="{{url('crud')}}" class="nav-link {{ Request::path() == 'crud' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>CRUD</p>
            </a>
          </li> --}}
          <li class="nav-item">
            <a href="{{url('dashboard')}}" class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('about','galleryheading','galleryphoto','openinghour','privacycms','category'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('about','galleryheading','galleryphoto','openinghour','privacycms','category'))?'active':'' }}">
              <i class="nav-icon fas fa-images"></i>
              <p>
                Content CMS
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('about')}}" class="nav-link {{ Request::path() == 'about' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>About Content</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('galleryheading')}}" class="nav-link {{ Request::path() == 'galleryheading' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gellery Info</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('galleryphoto')}}" class="nav-link {{ Request::path() == 'galleryphoto' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Gallery Photo</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('openinghour')}}" class="nav-link {{ Request::path() == 'openinghour' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Opening Hour</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('privacycms')}}" class="nav-link {{ Request::path() == 'privacycms' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Privacy CMS</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('category')}}" class="nav-link {{ Request::path() == 'category' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Name CMS</p>
                </a>
              </li>
            </ul>
          </li>
    
          <li class="nav-item">
            <a href="{{url('slider')}}" class="nav-link {{ Request::path() == 'slider' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Slider</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('tablebooking')}}" class="nav-link {{ Request::path() == 'tablebooking' ? 'active' : '' }}">
              <i class="nav-icon fas fa-igloo"></i>
              <p>Table Booking</p>
            </a>
          </li>
          
          
          
          
          
          
          
          


          <li class="nav-item has-treeview {{ in_array(Request::path(),array('ourmenuday','ourmenucategory','daymenuitem'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('ourmenuday','ourmenucategory','daymenuitem'))?'active':'' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Our Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('ourmenuday')}}" class="nav-link {{ Request::path() == 'ourmenuday' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Day Name</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('ourmenucategory')}}" class="nav-link {{ Request::path() == 'ourmenucategory' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('daymenuitem')}}" class="nav-link {{ Request::path() == 'daymenuitem' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Item</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview {{ in_array(Request::path(),array('takewaycategory','takewaymenuitem'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('takewaycategory','takewaymenuitem'))?'active':'' }}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Takeway Menu
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('takewaycategory')}}" class="nav-link {{ Request::path() == 'takewaycategory' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{url('takewaymenuitem')}}" class="nav-link {{ Request::path() == 'takewaymenuitem' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Menu Item</p>
                </a>
              </li>
              
            </ul>
          </li>

          {{-- <li class="nav-item">
            <a href="{{url('contactus')}}" class="nav-link {{ Request::path() == 'contactus' ? 'active' : '' }}">
              <i class="nav-icon fas fa-phone-square-alt"></i>
              <p>Contact</p>
            </a>
          </li> --}}
          <li class="nav-item has-treeview {{ in_array(Request::path(),array('sitesettings','reservationinfo','siteforeground','homedelivery'))?'menu-open':'' }}">
            <a href="#" class="nav-link {{ in_array(Request::path(),array('sitesettings','reservationinfo','siteforeground','homedelivery'))?'active':'' }}">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Setting
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{url('sitesettings')}}" class="nav-link {{ Request::path() == 'sitesettings' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Setting</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="{{url('reservationinfo')}}" class="nav-link {{ Request::path() == 'reservationinfo' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Reservation Info</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="{{url('siteforeground')}}" class="nav-link {{ Request::path() == 'siteforeground' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Site Foreground</p>
                </a>
              </li>              
              <li class="nav-item">
                <a href="{{url('homedelivery')}}" class="nav-link {{ Request::path() == 'homedelivery' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Home Delivery</p>
                </a>
              </li>              
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->

    {{-- ============================================ --}}
    <div class="side-bar-bottom">
        <ul class="list-unstyled">
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Edit Profile"><a
              href="#"><i class="fas fa-cog"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Change Password"><a
              href="#"><i class="fas fa-key"></i></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Lockscreen"><a
              href="#"><i class="fas fa-unlock"></i></a></li>
          <li class="list-inline-item" data-toggle="tooltip" data-html="true" title="Logout">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();"><i class="fas fa-power-off"></i>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
          </li>
        </ul>
      </div><!-- End side-bar-bottom -->
  </aside>

  <style type="text/css">
    .side-bar-bottom {
      width: 100%;
      height: 35px;
      background-color: #343a40;
      position: -webkit-sticky;
      position: sticky;
      bottom: 0px;
      margin-top: 93%;
      color: #cccccc;
      display: -webkit-box;
      display: -ms-flexbox;
      display: flex;
      -webkit-box-pack: center;
      -ms-flex-pack: center;
      justify-content: center;
      -webkit-box-align: center;
      -ms-flex-align: center;
      align-items: center;
      border-top: 2px solid #444a50;
      padding-top: 25px;
      /*-webkit-box-shadow: 0px 2px 5px 5px black;
      box-shadow: 0px 2px 5px 5px black;*/
  }
  .side-bar-bottom ul li a i{
    color: #fff;
    padding: 10px;
  }
  </style>