@extends('layouts.master') 
@section('nameUser') 

@isset ($_SESSION['glpiname']) {{ $_SESSION['glpiname'] }} @endisset 

@endsection

@section('h4title') 

Les Porteurs 

@endsection 

@section('conteOfObject')
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<ul class="right-stats" id="mini-nav-right">
		<li>
			<a href="javascript:void(0)" class="btn btn-danger">
				<span>{{ $sizelist }}</span>Porteurs

			</a>
		</li>
	</ul>
</div>

@endsection 
@section('content')

<div class="main-container">
	<div class="row gutter">
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h4>Liste des porteurs</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="scrollTable" class="display table table-striped table-bordered no-margin" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Nom du porteur </th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($listporteurs as $porteur)
								<tr>
									<td>{{ $porteur->nameofporteur }}</td>
									<td><a id='{{ $porteur->id }}' class='btn btn-default btn-rounded icon-pencil modifyUser' href='{{ url('porteur/edit/'.$porteur->id) }}' title='Modification du porteur'></a>
										<a id='{{ $porteur->id }}' class='btn btn-default btn-rounded icon-delete_forever deletePorteur' style='padding-left: 10px;' title='Supprimer le porteur'></a>
									</tr>																																												</td>
								@endforeach

							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h4>Modification du porteur
						<h4>
				</div>
				<div class="panel-body">

						<form accept-charset="utf-8" id="form" name="form" method="post" action="{{ url('porteur/'.$porteurtoedit->id) }}">
							@if (count($errors))
							<div class="alert alert-warning alert-dismissible">			
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
								<ul>
									@foreach ( $errors->all() as $message )
										<li>{{ $message }}</li>
									@endforeach
								</ul>
							</div>
							@endif
							@method('PUT')
							@csrf
						<div class="form-group @if($errors->get('nameofporteur')) has-error @endif">
							<div class="row gutter">
								<div class="col-md-12">
									<label class="control-label">Nom du porteur</label>
									<label for="nameofporteur" class="control-label">Nom du porteur</label>
									<input id="nameofporteur" type="text" required class="form-control" placeholder="Nom du porteur" name="nameofporteur" value="{{ $porteurtoedit->nameofporteur }}">
								</div>
							</div>
						</div>
						<div class="form-group no-margin">
							<div class="row gutter">
								<div class="col-md-12">
									<button type="submit" class="btn btn-danger">Valider</button>
									<button type="reset" class="btn btn-warning">Annuler</button>
								</div>
							</div>
						</div>
						</form>
				</div>
			</div>
		</div>
	</div>
</div>


@endsection 
@section('style')
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bs.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/autoFill.bs.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/fixedHeader.bs.css') }}"> 
@endsection
 @section('scripts')
<script src="{{ asset('js/sparkline/sparkline.js') }}"></script>
<script src="{{ asset('js/databars/jquery.databar.js') }}"></script>
<script src="{{ asset('js/databars/custom-databars.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('js/datatables/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/datatables/autoFill.min.js') }}"></script>
<script src="{{ asset('js/datatables/autoFill.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/datatables/fixedHeader.min.js') }}"></script>
<script src="{{ asset('js/datatables/custom-datatables.js') }}"></script>
<script src="{{ asset('js/bsvalidator/bootstrapValidator.js') }}"></script>
<script src="{{ asset('js/bsvalidator/custom-validations.js') }}"></script>

@if (isset($statcode) && $statcode==200)
<script>
    new Noty({
        text:'<div class="icon i_tick notifico">le porteur a été modifié avec succès</div>',
      	type: 'success',
		layout: 'center',
		timeout:2000,
       	animation: {
					open: 'animated bounceInLeft', 
					close: 'animated bounceOutLeft',
					}
        }).show();
</script>
@endif
@endsection