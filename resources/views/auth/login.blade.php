<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<meta name="csrf-token" content="dmxmdsUogQj2onyiowVTPU9a3hQgWIHwDLlWRwKm">
	<title>SGE</title>
	<!-- CSS -->
	
	<script src="https://kit.fontawesome.com/b61b350b0d.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/style.css') }}" rel="stylesheet">
	<!-- SCRIPTS -->
	<script src="{{ asset('js/app.js') }}" defer></script>

	<!-- DATA TABLES REFERENCIAS -->
	<!-- <link rel="stylesheet" type="text/css" href="{{ asset('DataTables/datatables.min.css')}}"/> -->


</head>

<body>

<div class="container-fluid single-page" id="main-container">
    <div class="middle-panel-login">
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="row">
                    <div class="col-sm-2 col-sm-offset-5 col-xs-4 col-xs-offs=et-4">
                        <img src="https://morelia.tecsge.com/img/sge_white.png" alt="SGE" class="img-responsive">
                    </div>
                </div>
                <br>
                <form method="POST" action="{{ route('login') }}">
                        @csrf
                    <div class="panel panel-default">
                        <div class="panel-heading image text-center">
                            <img src="https://morelia.tecsge.com/img/tnm.png" alt="Logo Tec" class="img-heading hidden-xs">
                            <h3 class="panel-title">
                                Instituto Tecnológico de Morelia
                            </h3>
                            <img src="https://morelia.tecsge.com/storage/data/tec/zpHB68Mn9ybbH7l9JuRsVwOpxeDW25rmC5cMVEeQ.png" alt="Logo Tec" class="img-heading hidden-xs">
                        </div>
                        <div class="panel-body">
                            <p class="text-center">Bienvenido al Sistema de Evaluaciones Departamentales, por favor ingrese usuario y contraseña para acceder.</p>
                            <br>
                            <ul class="nav nav-pills nav-center">
                                <li role="presentation"><a href="https://morelia.tecsge.com/login">Iniciar sesión </a> </li> </ul> <br>
                                                    <div class="row">
                                                        <div class="col-sm-10 col-sm-offset-1">
                                                            <div class="form-group label-floating">
                                                                <label for="ncontrol" class="control-label">Usuario</label>
                                                                <input type="text" name="username" id="username" class="form-control" value="">
                                                            </div>
                                                            <div class="form-group label-floating">
                                                                <label for="password" class="control-label">Contraseña</label>
                                                                <input type="password" name="password" id="password" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                        </div>
                        <div class="panel-footer text-right">
                            <button type="submit" class="btn btn-primary btn-raised btn-sm"><i class="fa fa-sign-in"></i> Acceder</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



	
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script type="text/javascript" src="{{ asset('DataTables/datatables.min.js')}}"></script>
	
</body>

</html>