<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ __('home.admindashboard') }}</title>

  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;1,400&display=swap" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

   {{-- Summernote CDN --}}

   <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

     {{-- Select2 Style CDN --}}
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

  @yield('styles')

  <style>
    .unread{
      background-color: #e5e5e5;
    }
  </style>
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-text mx-3">{{ __('home.badael') }}<sup>1.0</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>{{ __('home.dashboard') }}</span></a>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.managment') }}</span>
        </a>
        <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.user') }}">{{ __('home.user') }}</a>
            <a class="collapse-item" href="{{ route('admin.role') }}">{{ __('home.role') }}</a>
            <a class="collapse-item" href="{{ route('admin.permission') }}">{{ __('home.permission') }}</a>
          </div>
        </div>
      </li>

      {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.user') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>Admin</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.role') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>Roles</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.permission') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>Permissions</span></a>
      </li> --}}

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.blog') }}</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.post') }}">{{ __('home.blog') }}</a>
            <a class="collapse-item" href="{{ route('admin.category') }}">{{ __('home.cate') }}</a>
            <a class="collapse-item" href="{{ route('admin.tag') }}">{{ __('home.tag') }}</a>
            <a class="collapse-item" href="{{ route('admin.post.trash') }}">{{ __('home.trash') }}</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.portfolio') }}</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.portfolio') }}">{{ __('home.portfolio') }}</a>
            <a class="collapse-item" href="{{ route('admin.pcategory') }}">{{ __('home.portfoliocate') }}</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.faq') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.faq') }}</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.link') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.link') }}</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.page') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.page') }}</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.partner') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.partner') }}</span></a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.service') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.service') }}</span></a>
      </li>

      {{-- @can('team-list') --}}
      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.team') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.team') }}</span></a>
      </li>
      {{-- @endcan --}}

      <li class="nav-item">
        <a class="nav-link" href="{{ route('admin.testi') }}">
          <i class="fas fa-fw fa-table"></i>
          <span>{{ __('home.testi') }}</span></a>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-wrench"></i>
          <span>{{ __('home.setting') }}</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{ route('admin.about') }}">{{ __('home.about') }}</a>
            <a class="collapse-item" href="{{ route('admin.banner') }}">{{ __('home.banner') }}</a>
            <a class="collapse-item" href="{{ route('admin.general') }}">{{ __('home.generalsetting') }}</a>
          </div>
        </div>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

          <!-- Sidebar Toggle (Topbar) -->
          <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>

          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            {{-- dropdown language --}}
            <li class="dropdown m-4">
              <a class="dropdown-toggle" data-toggle="dropdown" role="button">{{ __('home.lang') }}</a>
              <ul class="dropdown-menu">
                <li><a href="{{url("locale/en")}}">EN</a></li>
                <li><a href="{{url("locale/ar")}}">AR</a></li>
              </ul>
            </li>

            {{-- <a class = "language{{ App::isLocale('en') ? ' active' : '' }}" href="/locale/en">En</a>       --}}
            {{-- <a class = "language{{ App::isLocale('ar') ? ' active' : '' }}" href="/locale/ar">Ar</a>  --}}
            {{--  --}}

            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->name }}</span>
                <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  {{ __('home.logout') }}
                </a>
              </div>
            </li>
             {{-- notification --}}
            <li class="nav-item dropdown no-arrow notification">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    <span class="badge badge-warning navbar-badge" id="count">
                        @if(count(auth()->user()->unreadNotifications))
                            <span class="badge badge-warning">{{ count(auth()->user()->unreadNotifications) }}</span>
                        @endif
                    </span>
                </a>
                <!-- Dropdown - Notification Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown" role="menu">
                  <span class="dropdown-header">{{ __('home.unnotifi') }}</span>
                  @foreach (auth()->user()->unreadNotifications as $notification)
                    <a href="#" class="dropdown-item {{ $notification->read_at == null ? 'unread' : '' }}" >
                        <i class="fas fa-envelope"></i> {{ $notification->data['title'] }}
                        <span class="ml-2 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                        <span href="#" class="float-right mark-as-read" data-id="{{ $notification->id }}">
                                Mark as read
                        </span>
                    </a>
                  @endforeach

                  <div class="dropdown-divider"></div>
                  <span class="dropdown-header">{{ __('home.notifi') }}</span>
                  @forelse(auth()->user()->readNotifications as $notification)
                    <a href="#" class="dropdown-item">
                        <i class="fas fa-envelope mr-2"></i> {{ $notification->data['description'] }}
                        <span class="ml-3 pull-right text-muted text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                    </a>
                  @empty
                  <span class="ml-3 pull-right text-muted text-sm">{{ __('home.nonotifi') }}</span>
                  @endforelse

                  <div class="dropdown-divider"></div>
                  <a href="#" class="dropdown-item dropdown-footer">Mark all as read</a>
                </div>
              </li>
          </ul>

        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

            @yield('content')

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>{{ __('home.copyright') }} &copy; {{ __('home.badaelonline') }}</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">{{ __('home.readytileave') }}</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">{{ __('home.selectlogout') }}</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('home.cancel') }}</button>

          <a class="btn btn-primary" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                      {{ __('Logout') }}
                                                    </a>

          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>

        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="{{ asset('admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('admin/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('admin/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('admin/js/demo/chart-pie-demo.js') }}"></script>

  {{-- Select2 JS --}}
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

  <script>
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: "Choose Some Tags"
        });
    });
    $(function(){
      $('.selectpicker').selectpicker();
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
  <script src="{{ asset('admin/js/summernote-image-title.js') }}"></script>

  <script>
    $(document).ready(function() {
    $('#summernote').summernote({
      fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana', 'Poppins'],
    fontNamesIgnoreCheck: ['Poppins'],
        imageTitle: {
          specificAltField: true,
        },
        lang: 'en-US',
        popover: {
            image: [
                ['imagesize', ['imageSize100', 'imageSize50', 'imageSize25']],
                ['float', ['floatLeft', 'floatRight', 'floatNone']],
                ['remove', ['removeMedia']],
                ['custom', ['imageTitle']],
            ],
        },
    });
  });
  // notification count
  var count = $('#count'), c ;
    c = parseInt(count.html());
    // count.html(c+1);
    // notification style
    $('.notification').on('click',function(){
      setTimeout(() => {
        count.html(0);
        $('.unread').each(function(){
        $(this).removeClass('unread');
      });
      }, 3000);
    //   $.get('MarkAllSeen', function(){});
    });
  </script>


  @stack('scripts')

</body>

</html>
