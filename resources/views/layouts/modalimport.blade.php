						<!-- 	Modal ajout d'une schemathèque -->
                        <div class="modal fade" id="modalFormImport" tabindex="-1" role="dialog"
		aria-labelledby="modalForm">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="modalForm">Import des données</h4>
				</div>

				<div class="modal-body">
					{!! Form::open(['url' => '/uploadfile','files'=>'true','method' => 'post','enctype' =>"multipart/form-data"])  !!}
					<div class="form-group">
						{!! Form::label('fileParametres', 'Fichier des parametres', array('class' => 'awesome')) !!}
						{!!Form::file('fileParametres',array('id' => 'fileParametres'))!!}
					</div>
					<div class="form-group">
						{!! Form::label('fileCommandes', 'Fichier des commandes', array('class' => 'awesome')) !!}
						{!!Form::file('fileCommandes',array('id' => 'fileCommandes'))!!}
					</div>
					<div class="form-group">
						<input type="submit" class="btn btn-primary float-right" value="Importer les données">
					</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
	<!-- 	End modal d'ajout d'une schemathèque -->