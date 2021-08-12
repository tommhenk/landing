<div style="margin: 0px 50px 0px 50px">
	@isset ($pages)
	    	<table class="table table-hover table-striped">
				<thead>
					<tr>
						<td>№ П/П</td>
						<td>Имя</td>
						<td>Псевдоним</td>
						<td>Текст</td>
						<td>Дата создания</td>
						<td>Удалить</td>
					</tr>
				</thead>
				<tbody>
					@foreach ($pages as $page)
						<tr>
							
							<td>{{ $loop->iteration }}</td>
							<td>{!! Html::link(route('pagesEdit', ['page'=>$page->id]), $page->name, ['alt'=>$page->name]) !!}</td>
							<td>{{ $page->alias }}</td>
							<td>{{ $page->text }}</td>
							<td>{{ $page->created_at }}</td>
							<td>
								{!! Form::open(['url'=>route( 'pagesEdit', ['page'=>$page->id] ), 'class'=>"form-horizontal", 'method'=>'POST' ]) !!}
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
	{!! html::link(route('pagesAdd'), 'Новая страница',['class'=>'btn btn-primary ']) !!}
</div>