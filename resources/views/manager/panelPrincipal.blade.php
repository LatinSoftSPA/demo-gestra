@foreach ($data['modulos'] as $obj)
	<div class="col-lg-4 col-md-6">
	  <div class="small-box {{ $obj['color'] }}">
		<div class="inner">
		  <h3>{{ $obj['total'] }}</h3>

		  <p>{{ $obj['title'] }}</p>
		</div>
		<div class="icon">
		  <i class="{{ $obj['icono'] }}"></i>
		</div>
		
		<a href="{{ $obj['route']['list'] }}" class="small-box-footer bg-yellow">Listar <i class="fa fa-list"></i></a>
	  </div>
	</div>
@endforeach