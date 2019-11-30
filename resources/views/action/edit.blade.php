@extends('layouts.master') 
@section('nameUser') 

@isset ($_SESSION['glpiname']) {{ $_SESSION['glpiname'] }} @endisset 

@endsection

@section('h4title') 

LES Sections 

@endsection 

@section('conteOfObject')
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<ul class="right-stats" id="mini-nav-right">
		<li>
			<a href="javascript:void(0)" class="btn btn-danger">
				<span>{{ $sizelist }}</span>Sections

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
					<h4>Liste des sections</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="scrollTable" class="display table table-striped table-bordered no-margin" cellspacing="0" width="100%">
							<thead>
								<tr>
										<th>Numéro de la section </th>
										<th>Nom de la section </th>
										<th>Référent secteur </th>																																
										<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($listsections as $section)
								<tr>
									<td>{{ $section->num_section }}</td>
									<td>{{ $section->nameofsection }}</td>
									<td>{{ $section->refeent_secteur }}</td>
									<td class="text-center"><a id='{{ $section->id }}' class='btn btn-default btn-rounded icon-pencil modifyUser' href='{{ url('section/edit/'.$section->id) }}' title='Modification de la section'></a>
										<form style="display: contents;" accept-charset="utf-8" id="form" name="form" method="post" action="{{ url('section/'.$section->id) }}" >
											@method('DELETE')
											@csrf
											<button id='{{ $section->id }}'type="submit" class='btn btn-default btn-rounded icon-delete_forever deleteSection' style='padding-left: 10px;' title='Supprimer la section'></button>
									</form>
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
					<h4>Modification de la section
						<h4>
				</div>
				<div class="panel-body">

						<form accept-charset="utf-8" id="form" name="form" method="post" action="{{ url('section/'.$sectiontoedit->id) }}">
								@if (count($errors))
								<div class="alert alert-danger alert-dismissible" data-dismiss="alert">			
									<div><ul>
											@foreach ( $errors->all() as $message )
												<li>{{ $message }}</li>
											@endforeach
										</ul></div>
									
								</div>
								@endif
								@method('PUT')
								@csrf
						<div class="form-group @if($errors->get('nameofsection')) has-error @endif">
							<div class="row gutter">
								<div class="col-md-12">
									<label for="nameofsection" class="control-label">Nom de la section</label>

									<input id="nameofsection" type="text" required class="form-control" placeholder="Nom du porteur" name="nameofsection"  value="{{ $sectiontoedit->nameofsection }}">
								</div>
							</div>
						</div>
						<div class="form-group @if($errors->get('num_section')) has-error @endif">
								<div class="row gutter">
									<div class="col-md-12">
										<label for="num_section" class="control-label">Numéro de la section</label>
	
										<input id="num_section" type="text" required class="form-control" placeholder="Nom du porteur" name="num_section"  value="{{ $sectiontoedit->num_section }}">
									</div>
								</div>
							</div>
							<div class="form-group @if($errors->get('refeent_secteur')) has-error @endif">
									<div class="row gutter">
										<div class="col-md-12">
											<label for="refeent_secteur" class="control-label">Référent secteur</label>
		
											<input id="refeent_secteur" type="text" required class="form-control" placeholder="Nom du porteur" name="refeent_secteur"  value="{{ $sectiontoedit->refeent_secteur }}">
										</div>
									</div>
								</div>
						<div class="form-group no-margin">
							<div class="row gutter">
								<div class="col-md-12">
									<button type="submit" class="btn btn-warning">Valider</button>
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
        text:'<div class="icon i_tick notifico">La section a été ajoutée avec succès</div>',
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
@if (isset($statcode) && $statcode==300)
<script>
    new Noty({
        text:'<div class="icon i_tick notifico">La section a été modifiée avec succès</div>',
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