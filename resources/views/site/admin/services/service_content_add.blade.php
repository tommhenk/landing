<div class="wrapper content-fluid">
	{!! Form::open(['url'=>(isset($service)) ? route('serviceEdit', ['service'=>$service->id]) :route( 'serviceAdd' ), 'class'=>"form-horizontal", 'method'=>'POST', 'enctype'=>"multipart/form-data" ]) !!}
	<div class="form-group">
		{!! Form::label('name', 'Название :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::text('name', isset($service) ? $service->name : old('name'), ['class'=>'form-control', 'placeholder'=>'name']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('text', 'Текст :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::textarea('text', isset($service) ? $service->text : old('text'), ['class'=>'form-control', 'placeholder'=>'filter', 'id'=>'editor']) !!}
		</div>
	</div>

	@if ($icons)
		<div class="form-group">
		{!! Form::label('icon', 'Иконка :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::select('icon', $icons, isset($service) ? $service->icon : null, ['class'=>'form-control']) !!}
		</div>
	</div>
	@endif

	<div class="form-group">
		<div class="col-xs-offset-2 col-xs-10">
			{!! Form::button('Сохранить', ['class'=>'btn btn-primary', 'type'=>'submit']) !!}
		</div>
	</div>
	{!! Form::close() !!}
</div>
<script>
                // Replace the <textarea id="editor1"> with a CKEditor 4
                // instance, using default configuration.
                CKEDITOR.replace( 'editor' );
            </script>