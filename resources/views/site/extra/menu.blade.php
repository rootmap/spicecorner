<style type="text/css">
        .brand > a > img{
            height:71px;
        }
</style>
<header id="header">
    <div class="cnt">
        <div class="substrate"></div>
        <div id="stuck_container">
            <div class="brand flt__l flt__n-sm">
                <!-- <h1>
                    <a href="./">
                        mexican
                        <span>Restaurant</span>
                    </a>
                </h1> -->
                <a href="{{url('/')}}">
                    <img src="{{asset('upload/sitesettings/'.$site->logo)}}" alt="{{$site->site_name}}" />
                </a>
            </div>

            <nav class="nav flt__r flt__n-sm">
                <ul class="sf-menu">
                    <li>
                        <a href="{{url('/#about')}}">About Us</a>
                    </li>
                    <li>
                        <a href="{{url('/#menu')}}">Menu</a>
                    </li>
                    <li>
                        <a href="{{url('/#takeaway')}}">Takeaway</a>
                    </li>
                    <li>
                        <a href="{{url('/#gallery')}}">Gallery</a>
                    </li>
                    <li>
                        <a href="{{url('/#Reservation')}}">Reservation</a>
                    </li>
                    <li>
                        <a href="{{url('/#contact')}}">Contacts</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    @yield('slider')
</header>