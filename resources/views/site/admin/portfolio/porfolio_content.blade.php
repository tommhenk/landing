<div style="margin: 0px 50px 0px 50px">
	@isset ($portfolios)
	    	<table class="table table-hover table-striped">
				<thead>
					<tr>
						<td>№ П/П</td>
						<td>Имя</td>
						<td>Фильтр</td>
						<td>Дата создания</td>
						<td>Удалить</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($portfolios as $portfolio)
						<tr>
							
							<td>{{ $loop->iteration }}</td>
							<td>{!! Html::link(route('portfolioEdit', ['portfolio'=>$portfolio->id]), $portfolio->name, ['alt'=>$portfolio->name]) !!}</td>
							<td>{{ $portfolio->filter }}</td>
							<td>{{ $portfolio->created_at }}</td>
							<td>
								{!! Form::open(['url'=>route( 'portfolioEdit', ['portfolio'=>$portfolio->id] ), 'class'=>"form-horizontal", 'method'=>'POST' ]) !!}
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
	{!! html::link(route('portfolioAdd'), 'Новая страница',['class'=>'btn btn-primary ']) !!}
</div>