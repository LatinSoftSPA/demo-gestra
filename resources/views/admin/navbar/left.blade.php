<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <div class="user-panel">
      <div class="pull-left image">
        <!-- User Image -->
        @if(Auth::user()->foto_perfil !== NULL)
          <img src="{{{ asset('adminlte/img') }}}/{{ Auth::user()->foto_perfil }}" class="img-circle" alt="User Image">
        @else
          <img src="{{{ asset('adminlte/img/female.png') }}}" class="user-image" alt="User Image">
        @endif
      </div>
      <div class="pull-left info">
        <p>{{ Auth::user()->prim_nombr }} {{ Auth::user()->apel_pater }}</p>

        <!-- Status -->
        @if(Auth::user()->online == false) 
          <a href="#"><i class="fa fa-circle text-danger"></i> OffLine</a>
        @else
          <a href="#"><i class="fa fa-circle text-success"></i> OnLine</a>
        @endif
        
      </div>
    </div>

    <!-- search form (Optional) -->
    @if(empty($data['buscare']))
    @else
    <div class="input-group input-group-lg sidebar-form">
      {!! Form::text($data['buscare'], null, ['class' => 'form-control', 'id' => $data['buscare'], 'placeholder' => 'Buscar', 'aria-describedby' => 'search']) !!}
      <span class="input-group-btn">
        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
        </button>
      </span>
    </div>
    @endif
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <!-- Optionally, you can add icons to the links -->
      <li class="{{ Request::is('bienvenida') ? 'active' : '' }}">
        <a href="{{ route('bienvenida') }}">
          <i class="fa fa-home"></i> <span>Home</span>
        </a>
      </li>

		<li class="treeview {{ Request::is('recaudaciones') ? 'active' : '' }}">
			<a href="#">
          <i class="fa fa-money fa-fw"></i> <span>Recaudacion</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
			</a>
			<ul class="treeview-menu">
				<li><a href="{{ route('recaudaciones.estadisticas') }}"><i class="fa fa-line-chart fa-fw"></i> Estadisticas</a></li>
        <!--
				<li><a href="#!"><i class="fa fa-handshake-o fa-fw"></i> Multas</a></li>
				<li><a href="#!"><i class="fa fa-tasks fa-fw"></i> Cuotas</a></li>
				<li><a href="#!"><i class="fa fa-pie-chart fa-fw"></i> Otros</a></li>
        -->
			</ul>
		</li>

      <li class="treeview {{ Request::is('gestion/servicios') ? 'active' : '' }}">
        <a href="#">
          <i class="fa fa-road fa-fw"></i> <span>Control de Flota</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
    			<li><a href="{{ route('servicios.index') }}"><i class="fa fa-files-o fa-fw"></i> Servicios</a></li>
    			<li><a href="{{ route('estadisticas.index') }}"><i class="fa fa-line-chart fa-fw"></i>Estadisticas</a></li>
        </ul>
      </li>

      <li class="{{ Request::is('manager') ? 'active' : '' }}">
        <a href="{{ route('manager') }}">
          <i class="fa fa-window-restore fa-fw"></i> <span>Manager</span>
        </a>
      </li>

      <li class="treeview {{ Request::is('inf/servicios') ? 'active' : '' }}">
        <a href="#">
            <i class="fa fa-file-text fa-fw"></i> <span>Informes</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="{{ route('informes.servicios') }}"><i class="fa fa-files-o fa-fw"></i> Servicios</a></li>
          <li><a href="#!"><i class="fa fa-exchange fa-fw"></i> Expediciones</a></li>
				<li><a href="#!"><i class="fa fa-line-chart fa-fw"></i> Cuadraturas</a></li>
        </ul>
      </li>

      <li class="{{ Request::is('administracion') ? 'active' : '' }}">
        <a href="{{ route('administracion') }}">
          <i class="fa fa-archive fa-fw"></i> <span>Administracion</span>
        </a>
      </li>

      <li class="treeview {{ Request::is('') ? 'active' : '' }}">
        <a href="#"><i class="fa fa-wrench fa-fw"></i> <span>Configuracion</span><span class="pull-right-container"><i class="fa fa-angle-left pull-right"></i></span>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-print fa-fw"></i> Impresoras</a></li>
          <li><a href="#"><i class="fa fa-tv fa-fw"></i> Monitores</a></li>
        </ul>
      </li>

    </ul>
    <!-- /.sidebar-menu -->
  </section>
  <!-- /.sidebar -->
</aside>