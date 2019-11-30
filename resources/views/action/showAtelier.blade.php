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
							@if($demande->statusfdevalidation=="rejetée")
									<div class="col-xs-2 bs-wizard-step complete">
											<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot" style="background:red"></a>
											<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
									</div>
									<div class="col-xs-2 bs-wizard-step complete">
									
										<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot" style="background:red"></a>
										<div class="bs-wizard-info text-center" style="color:red">La demande est rejetée par le référent outillage</div>
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
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
									</div>
									<div class="col-xs-2 bs-wizard-step active">
									
										<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
										<div class="bs-wizard-info text-center">En attente</div>
									</div>
									<div class="col-xs-2 bs-wizard-step disabled">
									<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center">La demande est rejetée par le Coordinateur BE</div>
									</div>
							@elseif($demande->statusfdevalidation=="En attente")
									<div class="col-xs-2 bs-wizard-step complete">
											<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
									</div>
									<div class="col-xs-2 bs-wizard-step active">
											
											<div class="text-center bs-wizard-stepnum">REFERENT OUTILLAGE</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center">En attente</div>
									</div>

									<div class="col-xs-2 bs-wizard-step disabled"><!-- complete -->
									<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
									<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
									<div class="bs-wizard-info text-center"></div>
									</div>
						
							@endif
							
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
								<div class="col-xs-2 bs-wizard-step active "><!-- complete -->
								<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
								<div class="progress"><div class="progress-bar"></div></div>
								<a  href="#" type="button"  class="bs-wizard-dot text-center" data-container="body"
                                    data-toggle="popover" data-html="true" data-placement="top" data-content=' <div class="btn-group center-text">
									<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="_" class="btn btn-success" onclick="setstattoWithout(this)">
												<i class="icon-minus3"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="BE STAND-BY" class="btn btn-info" onclick="setstattoSTANDBY(this)">
												<i class="icon-back-in-time"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="Annulé" class="btn btn-danger" onclick="setstattoANNULE(this)">
												<i class="icon-cancel2"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="Affecter au référent outillage" class="btn btn-warning" onclick="affecteraureferent(this)">
												<i class="icon-arrow-long-left"></i>
											</a>
											
										</div>'></a>
								
								<div class="bs-wizard-info text-center projecteurstatdiv" >{{ $demande->statusofdemande }}</div>
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
									<div class="col-xs-2 bs-wizard-step active "><!-- complete -->
								<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
								<div class="progress"><div class="progress-bar"></div></div>
								<a  href="#" type="button"  class="bs-wizard-dot text-center" data-container="body"
                                    data-toggle="popover" data-html="true" data-placement="top" data-content=' <div class="btn-group center-text">
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="En cours Fab" class="btn btn-success" onclick="setstattoENCOURSFAB(this)">
												<i class="icon-time-slot"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="Fab Stand-By" class="btn btn-info" onclick="setstattoSTANDBYFAB(this)">
												<i class="icon-back-in-time"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="Affecter au coordinateur BE" class="btn btn-warning" onclick="affecteraucoordbymethodefab(this)">
												<i class="icon-arrow-long-left"></i>
											</a>
											<a id="{{ $demande->id }}" data-placement="top" data-toggle="tooltip"
													data-original-title="Affecter au référent outillage" class="btn btn-danger" onclick="affecteraureferentbymethodefab(this)">
												<i class="icon-reply-all"></i>
											</a>
										</div>'></a>
								
								<div class="bs-wizard-info text-center projecteurstatdiv" >{{ $demande->statusofdemande }}</div>
								</div>			
						<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
							<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
							<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center"></div>
						</div>
						</div>
						@elseif($demande->etap=="LIVRAISON")
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

									<div class="col-xs-2 bs-wizard-step complete"><!-- active -->
							<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
							<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">La demande est validée par la methode fab</div>
						</div>		
						<div class="col-xs-2 bs-wizard-step active"><!-- active -->
							<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
							<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">En attente</div>
						</div>
						</div>
					
			  @endif
		

	<div class="row gutter" style="margin-left:  20%;">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h4>LA DEMANDE : <p align='center'>Réference  de la commande:{{$demande->ref_commande}}</p> <h4>
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
						$periodicite1="";
						$periodicite2="";
						$periodicite3="";
						$periodicite4="";
						$periodicite5="";
						$periodicite6="";
						switch ($demande->periodicite){
							case ("1"):
                                        $periodicite = "N/A";
                                        $periodicite1="selected";
								break;
							case ("2"):
                                        $periodicite = "12";
                                        $periodicite2="selected";
								break;
							case ("3"):
                                        $periodicite = "36";
                                        $periodicite3="selected";
								break;
							case ("4"):
                                        $periodicite = "60";
                                        $periodicite4="selected";
								break;
							case ("5"):
                                        $periodicite = "120";
                                        $periodicite5="selected";
								break;
							case ("6"):
										$periodicite = " à vie de l'outil";
										$periodicite6="selected";
						break;

							default:
                                        $periodicite = "N/A";
                                        $periodicite1="selected";
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
									 <div   class="form-control" style="height:auto !important" >{!! html_entity_decode($demande->comments) !!}
									</div>
								</div>
							</div>
						</div>

						</div>
					</div>
			</div>
		</div>

<fieldset disabled="disabled">
<div class="row gutter" style="margin-left:  20%;">
				<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
				<div class="panel">
					<div class="panel-heading" style="background:green;">
					
					
						<h4> PARTIE ETUDE <h4>
	
					</div>
					<div class="panel-body" style="background: #EBF1DE;">
	
							<form accept-charset="utf-8" id="form" name="form" method="post" action="{{ url('action/actionCoord/'.$demande->id) }}">
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
							<div class="form-group" >
						
									<div class="row gutter">
										<div class="col-md-6">
											<label class="control-label">DATE DEBUT D'ETUDE *: </label>
											<input  id="datededutetude" type="date" min="{{ date('Y-m-d', strtotime(date("Y-m-d").'+ 0 DAY')) }}" required class="form-control" name="datededutetude" placeholder="Enter Date" value={{ $demande->partieetude['datededutetude']}}  >
										</div>
										<div class="col-md-6">
											<label class="control-label">DELAIS EST.FIN D'ETUDE </label>
											<input id="delaisfinetude" type="date"  min="{{ date('Y-m-d', strtotime(date("Y-m-d").' + 0 DAY')) }}" class="form-control" name="delaisfinetude" placeholder="Enter Date" value={{ $demande->partieetude['delaisfinetude']}}  >
										</div>
	
									</div>
									<div class="row gutter" style="margin-top: 15px;">
											<div class="col-md-12">
													<div class="row gutter">
													<div class="col-md-6 col-md-offset-3">
															<p type="text"  class="form-control gridp text-center" style="text-align: -webkit-center;" >Temps d'études(en heure)</p>
													</div>
												
												</div>
												</div>
											<div class="col-md-12"style="margin-top: 10px;">
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
												<input type="number"  min="0" value="{{ $demande->partieetude['estimationetude3D']}}"  class="form-control montant" id="estimationetude3D" name="estimationetude3D" onchange="calculestimtotal()" >
											</div>
											<div class="col-md-3">
												<input type="number"  min="0" value="{{ $demande->partieetude['reeletude3D']}}"   class="form-control montant" id="reeletude3D" name="reeletude3D" onchange="calculreeltotal()" readonly >
											</div>
											<div class="col-md-3">
													<input type="text"  min="0" value="{{ $demande->partieetude['percentetude3D']}}%"   class="form-control montant"  name="percentetude3D" readonly >
												</div>
										</div>
										</div>
										<div class="col-md-12">
												<div class="row gutter">
													<div class="col-md-3">
														<label class="control-label">ETUDE 2D </label>
													</div>
													<div class="col-md-3">
														<input type="number"  min="0" value="{{ $demande->partieetude['estimationlaisse2D']}}"    class="form-control montant"  id="estimationlaisse2D" name="estimationlaisse2D" onchange="calculestimtotal()">
													</div>
													<div class="col-md-3">
														<input type="number"  min="0" value="{{ $demande->partieetude['reellaisse2D']}}"   class="form-control montant" id="reellaisse2D" name="reellaisse2D" onchange="calculreeltotal()" readonly >
													</div>
													<div class="col-md-3">
															<input type="text"  min="0" value="{{ $demande->partieetude['percentlaisse2D']}}%"   class="form-control montant"  name="percentlaisse2D" readonly >
														</div>
												</div>
										</div>
										<div class="col-md-12">
													<div class="row gutter">
														<div class="col-md-3">
															<label class="control-label">VERIFICATION 2D </label>
														</div>
														<div class="col-md-3">
															<input type="number"  min="0" value="{{ $demande->partieetude['estimationverification2D']}}"  class="form-control montant"  id="estimationverification2D" name="estimationverification2D" onchange="calculestimtotal()">
														</div>
														<div class="col-md-3">
															<input type="number"  min="0" value="{{ $demande->partieetude['reelverification2D']}}"  class="form-control montant"  id="reelverification2D" name="reelverification2D" onchange="calculreeltotal()" readonly >
														</div>
														<div class="col-md-3">
																<input type="text"  min="0" value="{{ $demande->partieetude['percentverification2D']}}%"  class="form-control montant"  name="percentverification2D" readonly  >
															</div>
													</div>
										</div>
										<div class="col-md-12">
												<div class="row gutter">
												<div class="col-md-3">
															<label class="control-label">TOTAL</label>
														</div>
													<div class="col-md-3">
														<input type="number"  min="0" value="{{ $demande->partieetude['estimationtotal']}}"   class="form-control" id="estimationtotal2" name="estimationtotal2" readonly >
													</div>
													<div class="col-md-3">
														<input type="number"  min="0" value="{{ $demande->partieetude['reeltotal']}}"   class="form-control"  id="reeltotal2" name="reeltotal2" readonly >
													</div>
													<div class="col-md-3">
															<input type="text"  min="0" value="{{$demande->partieetude['percenttotal']}}%"  class="form-control"  name="percenttotal" id="percenttotal"   readonly >
													</div>
										
												</div>
									</div>
									</div>	
									<div class="row gutter">
											<div class="col-md-6">
												<label class="control-label">DATE FIN D'ETUDE </label>
												<input id="datefinetude" type="date"  min="{{ date('Y-m-d', strtotime(date("Y-m-d").' + 0 DAY')) }}" class="form-control" placeholder="Enter Date" name="datefinetude" value={{ $demande->partieetude['datefinetude'] }}>
											</div>
		
										</div>		
								</div>
								@if($demande->type_intervention!='R' and $demande->type_intervention!='D')
								<div class="form-group no-margin">
										<div class="row gutter">
											<div class="col-md-4">
												<p type="text"  class="form-control gridp">{{ $demande->projteur->nameofprojeteur }}</p>
										</div> 	
										</div>
									</div>
								@endif
							</form>
					</div>
				</div>
			</div>
		</div>

</fieldset> 
<fieldset disabled="disabled">
<div class="row gutter" style="margin-left:  20%;">
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
												<select required class="form-control" name="periodicite" id="periodicite">
													<option {{$periodicite1}}  value="1">N/A</option>
													<option {{$periodicite2}} value="2">12</option>
													<option {{$periodicite3}} value="3">36</option>
													<option {{$periodicite4}} value="4">60</option>
													<option {{$periodicite5}} value="5">120</option>
													<option {{$periodicite6}} value="6">à vie de l'outil</option>
												</select>

											</div>
										</div>
									</div>
					</div>
				</div>
</div>
</div>
</fieldset> 
		
<div class="row gutter" style="margin-left:  20%;">
			<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="panel">
				<div class="panel-heading" style="background:#538DD5;">
				
				
					<h4> PARTIE FABRICATION <h4>

				</div>
				<div class="panel-body" style="background: #DAEEF3;">

						<form accept-charset="utf-8" id="form2" name="form2" method="post" action="{{ url('action/actionAtelier/'.$demande->id) }}">
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

						@if($demande->etap!=="METHODE FAB")
						<fieldset disabled="disabled">
						@endif
						
						<div class="form-group" >
					
								<div class="row gutter">
									<div class="col-md-6">
										<label class="control-label">DATE DEBUT DE FABRICATION *: </label>
										<input  id="datedebutfab" type="date" min="{{ date('Y-m-d', strtotime(date("Y-m-d").'+ 0 DAY')) }}" required class="form-control" placeholder="Enter Date" name="datedebutfab" onchange="calc_date_mini()" value={{$demande->partiefab['datededutfab']}}  >
										
									</div>
								</div>

								<div class="row gutter" style="margin-top: 15px;">
										<div class="col-md-12">
												<div class="row gutter">
												<div class="col-md-6 col-md-offset-3">
														<p type="text"  class="form-control gridp text-center" style="text-align: -webkit-center;background-color: #ccc;" >TEMPS DE FABRICATION(en jours)</p>
												</div>
											
											</div>
											</div>

											<div class="col-md-12" style="margin-top: 10px;">
												<div class="row gutter">
												<div class="col-md-3 col-md-offset-3">
														<p type="text"  class="form-control gridp text-center" style="text-align: -webkit-center;background-color: #ccc;"  >ESTIMATION</p>
												</div>
												<div class="col-md-3">
														<p type="text"  class="form-control gridp text-center" style="text-align: -webkit-center;background-color: #ccc;" >REEL</p>
												</div>
											</div>
											</div>
									
									<div class="col-md-12" style="margin-top: 8px;">
											
											<div class="row gutter">
											<div class="col-md-3">
											<label class="control-label">TOTAL </label>
											</div>
												<div class="col-md-3">
													<input type="number"  min="0" value="{{ $demande->partiefab['estimationfab']}}"  class="form-control" id="estimationtotal" name="estimationtotal" onchange="calc_date_mini()">
												</div>
												<div class="col-md-3">
													<input type="number"  min="0" value="{{ $demande->partiefab['reelfab']}}"   class="form-control"  id="reeltotal" name="reeltotal" onchange="calc_pourcentage()">
												</div>
												<div class="col-md-3">
													<?php
														if($demande->partiefab['estimationfab'] != 0){
															$pourcentage2 = round($demande->partiefab['reelfab']*100/$demande->partiefab['estimationfab']);
														}
														else $pourcentage2 = "";
													?>
													<input type="text" value="{{ $demande->partiefab['percenttotal'] }}%" readonly  class="form-control"  id="pourcentage" name="pourcentage">
												</div>
									
									</div>
								</div>
								</div>
								<div class="row gutter">
										<div class="col-md-6">
											<label class="control-label">COÛT DE L'OUTIL :</label>
											<input id="delaiestimelivr" type="float"   class="form-control" name="coutoutil" id="coutoutil" value={{ $demande->partiefab['cout_outil']==null ? 0 :  $demande->partiefab['cout_outil']  }}>
										</div>
	
									</div>
								<div class="row gutter">
										<div class="col-md-6">
											<label class="control-label">DELAI ESTIME LIVRAISON :</label>
											<input id="delaiestimelivr" type="date" readonly   class="form-control" name="delaiestimelivr" value={{ $demande->partiefab['delaisfinfab']}}>
										</div>
	
									</div>	
								<div class="row gutter">
										<div class="col-md-6">
											<label class="control-label">DATE FIN DE FIN FABRICATION :</label>
											<input id="datefinfab" type="date"  min="{{ date('Y-m-d', strtotime(date("Y-m-d").' + 0 DAY')) }}" class="form-control" placeholder="Enter Date" name="datefinfab" onchange='finfabrication()' value={{ $demande->partiefab['datefinfab']}} >
										</div>
	
								</div>		
							</div>
							@if($demande->etap=="METHODE FAB")
							<div class="form-group no-margin">
									<div class="row gutter">
										<div class="col-md-12">
											<button type="submit" class="btn btn-warning">Enregistrer</button>
											<button type="reset" class="btn btn-warning">Annuler</button>
										</div>
									</div>
							</div>
							@endif
						
							@if($demande->etap!="METHODE FAB")
							</fieldset>
							@endif
						</form>
				</div>
			</div>
			@if($demande->etap=="METHODE FAB")
			<div class="row gutter" style="margin-top:40px">
			<div class="col-md-12">
								<div class="">
									<button type="button" id="approuve-{{ $demande->id }}" onclick="afficherModal()"
									 class="btn btn-success btn-lg btn-block" title="Soumettre">Soumettre pour livraison</button>
									</div>
								</div>
			</div>
			@endif
		</div>

	</div>	
</div>

</div>


<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
							<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalForm">SOUMETTRE LA DEMANDE</h4>
				</div>
				<div class="modal-body">
						<div class="form-group">
							<label for="message-text" class="control-label">Commentaire:</label>
							<textarea class="form-control messagapprove" name="comment" id="message-text"></textarea>
						</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
					<button id="{{ $demande->id }}" class="btn btn-info btnapprove" onclick="savepoursoumettre(this)">Soumettre</button>
				</div>
		</div>
	</div>
</div>

	<div class="modal fade" id="modalForm2" tabindex="-1" role="dialog" aria-labelledby="modalForm2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form  accept-charset="utf-8" id="form" name="formapprouve" method="post" action="{{ url('action/affecteraucoordbymethodefab/'.$demande->id) }}" >
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalForm">AFFECTER AU COORDINATEUR BE</h4>
				</div>
				<div class="modal-body">
						@method('PUT')
						@csrf
						<div class="row gutter">
								<div class="col-md-12 ">
							<label for="message-text" class="control-label">Commentaire:</label>
							<textarea class="form-control messagapprove" name="comment" id="message-text"></textarea>
						</div>
						</div>					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
					<button type="submit" class="btn btn-info btnapprove">Affecter</button>
				</div>
			</form>
			</div>
		</div>
	</div>

		<div class="modal fade" id="modalForm3" tabindex="-1" role="dialog" aria-labelledby="modalForm3">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form  accept-charset="utf-8" id="form" name="formapprouve" method="post" action="{{ url('action/affecteraureferentbymethodefab/'.$demande->id) }}" >
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalForm">AFFECTER AU REFERENT OUTILLAGE</h4>
				</div>
				<div class="modal-body">
						@method('PUT')
						@csrf
						<div class="row gutter">
								<div class="col-md-12 ">
							<label for="message-text" class="control-label">Commentaire:</label>
							<textarea class="form-control messagapprove" name="comment" id="message-text"></textarea>
						</div>
						</div>
					
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
					<button type="submit" class="btn btn-info btnapprove">Affecter</button>
				</div>
			</form>
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
<!-- <script src="{{ asset('js/costumerjsapi/newdemande.js') }}"></script> -->
<script src="{{ asset('js/costumerjsapi/showMethodFabdemande.js') }}"></script>
@endsection