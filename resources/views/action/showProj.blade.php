@extends('layouts.master') 
@section('nameUser') 

@isset ($_SESSION['glpiname']) {{ $_SESSION['glpiname'] }} @endisset 

@endsection

@section('h4title') 
Validation de la demande d'outillage
@endsection 

@section('conteOfObject')

@endsection 
@section('content')

<div class="main-container">
		<div class="row bs-wizard" style="border-bottom:0;">
				@if ($demande->etap=="DEMANDEUR")
							@if($demande->statusfdevalidation=="Rejetée")
									<div class="col-xs-2 bs-wizard-step complete">
											<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
									</div>
									<div class="col-xs-2 bs-wizard-step complete">
									
										<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
										<div class="bs-wizard-info text-center">La demande est rejetée par le référent outillage</div>
									</div>
							@else
									<div class="col-xs-2 bs-wizard-step complete">
											<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
									</div>
									<div class="col-xs-2 bs-wizard-step disabled">
											
											<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center"></div>
									</div>
							@endif

				
				<div class="col-xs-2 bs-wizard-step disabled"><!-- complete -->
					<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
					<div class="progress"><div class="progress-bar"></div></div>
					<a href="#" class="bs-wizard-dot"></a>
					<div class="bs-wizard-info text-center"></div>
				  </div>
				  
				  <div class="col-xs-2 bs-wizard-step disabled"><!-- complete -->
					<div class="text-center bs-wizard-stepnum">PROJETEUR</div>
					<div class="progress"><div class="progress-bar"></div></div>
					<a href="#" class="bs-wizard-dot"></a>
					<div class="bs-wizard-info text-center"></div>
				  </div>
				  
				  <div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
					<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
					<div class="progress"><div class="progress-bar"></div></div>
					<a href="#" class="bs-wizard-dot"></a>
					<div class="bs-wizard-info text-center"></div>
				  </div>
				  <div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
					  <div class="text-center bs-wizard-stepnum">LIVRAISON</div>
					  <div class="progress"><div class="progress-bar"></div></div>
					  <a href="#" class="bs-wizard-dot"></a>
					  <div class="bs-wizard-info text-center"></div>
					</div>
				</div>
			  @elseif($demande->etap=="REFERENT OUTILLAGE")
						@if($demande->statusfdevalidation=="Rejetée")
									<div class="col-xs-2 bs-wizard-step complete">
											<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot">La demande est validée par le demandeur</a>
											<div class="bs-wizard-info text-center"></div>
									</div>
									<div class="col-xs-2 bs-wizard-step complete">
									
										<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
										<div class="bs-wizard-info text-center">La demande est rejetée par le référent outillage</div>
									</div>
							@elseif($demande->statusfdevalidation=="En attente")
									<div class="col-xs-2 bs-wizard-step complete">
											<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
									</div>
									<div class="col-xs-2 bs-wizard-step disabled">
											
											<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center"></div>
									</div>
						
							@endif
							<div class="col-xs-2 bs-wizard-step disabled"><!-- complete -->
							<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
							<div class="progress"><div class="progress-bar"></div></div>
							<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center"></div>
							</div>
							
							<div class="col-xs-2 bs-wizard-step disabled"><!-- complete -->
							<div class="text-center bs-wizard-stepnum">PROJETEUR</div>
							<div class="progress"><div class="progress-bar"></div></div>
							<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center"></div>
							</div>
							
							<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
							<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
							<div class="progress"><div class="progress-bar"></div></div>
							<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center"></div>
							</div>
							<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
								<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
								<div class="progress"><div class="progress-bar"></div></div>
							  		<a href="#" class="bs-wizard-dot"></a>
								<div class="bs-wizard-info text-center"></div>
							</div>
							</div>

			  @elseif($demande->etap=="COORDINATEUR BE")
								<div class="col-xs-2 bs-wizard-step complete">
										<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
										<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
								</div>
								<div class="col-xs-2 bs-wizard-step complete">
								
										<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
										<div class="bs-wizard-info text-center">La demande est approuvée par le référent outillage</div>
								</div>
								<div class="col-xs-2 bs-wizard-step complete">
								
										<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot" style="background:blue"></a>
										<div class="bs-wizard-info text-center" >La demande est en STAND-BY</div>
									</div>						
						<div class="col-xs-2 bs-wizard-step disabled"><!-- complete -->
						<div class="text-center bs-wizard-stepnum">PROJETEUR</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="bs-wizard-dot"></a>
						<div class="bs-wizard-info text-center"></div>
						</div>
						
						<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
						<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="bs-wizard-dot"></a>
						<div class="bs-wizard-info text-center"></div>
						</div>
						<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
							<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
							<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center"></div>
						</div>
						</div>

			  @elseif($demande->etap=="PROJETEUR")
							<div class="col-xs-2 bs-wizard-step complete">
									<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
							</div>
							<div class="col-xs-2 bs-wizard-step complete">
							
									<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est approuvée par le référent outillage</div>
							</div>
							<div class="col-xs-2 bs-wizard-step complete">
							
									<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est approuvée par le coordinateur BE</div>
							</div>
							<div class="col-xs-2 bs-wizard-step active "><!-- complete -->
								<div class="text-center bs-wizard-stepnum">PROJETEUR</div>
								<div class="progress"><div class="progress-bar"></div></div>
								<a  href="#" type="button"  class="bs-wizard-dot text-center" data-container="body"
                                    data-toggle="popover" data-html="true" data-placement="top" data-content=' <div class="btn-group center-text">
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="BE PAS COMMENCE" class="btn btn-danger" onclick="setstattoBEPASCOMMENCE(this)">
												<i class="icon-controller-play"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="BE EN COURS" class="btn btn-warning" onclick="setstattoENCOURS(this)">
												<i class="icon-time-slot"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="BE STAND-BY" class="btn btn-info" onclick="setstattoSTANDBY(this)">
												<i class="icon-back-in-time"></i>
											</a>
										</div>'></a>
								
								<div class="bs-wizard-info text-center projecteurstatdiv" >{{ $demande->statusofdemande }}</div>
								</div>
								
								<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
								<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
								<div class="progress"><div class="progress-bar"></div></div>
								<a href="#" class="bs-wizard-dot"></a>
								<div class="bs-wizard-info text-center"></div>
								</div>
								<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
									<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
									<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center"></div>
								</div>
								</div>
			@elseif($demande->etap=="METHODE FAB")
							<div class="col-xs-2 bs-wizard-step complete">
									<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
							</div>
							<div class="col-xs-2 bs-wizard-step complete">
							
									<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est approuvée par le référent outillage</div>
							</div>
							<div class="col-xs-2 bs-wizard-step complete">
							
									<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est approuvée par le coordinateur BE</div>
							</div>
							<div class="col-xs-2 bs-wizard-step complete">
							
									<div class="text-center bs-wizard-stepnum">PROJETEUR</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est validée par le projeteur</div>
							</div>
								
								<div class="col-xs-2 bs-wizard-step active"><!-- active -->
								<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
								<div class="progress"><div class="progress-bar"></div></div>
								<a href="#" class="bs-wizard-dot"></a>
								<div class="bs-wizard-info text-center">En cours Fab</div>
								</div>
								<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
									<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
									<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center"></div>
								</div>
								</div>
					
			  @endif
		

	<div class="row gutter" style="margin-left:  20%;">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
	

			<div class="panel">
				<div class="panel-heading">
					<h4>LA DEMANDE : <p align='center'>Réference  de la commande: {{$demande->ref_commande}}</p> <h4>
				</div>
				<div class="panel-body">
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

						switch ($demande->periodicite){
							case ("1"):
                                        $periodicite = "N/A";
								break;
							case ("2"):
                                        $periodicite = "12";
								break;
							case ("3"):
                                        $periodicite = "36";
								break;
							case ("4"):
                                        $periodicite = "60";
								break;
							case ("5"):
                                        $periodicite = "120";
								break;
							case ("6"):
										$periodicite = " à vie de l'outil";
						break;

							default:
                                        $periodicite = "N/A";
						}
						switch ($demande->gain_attendu) {
							case 1:
								$gainattendu = "En  € à l'année";
								break;
							case 2:
								$gainattendu = "En ergonomie";
								break;
							case 3:
								$gainattendu = "En sécurité";
								break;
							case 4:
								$gainattendu = "Réparation";
								break;
							case 5:
								$gainattendu = "Maîtrise des procédés";
								break;

							default:
								$gainattendu = "";
						}
					?>
						<div class="form-group">
							<div class="row gutter">
								<div class="col-md-6 selectContainer">
									<label class="control-label">TYPE D'INTERVENTION :</label>
									<p   class="form-control" >{{ $typeintervention }}</p>                                               
								</div>
							</div>

							<div class="row gutter">
								<div class="col-md-4 selectContainer">
									<label class="control-label">PORTEUR:</label>
									 <p   class="form-control" >{{ $demande->porteur["nameofporteur"] }}</p>
								</div>
								<div class="col-md-4">
									<label class="control-label">N° CAPEX:</label>
									 <p   class="form-control" >{{ $demande->num_CAPEX }}</p>   
								   
								</div>
								<div class="col-md-4">
									<label class="control-label">CODE PROJET :</label>
									<p   class="form-control" >{{ $demande->code_project }}</p>   
								</div>
								<div class="col-md-4">
									<label class="control-label">REF P/N IMPACTE:</label>
								   <p   class="form-control" >{{ $demande->ref_pn_impacte }}</p>  
								</div>
								<div class="col-md-4">
									<label class="control-label">IND: </label>
									<p   class="form-control" >{{ $demande->pn }}</p>  
								</div>
								</div>
								<div class="row gutter">
								<div class="col-md-6">
									<label  class="control-label">REF OUTILLAGE <span class="etoilerequredref"></span>:</label>
									<p   class="form-control" >{{ $demande->ref_outillage }}</p>  
								</div>																														
							</div>
							<div class="row gutter">
								<div class="col-md-4 selectContainer">
									<label class="control-label">SECTION EMETTRICE :</label>
									<p   class="form-control" >{{ $demande->section["num_section"] }}</p>  
								</div>
								<div class="col-md-4 selectContainer" >
									<label class="control-label"> NOM DE LA SECTION : </label>
									<p   class="form-control" >{{ $demande->section["nameofsection"] }}</p>  

								</div>
								<div class="col-md-4 selectContainer">
									<label class="control-label"> REFERENT SECTEUR:</label>
									<p   class="form-control" >{{ $demande->section["refeent_secteur"] }}</p>  
								</div>
							</div>
							<div class="row gutter">
								<div class="col-md-4 selectContainer">
									<label class="control-label">SUIVI PAR:</label>
									<p type="text"  class="form-control" name="alivrera" >
											{{ $demande->user["firstname"] }}.{{ $demande->user["realname"] }} </p>
								</div>
							</div>
							<div class="row gutter">															
								<div class="col-md-6 selectContainer">
									<label class="control-label">DEGRE DE PRIORITE :</label>
									 <p   class="form-control" >{{ $degrepriorite }}
									 </p>
								</div>
							</div>

							<div class="row gutter">
								<div class="col-md-6">
									<label class="control-label">DELAI SOUHAITE : </label>
									<p   class="form-control" >
											{{ date_format(new DateTime($demande->date_souhaite),'d-m-Y') }}
									</p>
								</div>
								<div class="col-md-6">
									<label class="control-label">DATE PREVUE PROCHAIN OF(besoin outillage): </label>
								   <p   class="form-control" >
										{{ date_format(new DateTime($demande->date_prev_OF),'d-m-Y') }}
									</p>
								</div>

							</div>
							<div class="row gutter">
								<div class="col-md-4">
									<label class="control-label">QUANTITE D'OUTILLAGE DEMANDEE : </label>
									 <p   class="form-control" >
										{{ $demande->quantite }}
									</p>
								</div>
							</div>
							<div class="row gutter">
								<div class="col-md-12">
									<label class="control-label">DESCRIPTION DU BESOIN : </label>
									  <div   class="form-control" style="height:auto !important">{!!html_entity_decode($demande->fonctions_outillage) !!}
									</div>
								</div>
							</div>

							<div class="row gutter">
								<div class="col-md-12">
									<label class="control-label">PIECES JOINTES : </label>
									<div>
										@foreach($filesofdemande as $file)
										<?php
											$type = explode(".",$file->name_File)[count(explode("\.",$file->name_File))]
										?>
										<div class="col-sm-2 text-center">
										
										<a href="../../{{$file->path_File}}/{{$file->name_File}}" download="{{$file->name_File }}">
										<i class="fa fa-file-{{$icons[$type]}}-o fa-2x text-center"/>
										</i></a>
										
										<div class="clearfix"></div>
									    <a href="../../{{$file->path_File}}/{{$file->name_File}}" download="{{$file->name_File }}">{{ $file->name_File }}</a> 
										</div>
										@endforeach
									</div>
								</div>
							</div>

							<div class="row gutter">
								<div class="col-md-6 selectContainer">
									<label class="control-label">GAIN ATTENDU:</label>
									<p   class="form-control" >
										{{ $gainattendu }}
									</p>
								</div>
								<?php
									if($demande->gain_attendu==1){
										$stl="initial";
									}
									else{
										$stl="none";
									}
									?>
								<div class="col-md-6" id="montantdiv" style="display:{{$stl}}">
									<label class="control-label">MONTANT (EN €): </label>
									<p   class="form-control" >{{ $demande->gain_attendu_value }}
									</p>
								</div>

							</div>
							<div class="row gutter">
								<div class="col-md-12 ">
									<label class="control-label">COMMENTAIRES : </label>
									 <div   class="form-control" style="height:auto !important">{!!html_entity_decode($demande->comments) !!}
									</div>
								</div>
							</div>
						</div>
					</div>

			</div>
		</div>
	</div>
	<div class="row gutter" style="margin-left:  20%;">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="panel">
				<div class="panel-heading" style="background:green;">
				
				
					<h4> PARTIE ETUDE <h4>

				</div>
				<div class="panel-body" style="background: #EBF1DE;">

						<form accept-charset="utf-8" id="form" name="form" method="post" action="{{ url('action/actionProj/'.$demande->id) }}">
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
								{{ csrf_field() }}
						@if($demande->etap!="PROJETEUR")
						<fieldset disabled="disabled">
						@endif
						
						<div class="form-group" >
					
								<div class="row gutter">
									<div class="col-md-6">
										<label class="control-label">DATE DEBUT D'ÉTUDE *: </label>
										<input  id="datededutetude" name="datededutetude"  type="date" min="{{ date('Y-m-d', strtotime(date("Y-m-d").'+ 0 DAY')) }}" required class="form-control" placeholder="Enter Date" value={{ $demande->partieetude['datededutetude']}} name="datededutetude" >
									</div>
									<div class="col-md-6">
										<label class="control-label">DELAIS ESTIMÉ FIN D'ÉTUDE </label>
										<input id="delaisfinetude" name="delaisfinetude" type="date"  min="{{ date('Y-m-d', strtotime(date("Y-m-d").' + 0 DAY')) }}" class="form-control" placeholder="Enter Date" value={{ $demande->partieetude['delaisfinetude']}} name="delaisfinetude" >
									</div>

								</div>
								<div class="row gutter">
									<div class="col-md-4">
										<label class="control-label">PROJETEUR: </label>
										<p type="text"  class="form-control gridp" >{{ $demande->projteur->nameofprojeteur }}</p>
									</div>
								</div>
					
								<div class="row gutter" style="margin-top: 15px;">
										<div class="col-md-12">
												<div class="row gutter">
												<div class="col-md-6 col-md-offset-3">
														<p type="text"  class="form-control gridp text-center" style="text-align: -webkit-center;" >TEMPS D'ÉTUDES(en heure)</p>
												</div>
											
											</div>
											</div>
										<div class="col-md-12" style="margin-top: 10px;">
												<div class="row gutter">
												<div class="col-md-3 col-md-offset-3">
														<p type="text"  class="form-control gridp text-center" style="text-align: -webkit-center;"  >ESTIMATION</p>
												</div>
												<div class="col-md-3">
														<p type="text"  class="form-control gridp text-center" style="text-align: -webkit-center;" >REEL</p>
												</div>
											</div>
									</div>
									<div class="col-md-12" style="margin-top: 10px;">
										<div class="row gutter">
										<div class="col-md-3">
											<label class="control-label">ETUDE 3D </label>
										</div>
										<div class="col-md-3">
											<input type="number"  min="0" value="{{ $demande->partieetude['estimationetude3D']}}"  class="form-control montant" id="estimationetude3D" name="estimationetude3D" onchange="calculestimtotal()" readonly >
										</div>
										<div class="col-md-3">
											<input type="number"  min="0" value="{{ $demande->partieetude['reeletude3D']}}"   class="form-control montant" id="reeletude3D" name="reeletude3D" onchange="calculreeltotal()">
										</div>
										<div class="col-md-3">
													<input type="text"  value="{{ $demande->partieetude['percentetude3D']}}%" readonly  class="form-control"  id="percentetude3D" name="percentetude3D">
												</div>
									</div>
									</div>
									<div class="col-md-12">
											
											<div class="row gutter">
											<div class="col-md-3">
											<label class="control-label">LIASSE 2D </label>
											</div>
												<div class="col-md-3">
													<input type="number"  min="0" value="{{ $demande->partieetude['estimationlaisse2D']}}"    class="form-control montant"  id="estimationlaisse2D" name="estimationlaisse2D" onchange="calculestimtotal()"  readonly >
												</div>
												<div class="col-md-3">
													<input type="number"  min="0" value="{{ $demande->partieetude['reellaisse2D']}}"   class="form-control montant" id="reellaisse2D" name="reellaisse2D" onchange="calculreeltotal()">
												</div>
												<div class="col-md-3">
														<input type="text" value="{{ $demande->partieetude['percentlaisse2D']}}%"   class="form-control montant"  name="percentlaisse2D" id="percentlaisse2D" readonly >
													</div>
											</div>
									</div>
									<div class="col-md-12">
												
												<div class="row gutter">
												<div class="col-md-3">
												<label class="control-label">VERIFICATION 2D </label>
										</div>
													<div class="col-md-3">
														<input type="number"  min="0" value="{{ $demande->partieetude['estimationverification2D']}}"  class="form-control montant"  id="estimationverification2D" name="estimationverification2D" onchange="calculestimtotal()" readonly >
													</div>
													<div class="col-md-3">
														<input type="number"  min="0" value="{{ $demande->partieetude['reelverification2D']}}"  class="form-control montant"  id="reelverification2D" name="reelverification2D" onchange="calculreeltotal()">
													</div>
													<div class="col-md-3">
															<input type="text" value="{{ $demande->partieetude['percentverification2D']}}%"  class="form-control montant"  id="percentverification2D" name="percentverification2D"  readonly >
														</div>
												</div>
									</div>
									<div class="col-md-12">
											
											<div class="row gutter">
											<div class="col-md-3">
											<label class="control-label">TOTAL </label>
											</div>
												<div class="col-md-3">
													<input type="number"  min="0" value="{{ $demande->partieetude['estimationtotal']}}"   class="form-control" id="estimationtotal" name="estimationtotal" readonly >
												</div>
												<div class="col-md-3">
													<input type="number"  min="0" value="{{ $demande->partieetude['reeltotal']}}"   class="form-control"  id="reeltotal" name="reeltotal" readonly >
												</div>
												<div class="col-md-3">
															<input type="text" value="{{ $demande->partieetude['percenttotal']}}%" class="form-control"  name="percenttotal" id="percenttotal"  readonly>
												</div>
									
											</div>
								</div>
								</div>	
								<div class="row gutter">
										<div class="col-md-6">
											<label class="control-label">DATE FIN D'ETUDE </label>
											<input id="datefinetude" type="date"  min="{{ date('Y-m-d', strtotime(date("Y-m-d").' + 0 DAY')) }}" readonly value= {{ $demande->partieetude['datefinetude']}} class="form-control" placeholder="Enter Date" name="datefinetude">
										</div>
	
									</div>		
							</div>


						@if ($demande->etap=="PROJETEUR")
										<div class="row gutter" style="margin-bottom: 10px !important;">
											<div class="col-md-4">
												<button type="submit" class="btn btn-warning">Enregistrer</button>
												<button type="reset" class="btn btn-warning">Annuler</button>
											</div>
										</div>
								@endif
							@if($demande->etap!="PROJETEUR")
							</fieldset>
							@endif
						
						</form>
						@if ($demande->etap=="PROJETEUR")
										<div class="row gutter">
											<div class="col-md-8 selectContainer">
											<div class="col-md-12" style="padding-left: 0px !important;">
												<label class="control-label ">RESPONSABLE METHODE FAB: </label>
											</div>
											@if ($demande->etap=="PROJETEUR")
											<div class="col-md-8" style="padding-left: 0px !important;">
												<select class="form-control" name="atelier" id="atelier">
														<option   value="" disabled selected hidden>Selectionner un responsable METHODE FAB</option>
														@foreach ($listdesateliers as $atelier )
														
														<option value='{{ $atelier->id }}'>{{ $atelier->nameofatelier }}</option>"
														
														@endforeach
			
													</select>
												</div>
												<div class="col-md-4">
														<button  id="{{ $demande->id }}" title="Assigner" class="btn btn-succes" onclick="assigneatelier(this)" style="background-color:green">Assigner</button>
												</div>
											
												@else
													
												<p type="text"  class="form-control gridp" style="text-align: -webkit-center;" >{{ $resAtelier }}</p>

												@endif	
											</div>						
										</div>
								@endif
				</div>
			</div>
		</div>
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="panel">
					<div class="panel-heading" style="background:#fabf8f;">
					
					
						<h4> BILAN <h4>
	
					</div>
					<div class="panel-body" style="background: #fcd5b4;">
	
									<div class="form-group" >

										<div class="row gutter" style="margin-bottom: 10px !important;">															
											<div class="col-md-6">
												<label class="control-label">PÉRIODICITÉ :</label>
												<p class="form-control">{{$periodicite}}</p>
											</div>
										</div>
									</div>
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
<link rel="stylesheet" href="{{ asset('css/font-fileuploader.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fileuploader.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/summernote/dist/summernote.css') }}">
<link href="{{ asset('fonts/icomoon/icomoon.css') }}" rel="stylesheet">
<link href="{{ asset('fonts/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('css/wysiwyg-editor/editor.css') }}" rel="stylesheet">
<style>
	.bs-wizard {margin-top: 40px;}

/*Form Wizard*/
.bs-wizard {border-bottom: solid 1px #e0e0e0; padding: 0 0 10px 0;}
.bs-wizard > .bs-wizard-step {padding: 0; position: relative;}
.bs-wizard > .bs-wizard-step + .bs-wizard-step {}
.bs-wizard > .bs-wizard-step .bs-wizard-stepnum {color: #595959; font-size: 16px; margin-bottom: 5px;}
.bs-wizard > .bs-wizard-step .bs-wizard-info {color: #999; font-size: 14px;}
.bs-wizard > .bs-wizard-step > .bs-wizard-dot {position: absolute; width: 30px; height: 30px; display: block; background: #fbe8aa; top: 45px; left: 50%; margin-top: -15px; margin-left: -15px; border-radius: 50%;} 
.bs-wizard > .bs-wizard-step > .bs-wizard-dot:after {content: ' '; width: 14px; height: 14px; background: #fbbd19; border-radius: 50px; position: absolute; top: 8px; left: 8px; } 
.bs-wizard > .bs-wizard-step > .progress {position: relative; border-radius: 0px; height: 8px; box-shadow: none; margin: 20px 0;}
.bs-wizard > .bs-wizard-step > .progress > .progress-bar {width:0px; box-shadow: none; background: #fbe8aa;}
.bs-wizard > .bs-wizard-step.complete > .progress > .progress-bar {width:100%;}
.bs-wizard > .bs-wizard-step.active > .progress > .progress-bar {width:50%;}
.bs-wizard > .bs-wizard-step:first-child.active > .progress > .progress-bar {width:0%;}
.bs-wizard > .bs-wizard-step:last-child.active > .progress > .progress-bar {width: 100%;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot {background-color: #f5f5f5;}
.bs-wizard > .bs-wizard-step.disabled > .bs-wizard-dot:after {opacity: 0;}
.bs-wizard > .bs-wizard-step:first-child  > .progress {left: 50%; width: 50%;}
.bs-wizard > .bs-wizard-step:last-child  > .progress {width: 50%;}
.bs-wizard > .bs-wizard-step.disabled a.bs-wizard-dot{ pointer-events: none; }
/*END Form Wizard*/
</style>

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
<script src="{{ asset('js/wysiwyg-editor/editor.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>
<script src="{{ asset('js/jquery.fileuploader.min.js') }}"></script>
<script src="{{ asset('js/summernote/dist/summernote.js') }}"></script>
<script src="{{ asset('js/summernote/dist/lang/summernote-fr-FR.js') }}"></script>

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
<script src="{{ asset('js/costumerjsapi/showProjdemande.js') }}"></script>
@endsection