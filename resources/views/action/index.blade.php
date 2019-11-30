@extends('layouts.master') 
@section('nameUser') 

@isset ($_SESSION['glpiname']) {{ $_SESSION['glpiname'] }} @endisset 

@endsection

@section('h4title') 

Liste des demandes à traiter

@endsection 

@section('conteOfObject')
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<ul class="right-stats" id="mini-nav-right">
		<li>
			<a href="javascript:void(0)" class="btn btn-danger">
				<span>{{ $nbrdedemandesatraiter }}</span>Demande(s) à traiter

			</a>
		</li>

	</ul>
</div>

@endsection 
@section('content')

<div class="main-container">
	<div class="row gutter">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h4>Liste des demandes</h4>
				</div>
				<div class="panel-body">
					<div class="table-responsive">
						<table accept-charset="UTF-8" id="scrollTabledemandes" class="display  table-striped no-margin"  style="width: 100%;">
							<thead>
								<tr>
									<th nowrap></th>
									<th hidden="true" nowrap></th>
									<th nowrap>REFERENCE DEMANDE</th>
									<th>REFERENT SECTEUR</th>
									<th >SECTION EMETTRICE</th>
									<th nowrap>STATUT DE LA DEMANDE</th>
									<th nowrap>DATE DE LIVRAISON PREVUE</th>
									<th nowrap>AVANCEMENT</th>
									<th nowrap>Action</th>
									<th hidden="true" nowrap>status</th>
									<th hidden="true" nowrap>commentaire</th>
								</tr>
							</thead>
							<tbody>

									@foreach ($listdemandes as $demande)

										<tr>
											<td>
											</td>
											<td hidden="true" nowrap>LES DEMANDES A TRAITER PAR LE REFERENT OUTILLAGE</td>
											<td nowrap>{{ $demande->ref_commande }}</td>
											<td nowrap>{{ $demande->section['refeent_secteur'] }}</td>
											<td nowrap>{{ $demande->section['num_section'] }}</td>
											<?php
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
											<td nowrap style="background-color: {{$colorstatusofdemande}}">{{ $demande->statusofdemande }}</td>
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
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$demande->partieetude['percenttotal']}}"
																aria-valuemin="0" aria-valuemax="100" style="width: {{$demande->partieetude['percenttotal']}}%">
																<span style="float:left">{{$demande->partieetude['percenttotal']}}% avancement BE</span>
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
													<a id="show-{{ $demande->id }}"  href="{{ url('action/show/'.$demande->id) }}" class="btn i_tick icon-edit visualiser icon small"
                                                                 style="padding-left: 9px;font-size: 25px;" title="ACTION"></a>
											</td>
											<td hidden='true' nowrap>{{ $demande->statusfdevalidation }}</td>
											<td hidden='true' nowrap>{{ $demande->commentvalidation }}</td>
										</tr>

									@endforeach
									@foreach ($listdemandesparcoordi as $demande)

										<tr>
											<td>
											</td>
											<td hidden="true" nowrap>LES DEMANDES A TRAITER PAR LE COORDINATEUR BE</td>
											<td nowrap>{{ $demande->ref_commande }}</td>
											<td nowrap>{{ $demande->section['refeent_secteur'] }}</td>
											<td nowrap>{{ $demande->section['num_section'] }}</td>
											<?php
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
											<td nowrap style="background-color: {{$colorstatusofdemande}}">{{ $demande->statusofdemande }}</td>
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
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$demande->partieetude['percenttotal']}}"
																aria-valuemin="0" aria-valuemax="100" style="width: {{$demande->partieetude['percenttotal']}}%">
																<span style="float:left">{{$demande->partieetude['percenttotal']}}% avancement BE</span>
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
													<a id="show-{{ $demande->id }}"  href="{{ url('action/showCoord/'.$demande->id) }}" class="btn i_tick icon-edit visualiser icon small"
                                                                 style="padding-left: 9px;font-size: 25px;" title="ACTION"></a>
											</td>
											<td hidden='true' nowrap>{{ $demande->statusfdevalidation }}</td>
											<td hidden='true' nowrap>{{ $demande->commentvalidation }}</td>
										</tr>

									@endforeach	
									@foreach ($listdemandesparprojteur as $demande)

										<tr>
											<td>
											</td>
											<td hidden="true" nowrap>LES DEMANDES A TRAITER PAR LE PROJETEUR</td>
											<td nowrap>{{ $demande->ref_commande }}</td>
											<td nowrap>{{ $demande->section['refeent_secteur'] }}</td>
											<td nowrap>{{ $demande->section['num_section'] }}</td>
											<?php
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
											<td nowrap style="background-color: {{$colorstatusofdemande}}">{{ $demande->statusofdemande }}</td>
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
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$demande->partieetude['percenttotal']}}"
																aria-valuemin="0" aria-valuemax="100" style="width: {{$demande->partieetude['percenttotal']}}%">
																<span style="float:left">{{$demande->partieetude['percenttotal']}}% avancement BE</span>
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
													<a id="show-{{ $demande->id }}"  href="{{ url('action/showProj/'.$demande->id) }}" class="btn i_tick icon-edit visualiser icon small"
                                                                 style="padding-left: 9px;font-size: 25px;" title="ACTION"></a>
											</td>
											<td hidden='true' nowrap>{{ $demande->statusfdevalidation }}</td>
											<td hidden='true' nowrap>{{ $demande->commentvalidation }}</td>
										</tr>

									@endforeach
									@foreach ($listdemandesparatelier as $demande)

										<tr>
											<td>
											</td>
											<td hidden="true" nowrap>LES DEMANDES A TRAITER PAR LA METHODE FAB</td>
											<td nowrap>{{ $demande->ref_commande }}</td>
											<td nowrap>{{ $demande->section['refeent_secteur'] }}</td>
											<td nowrap>{{ $demande->section['num_section'] }}</td>
											<?php
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
											<td nowrap style="background-color: {{$colorstatusofdemande}}">{{ $demande->statusofdemande }}</td>
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
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$demande->partieetude['percenttotal']}}"
																aria-valuemin="0" aria-valuemax="100" style="width: {{$demande->partieetude['percenttotal']}}%">
																<span style="float:left">{{$demande->partieetude['percenttotal']}}% avancement BE</span>
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
													<a id="show-{{ $demande->id }}"  href="{{ url('action/showAtelier/'.$demande->id) }}" class="btn i_tick icon-edit visualiser icon small"
                                                                 style="padding-left: 9px;font-size: 25px;" title="ACTION"></a>
											</td>
											<td hidden='true' nowrap>{{ $demande->statusfdevalidation }}</td>
											<td hidden='true' nowrap>{{ $demande->commentvalidation }}</td>
										</tr>

									@endforeach

									@foreach ($listdemandespardemandeur as $demande)

									<tr>
										<td>
										</td>
										<td hidden="true" nowrap>LES DEMANDES A TRAITER PAR LE DEMANDEUR</td>
										<td nowrap>{{ $demande->ref_commande }}</td>
										<td nowrap>{{ $demande->section['refeent_secteur'] }}</td>
										<td nowrap>{{ $demande->section['num_section'] }}</td>
										<?php
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
										<td nowrap style="background-color: {{$colorstatusofdemande}}">{{ $demande->statusofdemande }}</td>
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
															<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="{{$demande->partieetude['percenttotal']}}"
																aria-valuemin="0" aria-valuemax="100" style="width: {{$demande->partieetude['percenttotal']}}%">
																<span style="float:left">{{$demande->partieetude['percenttotal']}}% avancement BE</span>
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
												<a id="show-{{ $demande->id }}"  href="{{ url('action/showDemandeur/'.$demande->id) }}" class="btn i_tick icon-edit visualiser icon small"
															 style="padding-left: 9px;font-size: 25px;" title="ACTION"></a>
										</td>
										<td hidden='true' nowrap>{{ $demande->statusfdevalidation }}</td>
										<td hidden='true' nowrap>{{ $demande->commentvalidation }}</td>
									</tr>
									
									@endforeach

							</tbody>
						</table>
					</div>
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
<script src="{{ asset('js/costumerjsapi/actionlistdesdemandes.js') }}"></script>

@endsection