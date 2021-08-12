<div style="margin: 0px 50px 0px 50px">
	@isset ($services)
	    	<table class="table table-hover table-striped">
				<thead>
					<tr>
						<td>№ П/П</td>
						<td>Имя</td>
						<td>Текст</td>
						<td>Иконка</td>
						<td>Дата создания</td>
						<td>Удалить</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($services as $service)
						<tr>
							
							<td>{{ $loop->iteration }}</td>
							<td>{!! Html::link(route('serviceEdit', ['service'=>$service->id]), $service->name, ['alt'=>$service->name]) !!}</td>
							<td>{{ Str::limit($service->text, 200) }}</td>
							<td>
								<div class="service_icon delay-03s animated wow  zoomIn" style="text-align: center"> <span><i class="fa {{ $service->icon }}"></i></span> </div>
							</td>
							<td>{{ $service->created_at }}</td>
							<td>
								{!! Form::open(['url'=>route( 'serviceEdit', ['service'=>$service->id] ), 'class'=>"form-horizontal", 'method'=>'POST' ]) !!}
								{{-- {!! Form::hidden('_method', 'delete') !!} --}}
								{{ method_field('delete') }}
								{!! Form::button('Удалить', ['class'=> 'btn btn-danger', 'type'=>'submit']) !!}
								{!! Form::close() !!}
							</td>
						</tr>		
					@endforeach
				</tbody>
			</table>
	@endisset
	{!! html::link(route('serviceAdd'), 'Новая страница',['class'=>'btn btn-primary ']) !!}
</div>