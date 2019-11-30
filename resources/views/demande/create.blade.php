@extends('layouts.master') 
@section('nameUser') 

@isset ($_SESSION['glpiname']) {{ $_SESSION['glpiname'] }} @endisset 

@endsection

@section('h4title') 
Demande d'outillage
@endsection 

@section('conteOfObject')
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<ul class="right-stats" id="mini-nav-right">
		<li>
			<a href="javascript:void(0)" class="btn btn-danger">
				<span>{{ $nbcommandejour-1 }}</span>Commande(s)du jour

			</a>
		</li>
	</ul>
</div>

@endsection 
@section('content')

<div class="main-container">
	<div class="row gutter" style="margin-left:  20%;">
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="panel">
				<div class="panel-heading">								
					<h4>NOUVELLE DEMANDE : <p align='center'>Référence de votre commande: <d id='sectionnum'> </d> _{{ substr( date("Y/m/d"), -8)}}_N{{$nbcommandejour}}<d id='typeinterref'>C </d></p> <h4>

				</div>
				<div class="panel-body">

						<form accept-charset="utf-8" id="form" name="form" method="post" action="{{ url('demandes') }}"  enctype="multipart/form-data">
								@if (count($errors))
								<div class="alert alert-danger alert-dismissible" data-dismiss="alert">			
									<div><ul>
											@foreach ( $errors->all() as $message )
												<li>{{ $message }}</li>
											@endforeach
										</ul></div>
									
								</div>
								@endif
								{{ csrf_field() }}
						<div class="form-group">
								<div class="row gutter">
									<div class="col-md-6 selectContainer">
										<label class="control-label">TYPE D'INTERVENTION *:</label>
										<select class="selecttype form-control red" name="typedintervenetion" onchange="onchangetypeintervenetion(this)">
											<option  value="" disabled selected hidden>Selectionner un type</option>
											<option  value="C">CREATION</option>
											<option  value="M">MODIFICATION</option>
											<option  value="R">REPARATION (direct Atelier)</option>
											<option  value="D">DUPLICATION</option>
										</select>
									</div>
								</div>

								<div class="row gutter">
									<div class="col-md-4 selectContainer">
										<label class="control-label">PORTEUR *:</label>
										<select required class="form-control red porteur" name="porteur" onchange="onchangeporteur(this)">
											<option   value="" disabled selected hidden>Selectionner un porteur</option>
											@foreach ($listporteurs as $porteur )
											
											<option value=' {{ $porteur->id }}'>{{ $porteur->nameofporteur }}</option>"
											
											@endforeach

										</select>
									</div>
									<div class="col-md-4">
										<label class="control-label">N° CAPEX:</label>
										<input type="text"  class="form-control capex" placeholder="N° CAPEX" name="capex" onchange="onchangecapex(this)">
									</div>
									<div class="col-md-4">
										<label class="control-label">CODE PROJET *:</label>
										<input type="text" required class="form-control red codeprojet" placeholder="Code projet" name="codeprojet" onchange="onchangecodeprojet(this)">
									</div>
									<div class="col-md-4">
										<label class="control-label">REF P/N IMPACTE *:</label>
										<input type="text" required class="form-control red refpnimpacte" placeholder="Réf P/N impacté" name="refpnimpacte" onchange="onchangerefpnimpacte(this)">
									</div>
									<div class="col-md-4">
										<label class="control-label">IND: </label>
										<input type="text"  class="form-control pn" placeholder="ind P/N" name="pn"onchange="onchangeind(this)">
									</div>
									</div>
									<div class="row gutter">
									<div class="col-md-6">
										<label  class="control-label">REF OUTILLAGE <span class="etoilerequredref"></span>:</label>
										<input id="refoutille" type="text" class="form-control refoutillage" placeholder="Réf outillage" name="refoutillage" onchange="onchangerefoutillage(this)">
									</div>																														
								</div>
								<div class="row gutter">
									<div class="col-md-4 selectContainer">
										<label class="control-label">SECTION EMETTRICE *:</label>
										<select  class="form-control red section" required name="section" id="getinfosection" >
											<option   value="" disabled selected hidden>Selectionner une section</option>
											@foreach ($listsections as $section )
											<option value='{{ $section->id}}' class="{{ $section->nameofsection}}+{{ $section->refeent_secteur}} ">{{ $section->num_section }}</option>"				
											@endforeach
										</select>
									</div>
									<div class="col-md-4 selectContainer" >
										<label class="control-label"> NOM DE LA SECTION : </label>
										<p type="text"  class="form-control gridp" id="namesection"  ></p>
									</div>
									<div class="col-md-4 selectContainer">
										<label class="control-label"> REFERENT SECTEUR:</label><p   class="form-control gridp" id="refsecteur"> </p>
									</div>
								</div>
								<div class="row gutter">
									<div class="col-md-4 selectContainer">
										<label class="control-label">SUIVI PAR:</label>
										<p type="text"  class="form-control gridp" placeholder="ex:BEZZOT T" name="alivrera" >{{ $_SESSION['glpifirstname']}}.{{ $_SESSION['glpirealname'] }}</p>
									</div>
								</div>
								<div class="row gutter">															
									<div class="col-md-6 selectContainer">
										<label class="control-label">DEGRE DE PRIORITE *:</label>
										<select required class="form-control red degrepriorite" name="degrepriorite" onchange="onchangedegreprio(this)" >
											<option   value="" disabled selected hidden>Selectionner un degre</option>
											<option  value="1">LIVRAISON CLIENT BLOQUEE</option>
											<option  value="2">MAJEURE</option>
											<option  value="3">MINEURE</option>
											<option  value="4">EN DEVELOPPEMENT</option>
										</select>

									</div>
								</div>

								<div class="row gutter">
									<div class="col-md-6">
										<label class="control-label">DELAI SOUHAITE *: </label>
										<input  id="datesouhaite" type="date" min="{{ date('Y-m-d', strtotime(date("Y-m-d").'+ 0 DAY')) }}" required class="form-control red" placeholder="Enter Date" name="datesouhaite" onchange="onchangedelaisouhaite(this)">
									</div>
									<div class="col-md-6">
										<label class="control-label">DATE PREVUE PROCHAIN OF(besoin outillage): </label>
										<input id="dateprevue" type="date"  min="{{ date('Y-m-d', strtotime(date("Y-m-d").' + 0 DAY')) }}" class="form-control" placeholder="Enter Date" name="dateprevue" onchange="onchangedateprevue(this)">
									</div>

								</div>
								<div class="row gutter">
									<div class="col-md-4">
										<label class="control-label">QUANTITE D'OUTILLAGE DEMANDEE *: </label>
										<input type="number"  min="1" value="0" required  class="form-control red quantite"  name="quantite" onchange="onchangequantite(this)">
									</div>
								</div>
								<div class="row gutter red fonctionoutildev ">
									<div class="col-md-12">
										<label class="control-label">DESCRIPTION DU BESOIN : </label>
										<textarea placeholder="ici" required class="form-control  fonctionoutil" name="fonctionoutil" rows="5" onchange="onchangedescription(this)"></textarea>
									</div>
								</div>
								<div class="row gutter">
									<div class="col-md-12">
										<label class="control-label">INSERER UNE OU PLUSIEURS PIECES JOINTES: </label>

										<input type="file" multiple="multiple" name="myfiles[]" id="fileUploader">

									</div>
								</div>
								<div class="row gutter">
									<div class="col-md-6 selectContainer">
										<label class="control-label">GAIN ATTENDU *:</label>
										<select required class="form-control red gainattendu" name="gainattendu"  onchange="gainchange(this)">
											<option   value="" disabled selected hidden>Selectionner un gain</option>
											<option  value="1">En € à l'année</option>
											<option  value="2">En ergonomie</option>
											<option  value="3">En sécurité</option>
											<option  value="4">Réparation</option>
											<option  value="5">Maîtrise des procédés</option>
										</select>

									</div>
									<div class="col-md-6" id='montantdiv' style="display:none">
										<label class="control-label">MONTANT (EN €): </label>
										<input type="number"  min="0" value="0"   class="form-control montant"  name="montant" onchange="onchangemontant(this)">

									</div>

								</div>
								<div class="row gutter">
									<div class="col-md-12 ">
										<label class="control-label">COMMENTAIRES : </label>
										<textarea id="summernoteComment" placeholder="ici" class="form-control comments" name="comments" rows="5" onchange="onchangecomment(this)"></textarea>
									</div>
								</div>
								<p style="color: red;">  Les champs rouge marqués d'un * doivent être obligatoirement remplis.  </p>
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
<link rel="stylesheet" href="{{ asset('css/font-fileuploader.css') }}">
<link rel="stylesheet" href="{{ asset('css/jquery.fileuploader.min.css') }}">
<link rel="stylesheet" href="{{ asset('js/summernote/dist/summernote.css') }}">
<link href="{{ asset('fonts/icomoon/icomoon.css') }}" rel="stylesheet">
<link href="{{ asset('fonts/font-awesome.css') }}" rel="stylesheet">
<link href="{{ asset('css/wysiwyg-editor/editor.css') }}" rel="stylesheet">


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