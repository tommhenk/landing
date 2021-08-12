<header id="header_wrapper">
  <div class="container">
    <div class="header_box">
      <div class="logo"><a href="#"><img src="{{ asset('assets') }}/img/logo.png" alt="logo"></a></div>
	  <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" id="nav-toggle" class="navbar-toggle" data-toggle="collapse" data-target="#main-nav"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
	    <div id="main-nav" class="collapse navbar-collapse navStyle">
			<ul class="nav navbar-nav" id="mainNav">
				@isset ( $menu )
					@foreach ($menu as $item)
						<li><a href="#{{ $item['alias'] }}" class="scroll-link">{{ $item['title'] }}</a></li>
					@endforeach
				@endisset
			</ul>
      </div>
	 </nav>
    </div>
  </div>
</header>

@if (!empty(session('status')))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

@if ($errors->count() > 0)
	<div class="alert alert-danger">
		<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>
	</div>		
@endif