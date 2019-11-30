@extends('layouts.master') 
@section('nameUser') 

@isset ($_SESSION['glpiname']) {{ $_SESSION['glpiname'] }} @endisset 

@endsection

@section('h4title') 

Les Demandes d'outillages

@endsection 

@section('conteOfObject')
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<ul class="right-stats" id="mini-nav-right">
		<li>
			<a href="javascript:void(0)" class="btn btn-danger">
				<span>{{ $sizelist }}</span>Demande(s)

			</a>
		</li>
	</ul>
</div>

@endsection 
@section('content')

<div class="main-container" >
	<div class="row gutter">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h4>Liste des demandes</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table accept-charset="UTF-8" id="scrollTabledemandes" class="display table table-striped table-bordered no-margin" width="100%"  style="width: 100%;">
							<thead>
								<tr>
									<th nowrap></th>
									<th nowrap>REFERENCE </br> DEMANDE </th>
									<th nowrap>TYPE  </br> D'INTERVENTION</th>
									<th nowrap>REFERENT </br></th>
									<th nowrap>SECTION </br></th>
									<th nowrap>PORTEUR </br></th>
									<th nowrap>REFERENCE </br> PRODUIT</th>
									<th>DESCRIPTION </br> DU BESOIN</th>								
									<th nowrap>DATE </br> CREATION</th>
									<th nowrap>STATUT DE </br> LA DEMANDE</th>
									<th nowrap>WORKFLOW </br></th>
									<th nowrap>DATE DE </br> LIVRAISON  PREVUE</th>
									<th nowrap>AVANCEMENT</th>
									<th nowrap>ACTION</th>
									<th hidden="true" nowrap>status</th>
									<th hidden="true" nowrap>commentaire</th>
									<th hidden="true" nowrap>DATE CREATION CACHEE</th>
								</tr>
							</thead>
							<tbody>

									@foreach ($listdemandes as $demande)

										<?php
											switch ($demande->type_intervention){
												case ("C"):
															$typeintervention = "CREATION";
													break;
												case ("D"):
															$typeintervention = "DUPLICATION";
													break;
												case ("M"):
												$typeintervention = "MODIFICATION";
													break;
												case ("R"):
													$typeintervention = "REPARATION (direct Atelier)";
													break;

												default:
													$typeintervention = "CREATION";
											}
											switch ($demande->degre_priorite) {
												case ("1"):
													$degrepriorite = "LIVRAISON CLIENT BLOQUEE";
													break;
												case ("2"):
													$degrepriorite = "MAJEURE";
													break;
												case ("3"):
													$degrepriorite = "MINEURE";
													break;
												case ("4"):
													$degrepriorite = "EN DEVELOPPEMENT";
													break;
												default:
													$degrepriorite = "";
											}

											switch ($demande->statusofdemande){
												case ("Annulé"):
															$colorstatusofdemande = "#D9D9D9";
													break;
												case ("BE En cours"):
															$colorstatusofdemande = "#D8E4BC";
													break;
												case ("BE Pas commencé"):
												$colorstatusofdemande = "#E6B8B7";
													break;
												case ("BE Stand-By"):
													$colorstatusofdemande = "#CCC0DA";
													break;
												case ("En cours Fab"):
													$colorstatusofdemande = "#8DB4E2";
													break;
												case ("Livré Client"):
													$colorstatusofdemande = "#FABF8F";
													break;
												case ("Fab Stand-By"):
													$colorstatusofdemande = "#FFFFFF";
													break;

												default:
													$colorstatusofdemande = "#FFFFFF";
											}
										?>

										<tr>
											<td>
											</td>
											<td nowrap>{{ $demande->ref_commande }}</td>
											<td nowrap>{{ $typeintervention }}</td>
											<td nowrap>{{ $demande->section['refeent_secteur'] }}</td>
											<td nowrap>{{ $demande->section['num_section'] }}</td>
											<td nowrap >{{ $demande->porteur['nameofporteur'] }}</td>
											<td nowrap>{{ $demande->ref_pn_impacte }}</td>
											<td style="max-width:20px;word-wrap: break-word">{!! html_entity_decode($demande->fonctions_outillage) !!}</td>
											<td nowrap>{{ date_format(new DateTime($demande->datecreation),'d-m-Y') }}</td>
											<td nowrap style="background-color: {{$colorstatusofdemande}};max-width:30px;word-wrap: break-word">
												@if($demande->statusofdemande==="")
												 --
												@else
												{{ $demande->statusofdemande }}
												@endif
											</td>
											<td nowrap>{{ $demande->etap }}</td>
											<td nowrap>{{ date_format(new DateTime($demande->date_prev_OF),'d-m-Y') }}</td>
											<td nowrap> 
												<div class="row gutter">
												<?php
														if($demande->partieetude['estimationtotal'] != 0){
															$pourcentage = round($demande->partieetude['reeltotal']*100/$demande->partieetude['estimationtotal']);
														}
														else $pourcentage = 0;
														?>
													<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
														<div class="progress">
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{ $demande->partieetude['percenttotal'] }}"
																aria-valuemin="0" aria-valuemax="100" style="width: {{ $demande->partieetude['percenttotal'] }}%">
																<span style="float:left">{{ $demande->partieetude['percenttotal'] }}% avancement BE</span>
														</div>
													</div>
												</div>
												</div>
												<div class="row gutter">
														<?php
														if($demande->partiefab['estimationfab'] != 0){
															$pourcentage = round($demande->partiefab['reelfab']*100/$demande->partiefab['estimationfab']);
														}
														else $pourcentage = 0;
														?>
														<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
															<div class="progress no-margin">
																<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="{{$demande->partiefab['percenttotal']}}"
																	aria-valuemin="0" aria-valuemax="100" style="width: {{$demande->partiefab['percenttotal']}}%">
																	<span style="float:left">{{$demande->partiefab['percenttotal']}}% avancement FAB</span>
															</div>
														</div>
													</div>
												</div>
												
											</td>
											
											<td align='center' id='amender-{{ $demande->id }}' nowrap>
													<a id="show-{{ $demande->id }}"  href="{{ url('demande/show/'.$demande->id) }}" class="btn icon-eye3 visualiser icon small"
                                                                 style="padding-left: 9px;font-size: 25px;" title="VISUALISER"></a>
											</td>
											<td hidden='true' nowrap>{{ $demande->statusfdevalidation }}</td>
											<td hidden='true' nowrap>{{ $demande->commentvalidation }}</td>
											<td hidden='true' nowrap>{{ $demande->updated_at }}</td>
											<td hidden="true"nowrap>{{ date_format(new DateTime($demande->datecreation),'Y-m-d') }}</td>
										</tr>

									@endforeach
																			 								 
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="modalForm">APPROUVER LA DEMANDE</h4>
					</div>
					<div class="modal-body">
						<form>
					   
							<div class="form-group"><label for="message-text" class="control-label">Commentaire de l'approbation:</label><textarea class="form-control messagapprove" id="message-text"></textarea></div>
						</form>
					</div>
					<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> <button type="button" data-dismiss="modal" onClick="onclickapprouver(this)" class="btn btn-info btnapprove">Approuver</button></div>
				</div>
			</div>
		</div>
	 
		<div class="modal fade" id="modalForm2" tabindex="-1" role="dialog" aria-labelledby="modalForm2">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="modalForm2">REJETER LA DEMANDE</h4>
					</div>
					<div class="modal-body">
						<form>
							<div class="form-group"><label for="message-text" class="control-label">Commentaire du rejet:</label><textarea class="form-control messagerejet" id="message-text"></textarea></div>
						</form>
					</div>
					<div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> <button type="button" data-dismiss="modal" onClick="onclickrejecter(this)" class="btn btn-info btnrejet">Rejeter</button></div>
				</div>
			</div>
		</div>
	</div>
</div>

@endsection 
@section('style')
<link rel="stylesheet" href="{{ asset('css/datatables/jquery.dataTables.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/dataTables.bs.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/autoFill.bs.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/datatables/fixedHeader.bs.css') }}"> 

<style>
	.table>tbody>tr>td, 
	.table>tbody>tr>th, 
	.table>tfoot>tr>td,
	.table>tfoot>tr>th, 
	.table>thead>tr>td, 
	.table>thead>tr>th 
	 {
    vertical-align: middle !important;
}

tr.group,
tr.group:hover {
    background-color: #b8c9ff  !important;
}
tr.group>td{
    background-color: #b8c9ff  !important;
}
	th {
		white-space: nowrap;
	}
</style>
@endsection
 @section('scripts')
<script src="{{ asset('js/sparkline/sparkline.js') }}"></script>
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
        text:'<div class="icon i_tick notifico">La demande a été ajoutée avec succès</div>',
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
        text:'<div class="icon i_tick notifico">La demande a été modifiée avec succès</div>',
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
<script src="{{ asset('js/costumerjsapi/listdesdemandes.js') }}"></script>

@endsection