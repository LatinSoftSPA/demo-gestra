<!-- Main Header -->
<header class="main-header">
  <!-- Logo -->
  <a href="{{ config('app.url', 'APP') }} " class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>LS</b></span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg">
      <b>{{ config('app.name', 'APP') }} LS</b>
    </span>
  </a>

  <!-- Header Navbar -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <!-- Navbar Right Menu -->
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <!-- Messages: style can be found in dropdown.less-->
        <li class="dropdown messages-menu">
          <!-- Menu toggle button -->
          <!--
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-envelope-o"></i>
            <span class="label label-success">4</span>
          </a>
          -->
          <ul class="dropdown-menu">
            <li>
              <!-- inner menu: contains the messages -->
              <ul class="menu">
                <li><!-- start message -->
                  <a href="#">
                    <div class="pull-left">
                      <!-- User Image -->
                      @if(Auth::user()->foto_perfil !== NULL)
                        <img src="{{{ asset('adminlte/img') }}}/{{ Auth::user()->foto_perfil }}" class="img-circle" alt="User Image">
                      @else
                        <img src="{{{ Auth::user()->foto_perfil }}}" class="img-circle" alt="User Image">
                      @endif
                      
                    </div>
                    <!-- Message title and timestamp -->
                    <h4>
                      Support Team
                      <small><i class="fa fa-clock-o"></i> 5 mins</small>
                    </h4>
                    <!-- The message -->
                    <p>Why not buy a new awesome theme?</p>
                  </a>
                </li>
                <!-- end message -->
              </ul>
              <!-- /.menu -->
            </li>
            <li class="header">You have 4 messages</li>
            <li class="footer"><a href="#">See All Messages</a></li>
          </ul>
        </li>
        <!-- /.messages-menu -->

        <!-- Notifications Menu -->
        <!--
        <li class="dropdown notifications-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-bell-o"></i>
            <span class="label label-warning">10</span>
          </a>
          <ul class="dropdown-menu">
            <li class="header">You have 10 notifications</li>
            <li>
              <ul class="menu">
                <li>
                  <a href="#">
                    <i class="fa fa-users text-aqua"></i> 5 new members joined today
                  </a>
                </li>
              </ul>
            </li>
            <li class="footer"><a href="#">View all</a></li>
          </ul>
        </li>
        -->
        <!-- Tasks Menu -->
        <li class="dropdown tasks-menu">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <i class="fa fa-tasks"></i>
            <span class="label label-success" id="total_tareas"></span>
          </a>
          <ul class="dropdown-menu">
            <li>
              <ul class="menu" id="listaTareas">
                <li id="tareasProcesar">

                </li>
                <button type="button" class="btn btn-warning btn-block" id="btnProcesar" disabled="disabled"><span class="glyphicon glyphicon-retweet" aria-hidden="true"></span> Procesar</button>
              </ul>
            </li>
          </ul>
        </li>
        <!-- User Account Menu -->
        <li class="dropdown user user-menu">
          <!-- Menu Toggle Button -->
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
            <!-- The user image in the navbar-->
            <!-- User Image -->
            @if(Auth::user()->foto_perfil !== NULL)
              <img src="{{{ asset('adminlte/img') }}}/{{ Auth::user()->foto_perfil }}" class="user-image" alt="User Image">
            @else
              <img src="{{{ asset('adminlte/img/female.png') }}}" class="user-image" alt="User Image">
            @endif
            
            <!-- hidden-xs hides the username on small devices so only the image appears. -->
            <span class="hidden-xs">{{ Auth::user()->prim_nombr }} {{ Auth::user()->segu_nombr }}  {{ Auth::user()->apel_pater }} {{ Auth::user()->apel_mater }}</span>
          </a>
          <ul class="dropdown-menu">
            <!-- The user image in the menu -->
            <li class="user-header">
              @if(Auth::user()->foto_perfil !== NULL)
                <img src="{{{ asset('adminlte/img') }}}/{{ Auth::user()->foto_perfil }}" class="img-circle" alt="User Image">
              @else
                <img src="{{{ asset('adminlte/img/female.png') }}}" class="img-circle" alt="User Image">
              @endif

              <p>
                {{ Auth::user()->prim_nombr }}
                <small>({{ Auth::user()->rol }})</small>
              </p>
            </li>
            <!-- Menu Body -->
            <li class="user-body">
              <div class="row">
                <div class="col-xs-4 text-center">
                  <a href="#">Multas</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Cuotas</a>
                </div>
                <div class="col-xs-4 text-center">
                  <a href="#">Otros</a>
                </div>
              </div>
              <!-- /.row -->
            </li>
            <!-- Menu Footer-->
            <li class="user-footer">
              <div class="pull-left">
                <a href="#" class="btn btn-info btn-flat">
                  <i class="fa fa-user"></i> Perfil
                </a>
              </div>
              <div class="pull-right">
                <a class="btn btn-danger btn-flat" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out"></i> {{ __('Salir') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
              </div>
            </li>
          </ul>
        </li>
        <!-- Control Sidebar Toggle Button -->
        <!--
        <li>
          <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
        </li>
        -->
      </ul>
    </div>
  </nav>
</header>