<div class="wrapper content-fluid">
	{!! Form::open(['url'=>route( 'portfolioAdd' ), 'class'=>"form-horizontal", 'method'=>'POST', 'enctype'=>"multipart/form-data" ]) !!}
	<div class="form-group">
		{!! Form::label('name', 'Название :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::text('name', old('name'), ['class'=>'form-control', 'placeholder'=>'name']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('filter', 'Фильтер :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::text('filter', old('filter'), ['class'=>'form-control', 'placeholder'=>'filter']) !!}
		</div>
	</div>

	<div class="form-group">
		{!! Form::label('img', 'Изображение :',['class'=>'col-xs-2 control-label']) !!}
		<div class="col-xs-8">
			{!! Form::file('img', ['class'=>'filestyle', 'data-buttontext'=>'Выберете изображение', 'data-buttonName'=>'btn btn-primary', 'data-placeholder'=>'Файла нет']) !!}
		</div>
	</div>

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