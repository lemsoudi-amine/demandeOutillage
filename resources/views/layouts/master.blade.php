
	<!DOCTYPE html>
	<html lang="{{ app()->getLocale() }}">

	<head>

		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>Demande outillage</title>
		@include('layouts.style')
		
	
	</head>

	<body>
		<header>
				<a href='#' class="logo">
				<img src={{ asset('css/img/logo.png') }} alt="Demande d'outillage">
					</a>
					<ul id="header-actions" class="clearfix">													
									<li class="list-box user-admin dropdown">
										<div class="admin-details">
											<div class="name">@yield('nameUser')</div>
											<div class="designation">Current User</div>
										</div>
										<a id="drop4" href="#" role="button" class="dropdown-toggle" data-toggle="dropdown">
											<i class="icon-account_circle"></i>
										</a>
										<ul class="dropdown-menu sm">
											<li id="deconnexion" class="dropdown-content">
													<a href="/glpi/front/logout.php" title="Déconnexion" class="fa fa-sign-out"><span>Déconnexion</span>
													</a>
												</li>
											</ul>
										</li>
									</ul>
									<div class="custom-search hidden-sm hidden-xs">
										<input type="text" class="search-query" placeholder="Search here ...">
											<i class="icon-search3"></i>
										</div>
									</header>
	 
		<div class="container-fluid">
				<nav class="navbar navbar-default">
						<div class="navbar-header">
							<span class="navbar-text">Menu</span>
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#collapse-navbar" aria-expanded="false">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="collapse navbar-collapse" id="collapse-navbar">
							<ul class="nav navbar-nav">
								<li  class=" {{ (\Request::route()->getName() == 'dashboard') ? 'active' : '' }}">
									<a href="{{ url('/') }}" role="button" aria-haspopup="true" aria-expanded="false" >
										<i class="icon-blur_on"></i>Dashboard
									</a>
								</li>
							<li class=" {{ (\Request::route()->getName() == 'demandes') ? 'active' : '' }}">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
										<i class="icon-subtitles"></i>Gestion des demandes 
										<span class="caret"></span>
									</a>
									<ul class="dropdown-menu">
										<li>
											<a href="{{ url('demandes') }}">Historique des demandes d'outillage</a>
										</li >
										<li>
											<a href="{{ url('demande/create') }}">Créer une demande d'outillage</a>
										</li>
									</ul>
								</li>
								<li  class=" {{ (\Request::route()->getName() == 'actions') ? 'active' : '' }}">
										<a href="{{ url('actions') }}" role="button" aria-haspopup="true" aria-expanded="false">
											<i class="icon-widgets"></i>ACTIONS
											@if($nbraction!=0)
											<span class="info-label blue-bg">{{$nbraction}}</span>
											@endif
										</a>
										
									</li>
							</ul>
							@if($isCoordinateur)
							
							<ul class="nav navbar-nav" style="float: right;">
							  <li class="dropdown {{ ((\Request::route()->getName() == 'porteurs')||(\Request::route()->getName() == 'sections')) ? 'active' : '' }}">
							   <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
											   <i class="icon-business_center"></i>Paramétrage
												<span class="caret"></span></a>
												<ul class="dropdown-menu">
												 	<li><a href="{{ url('sections') }}">Gestion des sections</a></li>
												 	<li><a href="{{ url('porteurs') }}" >Gestion des porteurs</a></li>	
												 	<li><a data-toggle="modal" data-target="#modalFormImport">Import des données</a></li>	
												 	<li><a href="{{url('exportParametres')}}">Export des Parametres</a></li>	
												 	<li><a href="{{url('exportCommandes')}}">Export des Commandes</a></li>																										
											  </ul>
										   </li>
						   </ul>

							@endif					
						</div>
					</nav>
			<div class="dashboard-wrapper">
				<div class="top-bar clearfix">
					<div class="row gutter">
						<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
							<div class="page-title">
								<h4>@yield('h4title')</h4>
							</div>
						</div>
						@yield('conteOfObject')		
					</div>
				</div>
				<div class="main-container">
						@yield('content')
						@include('layouts.modalimport')
				</div>				
			</div>
		</div>
			<footer> Demande d'outillage <span>2018-2019</span>
			</footer>																						
		@include('layouts.script')
	</body>
	
	</html>