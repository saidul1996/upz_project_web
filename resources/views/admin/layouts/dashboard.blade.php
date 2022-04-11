<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Twitter -->
    <meta name="twitter:site" content="@themepixels">
    <meta name="twitter:creator" content="@themepixels">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Starlight">
    <meta name="twitter:description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="twitter:image" content="http://themepixels.me/starlight/img/starlight-social.png">

    <!-- Facebook -->
    <meta property="og:url" content="http://themepixels.me/starlight">
    <meta property="og:title" content="Starlight">
    <meta property="og:description" content="Premium Quality and Responsive UI for Dashboard.">

    <meta property="og:image" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:secure_url" content="http://themepixels.me/starlight/img/starlight-social.png">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="600">

    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>@yield('title')</title>

    <!-- vendor css -->
    <link href="{{ asset('backend/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/lib/rickshaw/rickshaw.min.css') }}" rel="stylesheet">

    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{ asset('backend/css/starlight.css') }}">
    @yield('css')
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <div class="sl-logo d-print-none"><a style="font-size:18px;s" href="{{ route('admin.dashboard') }}"><i class="icon ion-android-star-outline"></i> {{__(App\Models\SiteSetting::first()->value('name')??'')}}</a></div>
    <div class="sl-sideleft d-print-none">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="{{__('Search')}}">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">{{__('Navigation')}}</label>
      <div class="sl-sideleft-menu">
        <a href="{{ route('admin.dashboard') }}" class="sl-menu-link @yield('home')">
          <div class="sl-menu-item">
            <!-- <i class="menu-item-icon icon ion-ios-home-outline tx-22"></i> -->
            <span class="menu-item-label">{{__('Dashboard')}}</span>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->


        <!-- Admin Module -->
        @can('admin-*')
        <a href="{{ route('admin.admin.index') }}" class="sl-menu-link @yield('adminmenu')">
            <div class="sl-menu-item">
              <!-- <i class="fa fa-unlock-alt" aria-hidden="true"></i> -->
              <span class="menu-item-label">{{__('Admin')}}</span>
              <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
          </a><!-- sl-menu-link -->
          <ul class="sl-menu-sub nav flex-column">
            @can('admin-create')
            <li class="nav-item"><a href="{{ route('admin.admin.create') }}" class="nav-link @yield('admincreate')">{{__('Create Admin')}}</a></li>
            @endcan
            @can('admin-read')
            <li class="nav-item"><a href="{{ route('admin.admin.index') }}" class="nav-link @yield('adminlist')">{{__('Admin List')}}</a></li>
            <li class="nav-item"><a href="{{ url('admin/laratrust') }}" class="nav-link">{{__('Admin Permission')}}</a></li>
            @endcan
          </ul>
        @endcan

        <!-- User Module -->
        @can('user-*')
        <a href="{{ route('admin.user.index') }}" class="sl-menu-link @yield('usermenu')">
          <div class="sl-menu-item">
            <!-- <i class="menu-item-icon icon ion-ios-contact tx-20"></i> -->
            <span class="menu-item-label">{{__('User')}}</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          @can('user-create')
          <li class="nav-item"><a href="{{ route('admin.user.create') }}" class="nav-link @yield('usercreate')">{{__('Create User')}}</a></li>
          @endcan
          @can('user-read')
          <li class="nav-item"><a href="{{ route('admin.user.index') }}" class="nav-link @yield('userlist')">{{__('User List')}}</a></li>
          @endcan
        </ul>
        @endcan

        <!-- Banner Module -->
        @can('banner-*')
        <a href="{{ route('admin.user.index') }}" class="sl-menu-link @yield('bannermenu')">
          <div class="sl-menu-item">
            <!-- <i class="menu-item-icon icon ion-ios-contact tx-20"></i> -->
            <span class="menu-item-label">{{__('Banner')}}</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          @can('banner-create')
          <li class="nav-item"><a href="{{ route('admin.banner.create') }}" class="nav-link @yield('bannercreate')">{{__('Create Banner')}}</a></li>
          @endcan
          @can('banner-read')
          <li class="nav-item"><a href="{{ route('admin.banner.index') }}" class="nav-link @yield('bannerlist')">{{__('Banner List')}}</a></li>
          @endcan
        </ul>
        @endcan

        <!-- Settings Module -->
        @can('siteSetting-*')
        <a href="{{ route('admin.siteSetting.index') }}" class="sl-menu-link @yield('setting')">
            <div class="sl-menu-item">
                <!-- <i class="fa fa-cubes" aria-hidden="true"></i> -->
                <span class="menu-item-label">Settings</span>
                <i class="menu-item-arrow fa fa-angle-down"></i>
            </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
            @can('siteSetting-create')
            <li class="nav-item"><a href="{{ route('admin.siteSetting.index') }}" class="nav-link @yield('siteSetting')">{{__('General Settings')}}</a></li>
            @endcan
        </ul>
        @endcan

        <!-- Language Module -->
        <a href="{{ route('admin.language.index') }}" class="sl-menu-link @yield('languagemenu')">
          <div class="sl-menu-item">
            <!-- <i class="menu-item-icon icon ion-ios-contact tx-20"></i> -->
            <span class="menu-item-label">{{__('Language')}}</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{ route('admin.language.select') }}" class="nav-link @yield('languageselect')">{{__('Choose Language')}}</a></li>
          @can('language-create')
          <li class="nav-item"><a href="{{ route('admin.language.create') }}" class="nav-link @yield('languagecreate')">{{__('Create Language')}}</a></li>
          @endcan
          @can('language-read')
          <li class="nav-item"><a href="{{ route('admin.language.index') }}" class="nav-link @yield('languagelist')">{{__('Language List')}}</a></li>
          @endcan
          @can('languageKey-create')
          <li class="nav-item"><a href="{{ route('admin.languageKey.create') }}" class="nav-link @yield('languageKeycreate')">{{__('Create Key')}}</a></li>
          @endcan
        </ul>

      </div><!-- sl-sideleft-menu -->

      <br>
    </div><!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header d-print-none">
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
      </div><!-- sl-header-left -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::guard('admin')->user()->name }}</span>
              <img src="../img/img3.jpg" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li><a href="{{ route('admin.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="icon ion-power"></i> Sign Out</a></li>
                <form id="logout-form" action="{{route('admin.logout')}}" method="POST" class="d-none">
                    @csrf
                </form>
              </ul>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->
        </nav>
        <div class="navicon-right">
          <a id="btnRightMenu" href="" class="pos-relative">
            <i class="icon ion-ios-bell-outline"></i>
            <!-- start: if statement -->
            <span class="square-8 bg-danger"></span>
            <!-- end: if statement -->
          </a>
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->

    <!-- ########## START: RIGHT PANEL ########## -->
    <div class="sl-sideright">
      <ul class="nav nav-tabs nav-fill sidebar-tabs" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" data-toggle="tab" role="tab" href="#product">Quantity Alert 0</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" role="tab" href="#notifications">Notice (0)</a>
        </li>
      </ul><!-- sidebar-tabs -->

      <!-- Tab panes -->
      <div class="tab-content">
        <div class="tab-pane pos-absolute a-0 mg-t-60 active" id="product" role="tabpanel">
          <div class="media-list">
            <!-- loop starts here -->
            {{--@foreach ($alert_product as $product)
            <a href="{{route('admin.product.show',$product->id)}}" class="media-list-link">
              <div class="media">
                <img src="{{ $product->image }}" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="mg-b-0 tx-medium tx-gray-800 tx-14">{{ $product->product_name??'' }}</p>
                  <span class="d-block tx-13 text-danger">Store Quantity: {{ $product->quantity??'' }}</span>
                </div>
              </div><!-- media -->
            </a>
            @endforeach--}}
            <!-- loop ends here -->
          </div><!-- media-list -->
          <div class="pd-15">
            <a href="" class="btn btn-secondary btn-block bd-0 rounded-0 tx-10 tx-uppercase tx-mont tx-medium tx-spacing-2">View More & Details</a>
          </div>
        </div><!-- #messages -->

        <div class="tab-pane pos-absolute a-0 mg-t-60 overflow-y-auto" id="notifications" role="tabpanel">
          {{-- <div class="media-list">
            <!-- loop starts here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 18 others in a post.</p>
                  <span class="tx-12">October 03, 2017 8:45am</span>
                </div>
              </div><!-- media -->
            </a>
            <!-- loop ends here -->
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img9.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Social Network</strong></p>
                  <span class="tx-12">October 02, 2017 12:44am</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700">20+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                  <span class="tx-12">October 01, 2017 10:20pm</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                  <span class="tx-12">October 01, 2017 6:08pm</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img8.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Suzzeth Bungaos</strong> tagged you and 12 others in a post.</p>
                  <span class="tx-12">September 27, 2017 6:45am</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img10.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700">10+ new items added are for sale in your <strong class="tx-medium tx-gray-800">Sale Group</strong></p>
                  <span class="tx-12">September 28, 2017 11:30pm</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img9.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Mellisa Brown</strong> appreciated your work <strong class="tx-medium tx-gray-800">The Great Pyramid</strong></p>
                  <span class="tx-12">September 26, 2017 11:01am</span>
                </div>
              </div><!-- media -->
            </a>
            <a href="" class="media-list-link read">
              <div class="media pd-x-20 pd-y-15">
                <img src="../img/img5.jpg" class="wd-40 rounded-circle" alt="">
                <div class="media-body">
                  <p class="tx-13 mg-b-0 tx-gray-700"><strong class="tx-medium tx-gray-800">Julius Erving</strong> wants to connect with you on your conversation with <strong class="tx-medium tx-gray-800">Ronnie Mara</strong></p>
                  <span class="tx-12">September 23, 2017 9:19pm</span>
                </div>
              </div><!-- media -->
            </a>
          </div><!-- media-list --> --}}
        </div><!-- #notifications -->

      </div><!-- tab-content -->
    </div><!-- sl-sideright -->
    <!-- ########## END: RIGHT PANEL ########## --->

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">



      @yield('content')



      <footer class="sl-footer d-print-none">
        <div class="footer-left">
          <div class="mg-b-2">Copyright &copy; 2021. STORE MANAGEMENT. All Rights Reserved.</div>
          <div>Made by MMIT SOFT.</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <span class="tx-uppercase mg-r-10">Share:</span>
          <a target="_blank" class="pd-x-5" href="https://www.facebook.com"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com"><i class="fa fa-twitter tx-20"></i></a>
        </div>
      </footer>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->

    <script src="{{ asset('backend/lib/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backend/lib/jquery/jquery351.js') }}"></script>
    <script src="{{ asset('backend/lib/popper.js/popper.js') }}"></script>
    <script src="{{ asset('backend/lib/bootstrap/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/lib/jquery-ui/jquery-ui.js') }}"></script>
    <script src="{{ asset('backend/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js') }}"></script>
    <script src="{{ asset('backend/lib/jquery.sparkline.bower/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('backend/lib/d3/d3.js') }}"></script>
    <script src="{{ asset('backend/lib/rickshaw/rickshaw.min.js') }}"></script>
    <script src="{{ asset('backend/lib/chart.js/Chart.js') }}"></script>
    <script src="{{ asset('backend/lib/Flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('backend/lib/Flot/jquery.flot.pie.js') }}"></script>
    <script src="{{ asset('backend/lib/Flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('backend/lib/flot-spline/jquery.flot.spline.js') }}"></script>

    <script src="{{ asset('backend/js/starlight.js') }}"></script>
    <script src="{{ asset('backend/js/ResizeSensor.js') }}"></script>
    <script src="{{ asset('backend/js/dashboard.js') }}"></script>
    <script src="{{ asset('backend/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('.search-select').select2();
    </script>
    @yield('js')

  </body>
</html>

