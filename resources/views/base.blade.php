	<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<!-- <meta name="csrf-token" content="dmxmdsUogQj2onyiowVTPU9a3hQgWIHwDLlWRwKm"> -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>SGE</title>
	<!-- CSS -->

	<script src="https://kit.fontawesome.com/b61b350b0d.js" crossorigin="anonymous"></script>
	<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">

	<!-- SCRIPTS -->
	<script src="{{ asset('js/app.js') }}" defer></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>





	<!-- DATA TABLES REFERENCIAS -->
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css')}}"/> -->


</head>

<body>
	<div class="dashboard-page" id="main-container">
		<nav class="navbar navbar-default navbar-fixed-top" id="main-navbar">
			<div class="container-fluid">
				<div class="navbar-header">
					<a class="navbar-brand hidden-sm hidden-md hidden-lg" href="#">
						Daniela Villa Barcenas
					</a>
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-menu-1" aria-expanded="false" id="menu-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				</div>
				<div class="collapse navbar-collapse hidden-xs" id="collapse-menu-1">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle navbar-text" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
								Daniela Villa Barcenas
								<img src="https://morelia.tecsge.com/img/user.svg" alt="Usuario" class="img-navbar">
							</a>
							<ul class="dropdown-menu">
								<li><a href="https://morelia.tecsge.com/logout">Cerrar sesión</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<aside class="sidebar in" id="main-sidebar" role="navigation">
			<div class="sidebar-logo">
				<img src="https://morelia.tecsge.com/img/sge_white.png" alt="Logo" class="img-logo">
				IT Morelia
			</div>
			<div class="sidebar-outer">
				<div class="side-menu">

					@yield('options')

				</div>
			</div>
		</aside>
		<a href="#" class="float-button bottom-left in" id="open-main-sidebar"><i class="fa fa-arrow-circle-right"></i> Mostrar menú</a>
		<div class="body-container animated fadeIn">
			<div class="container-fluid">
				<div class="row">
					@yield('content')
				</div>
			</div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>

	<script src="{{ asset('js/modal.js') }}" defer></script>
	<script src="{{ asset('js/tipoReactivo.js') }}" defer></script>
	<script src="{{ asset('js/selectDinamicos.js') }}" defer></script>
	<script src="{{ asset('js/agregarPreguntas.js') }}" defer></script>
	<script src="{{ asset('js/tipoPreguntaModal.js') }}" defer></script>



</body>

</html>