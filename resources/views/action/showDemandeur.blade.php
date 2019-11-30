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
									<div class="col-xs-2 bs-wizard-step active">
											<div class="text-center bs-wizard-stepnum">DEMANDEUR</div>
											<div class="progress"><div class="progress-bar"></div></div>
											<a href="#" class="bs-wizard-dot"></a>
											<div class="bs-wizard-info text-center">La demande est validée par le demandeur</div>
									</div>
									<div class="col-xs-2 bs-wizard-step disabled">
									
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
								<div class="col-xs-2 bs-wizard-step complete">
								
										<div class="text-center bs-wizard-stepnum">COORDINATEUR BE</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
										<div class="bs-wizard-info text-center">En attente</div>
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
									<div class="col-xs-2 bs-wizard-step active">
								
										<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
										<div class="progress"><div class="progress-bar"></div></div>
										<a href="#" class="bs-wizard-dot"></a>
										<div class="bs-wizard-info text-center">En attente</div>
									</div>

						
											
						<div class="col-xs-2 bs-wizard-step disabled"><!-- active -->
							<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
							<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">La demande est rejetée par le demandeur</div>
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
						<div class="col-xs-2 bs-wizard-step complete"><!-- complete -->
						<div class="text-center bs-wizard-stepnum">PROJETEUR</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="bs-wizard-dot"></a>
						<div class="bs-wizard-info text-center">La demande est validée par le projeteur</div>
						</div>
						
						<div class="col-xs-2 bs-wizard-step complete"><!-- active -->
						<div class="text-center bs-wizard-stepnum">METHODE FAB</div>
						<div class="progress"><div class="progress-bar"></div></div>
						<a href="#" class="bs-wizard-dot"></a>
						<div class="bs-wizard-info text-center">La demande est soumis livraison par la methode FAB</div>
						</div>
						<div class="col-xs-2 bs-wizard-step active"><!-- active -->
							<div class="text-center bs-wizard-stepnum">LIVRAISON</div>
							<div class="progress"><div class="progress-bar"></div></div>
									<a href="#" class="bs-wizard-dot"></a>
							<div class="bs-wizard-info text-center">En attente</div>
						</div>
						</div>					
			  @endif
		
	@if($demande->etap=="LIVRAISON")
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
									  <div   class="form-control" style="height:auto !important;min-height: 30px;">
									    @foreach($filesofdemande as $file)
									    <a href="../../{{$file->path_File}}/{{$file->name_File}}" download="{{$file->name_File }}">{{ $file->name_File }}</a> 
											  <br>
										@endforeach
									</div>
								</div>
							</div>

							<div class="row gutter">
								<div class="col-md-6 selectContainer">
									<label class="control-label">GAIN ATTENDU:</label>
									<p   class="form-control" >
										<?php
								  
										
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
										{{ $gainattendu }}
									</p>
								</div>
								<div class="col-md-6" id='montantdiv'>
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
						
						
						@if (($demande->etap=="LIVRAISON" AND  $demande->statusofdemande=="SOUMIS LIVRAISON"))
						<div class="row gutter">
								<div class="col-md-4 col-md-offset-5">
									<a id="approuve-{{ $demande->id }}" data-toggle="modal" data-target="#modalForm" 
										class="btn i_tick icon-check confirmation icon small"
										style="padding-left: 9px;font-size: 50px;color: green;" title="APPROUVER">
									</a>
									<a id="rejet-{{ $demande->id }}" class="btn icon-circle-with-cross  rejection icon small" data-toggle="modal" 
									  data-target="#modalForm2" style="padding-left: 9px;font-size: 50px;color: red;" title="REJETER" >
									</a>
									</div>
								</div>
						</div>
						@endif
					

					</div>
			</div>
		</div>
	@else

		<div class="row gutter" style="margin-left:  20%;">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="panel">
				<div class="panel-heading">
					<h4>LA DEMANDE : <p align='center'>Réference  de la commande: {{$demande->ref_commande}}</p> <h4>
				</div>
                <div class="panel-body">
                    <?php
                        $typeinter1="";
						$typeinter2="";
						$typeinter3="";
						$typeinter4="";
						$typeinter5="";
						switch ($demande->type_intervention){
							case ("C"):
                                        $typeintervention = "CREATION";
                                        $typeinter1="selected";
								break;
							case ("D"):
                                        $typeintervention = "DUPLICATION";
                                        $typeinter2="selected";
								break;
							case ("M"):
                                        $typeintervention = "MODIFICATION";
                                        $typeinter3="selected";
								break;
							case ("R"):
                                        $typeintervention = "REPARATION (direct Atelier)";
                                        $typeinter4="selected";
								break;

							default:
                                        $typeintervention = "CREATION";
                                        $typeinter1="selected";
                        }
                        $degrepriorite1="";
						$degrepriorite2="";
						$degrepriorite3="";
						$degrepriorite4="";
						switch ($demande->degre_priorite) {
							case ("1"):
                                $degrepriorite = "LIVRAISON CLIENT BLOQUEE";
                                $degrepriorite1="selected";
								break;
							case ("2"):
                                $degrepriorite = "MAJEURE";
                                $degrepriorite2="selected";
								break;
							case ("3"):
                                $degrepriorite = "MINEURE";
                                $degrepriorite3="selected";
								break;
							case ("4"):
                                $degrepriorite = "EN DEVELOPPEMENT";
                                $degrepriorite4="selected";
								break;
							default:
								$degrepriorite = "";
						}
						$gainattendu1="";
                        $gainattendu2="";
                        $gainattendu3="";
                        $gainattendu4="";
                        $gainattendu5="";
                        switch ($demande->gain_attendu) {
                            case 1:
                                $gainattendu = "En  € à l'année";
                                $gainattendu1="selected";
                                break;
                            case 2:
                                $gainattendu = "En ergonomie";
                                $gainattendu2="selected";
                                break;
                            case 3:
                                $gainattendu = "En sécurité";
                                $gainattendu3="selected";
                                break;
                            case 4:
                                $gainattendu = "Réparation";
                                $gainattendu4="selected";
                                break;
                            case 5:
                                $gainattendu = "Maîtrise des procédés";
                                $gainattendu5="selected";
                                break;
                        
                            default:
                                $gainattendu = "";
                        }
					?>
                

						<form accept-charset="utf-8" id="form" name="form" method="post" action="{{ url('action/modifydemandebycoord/'.$demande->id) }}"  enctype="multipart/form-data">
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
								@if($demande->etap!=="DEMANDEUR")
								<fieldset disabled="disabled">
								@endif
						<div class="form-group">
								<div class="row gutter">
                                <div class="col-md-6 selectContainer">
									<label class="control-label">TYPE D'INTERVENTION :</label>
									<p   class="form-control" >{{ $typeintervention }}</p>                                               
								</div>
								</div>

								<div class="row gutter">
									<div class="col-md-4 selectContainer">
										<label class="control-label">PORTEUR *:</label>
										<select required class="form-control porteur" name="porteur" onchange="onchangeporteur(this)">
                                            <?php
                                            $arr=array();
                                            ?>

                                            @foreach ($listporteurs as $porteur )
                                            <?php
                                            if($demande->porteur["nameofporteur"]==$porteur->nameofporteur)
                                                $arr="selected";
                                            else
                                            $arr="";
                                            ?>
											<option {{$arr}}  value=' {{ $porteur->id }}' >{{ $porteur->nameofporteur }}</option>
											@endforeach
										</select>
									</div>
									<div class="col-md-4">
										<label class="control-label">N° CAPEX:</label>
										<input type="text"  class="form-control capex" value="{{ $demande->num_CAPEX }}" placeholder="N° CAPEX" name="capex" onchange="onchangecapex(this)">
									</div>
									<div class="col-md-4">
										<label class="control-label">CODE PROJET *:</label>
										<input type="text" required class="form-control codeprojet" value="{{ $demande->code_project }}" placeholder="Code projet" name="codeprojet" onchange="onchangecodeprojet(this)">
									</div>
									<div class="col-md-4">
										<label class="control-label">REF P/N IMPACTE *:</label>
										<input type="text" required class="form-control refpnimpacte" value="{{ $demande->ref_pn_impacte }}"  placeholder="Réf P/N impacté" name="refpnimpacte" onchange="onchangerefpnimpacte(this)">
									</div>
									<div class="col-md-4">
										<label class="control-label">IND: </label>
										<input type="text"  class="form-control pn" value="{{ $demande->pn }}" placeholder="ind P/N" name="pn"onchange="onchangeind(this)">
									</div>
									</div>
									<div class="row gutter">
									<div class="col-md-6">
										<label  class="control-label">REF OUTILLAGE <span class="etoilerequredref"></span>:</label>
										<input id="refoutille" type="text" class="form-control refoutillage" value="{{ $demande->ref_outillage }}" placeholder="Réf outillage" name="refoutillage" onchange="onchangerefoutillage(this)">
									</div>																														
								</div>
								<div class="row gutter">
                                <div class="col-md-4 selectContainer">
									<label class="control-label">SECTION EMETTRICE :</label>
									<p   class="form-control" >{{ $demande->section["num_section"] }}</p>  
								</div>
									<div class="col-md-4 selectContainer" >
										<label class="control-label"> NOM DE LA SECTION : </label>
										<p type="text" class="form-control gridp" id="namesection"  >{{ $demande->section["nameofsection"] }}</p>
									</div>
									<div class="col-md-4 selectContainer">
										<label class="control-label"> REFERENT SECTEUR:</label><p   class="form-control gridp" id="refsecteur">{{ $demande->section["refeent_secteur"] }}</p>
									</div>
								</div>
								<div class="row gutter">
									<div class="col-md-4 selectContainer">
										<label class="control-label">SUIVI PAR:</label>
										<p type="text"  class="form-control gridp" placeholder="ex:BEZZOT T" name="alivrera" >{{ $demande->user["firstname"]}}.{{ $demande->user["realname"] }}</p>
									</div>
								</div>
								<div class="row gutter">															
									<div class="col-md-6 selectContainer">
										<label class="control-label">DEGRE DE PRIORITE *:</label>
										<select required class="form-control degrepriorite" name="degrepriorite" onchange="onchangedegreprio(this)" >
											<option {{$degrepriorite1}} value="1">LIVRAISON CLIENT BLOQUEE</option>
											<option {{$degrepriorite2}}  value="2">MAJEURE</option>
											<option {{$degrepriorite3}}  value="3">MINEURE</option>
											<option {{$degrepriorite4}} value="4">EN DEVELOPPEMENT</option>
										</select>

									</div>
								</div>

								<div class="row gutter">
									<div class="col-md-6">
										<label class="control-label">DELAI SOUHAITE *: </label>
										<input  id="datesouhaite" value="{{ date_format(new DateTime($demande->date_souhaite),'Y-m-d') }}" type="date" min="{{ date('Y-m-d', strtotime(date("Y-m-d").'+ 0 DAY')) }}" required class="form-control" placeholder="Enter Date" name="datesouhaite" onchange="onchangedelaisouhaite(this)">
									</div>
									<div class="col-md-6">
										<label class="control-label">DATE PREVUE PROCHAIN OF(besoin outillage): </label>
										<input id="dateprevue" type="date" value="{{ date_format(new DateTime($demande->date_prev_OF),'Y-m-d') }}" min="{{ date('Y-m-d', strtotime(date("Y-m-d").' + 0 DAY')) }}" class="form-control" placeholder="Enter Date" name="dateprevue" onchange="onchangedateprevue(this)">
									</div>

								</div>
								<div class="row gutter">
									<div class="col-md-4">
										<label class="control-label">QUANTITE D'OUTILLAGE DEMANDEE *: </label>
										<input type="number"  min="1" value="{{ $demande->quantite }}" required  class="form-control quantite"  name="quantite" onchange="onchangequantite(this)">
									</div>
								</div>
								<div class="row gutter fonctionoutildev ">
									<div class="col-md-12">
										<label class="control-label">DESCRIPTION DU BESOIN : </label>
										@if($demande->etap=="DEMANDEUR")
										<textarea placeholder="ici" required class="form-control  fonctionoutil" name="fonctionoutil" rows="5" onchange="onchangede scription(this)">{!! html_entity_decode($demande->fonctions_outillage) !!}</textarea>
										@else
										<div   class="form-control" style="height:auto !important">{!!html_entity_decode($demande->fonctions_outillage) !!}
										</div>
										@endif
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
										<label class="control-label">GAIN ATTENDU *:</label>
										<select required class="form-control gainattendu" name="gainattendu"  onchange="gainchange(this)">
											<option {{$gainattendu1}} value="1">En € à l'année</option>
											<option {{$gainattendu2}} value="2">En ergonomie</option>
											<option {{$gainattendu3}} value="3">En sécurité</option>
											<option {{$gainattendu4}} value="4">Réparation</option>
											<option {{$gainattendu5}} value="5">Maîtrise des procédés</option>
										</select>

									</div>
									<div class="col-md-6" id='montantdiv' style="display:none">
										<label class="control-label">MONTANT (EN €): </label>
										<input type="number"  min="0" value="{{ $demande->gain_attendu_value }}" class="form-control montant"  name="montant" id="gainvalue" onchange="onchangemontant(this)">
									</div>
								</div>
								<div class="row gutter">
									<div class="col-md-12 ">
										<label class="control-label">COMMENTAIRES : </label>
										@if ($demande->etap=="DEMANDEUR")
										<textarea id="summernoteComment" placeholder="ici" class="form-control comments" name="comments" rows="5" onchange="onchangecomment(this)">{!! html_entity_decode($demande->comments) !!}</textarea>
										@else
										<div   class="form-control" style="height:auto !important">{!!html_entity_decode($demande->comments) !!}
										</div>
										@endif
									</div>
								</div>
								@if ($demande->etap=="DEMANDEUR")
								<p style="color: red;">  Les champs rouge marqués d'un * doivent être obligatoirement remplis.  </p>
								@endif
							</div>
							@if ($demande->etap=="DEMANDEUR")
							<div class="form-group no-margin">
								<div class="row gutter">
									<div class="col-md-12">
										<button type="submit" class="btn btn-warning">Enregistrer</button>
										<button type="reset" class="btn btn-warning">Annuler</button>
									</div>
								</div>
							</div>
							@endif
						@if ($demande->etap=="DEMANDEUR")
						<div class="row gutter">
										<div class="col-md-4 col-md-offset-5">
											<a id="approuve-{{ $demande->id }}" data-toggle="modal" data-target="#modalForm3" 
												class="btn i_tick icon-check confirmation icon small"
												style="padding-left: 9px;font-size: 50px;color: green;" title="APPROUVER">
											</a>
											<a id="{{ $demande->id }}" class="btn icon-circle-with-cross  rejection icon small"
											 style="padding-left: 9px;font-size: 50px;color: red;" title="SUPPRIMER" onclick="supprimerDemande(this)" >
											</a>
											</div>
										</div>
						@endif

						@if($demande->etap!=="DEMANDEUR")
								</fieldset>
								@endif
						</form>
				</div>
			</div>
		</div>

		@endif
	
		
	</div>
</div>
<div class="modal fade" id="modalForm" tabindex="-1" role="dialog" aria-labelledby="modalForm">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form  accept-charset="utf-8" id="form" name="formapprouve" method="post" action="{{ url('action/approverLivraisonBydemandeur/'.$demande->id) }}" >
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalForm">APPROUVER LA DEMANDE</h4>
				</div>
				<div class="modal-body">
						@method('PUT')
						@csrf
						<div class="form-group">
							<label for="message-text" class="control-label">Commentaire de l'approbation:</label>
							<textarea class="form-control messagapprove" name="comment" id="message-text"></textarea>
						</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
					<button type="submit" class="btn btn-info btnapprove">Approuver</button>
				</div>
			</form>
			</div>
		</div>
	</div>
 
	<div class="modal fade" id="modalForm2" tabindex="-1" role="dialog" aria-labelledby="modalForm2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form accept-charset="utf-8" id="form" name="formreject" method="post" action="{{ url('action/rejeterLivraisonBydemandeur/'.$demande->id) }}">
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalForm2">REJETER LA DEMANDE</h4>
				</div>
				<div class="modal-body">
						@method('PUT')
								@csrf
						<div class="form-group">
							<label for="message-text" class="control-label">Commentaire du rejet:</label>
							<textarea class="form-control messagerejet" name="comment" id="message-text" required></textarea>
							</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
					<button type="submit"  class="btn btn-info btnrejet">Rejeter</button></div>
			</form>
			</div>
		</div>
	</div>

	<div class="modal fade" id="modalForm3" tabindex="-1" role="dialog" aria-labelledby="modalForm">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<form  accept-charset="utf-8" id="form" name="formapprouve" method="post" action="{{ url('action/approverBydemandeur/'.$demande->id) }}" >
				<div class="modal-header"><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="modalForm">APPROUVER LA DEMANDE</h4>
				</div>
				<div class="modal-body">
						@method('PUT')
						@csrf
						<div class="form-group">
							<label for="message-text" class="control-label">Commentaire de l'approbation:</label>
							<textarea class="form-control messagapprove" name="comment" id="message-text"></textarea>
						</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button> 
					<button type="submit" class="btn btn-info btnapprove">Approuver</button>
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
<script src="{{ asset('js/costumerjsapi/newdemande.js') }}"></script>
@endsection