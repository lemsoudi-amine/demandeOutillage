
<!-- 	Modal ajout -->
<div class="modal fade bd-example-modal-lg" id="modalImport" tabindex="-1" role="dialog" 
		aria-labelledby="modalForm">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"
						aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<h4 class="modal-title" id="modalForm">Bilan import des commandes</h4>
				</div>

		    <div class="modal-body" style="overflow: auto;height:500px">
            @if (isset($detail) && $detail[0]==700)
              <h4 style="color:green">Nombre de lignes importées : {{$detail[1]}}</h4>
              <h4 style="color:red">Nombre de lignes non importées : <span style="Font-Weight: Bold">{{$detail[2]}}</span></h4>

              <details>
              <summary>details</summary>
              <br>
              @foreach ($detail[3] as $log)
              <p>{{$log}}</p>
              @endforeach
              @endif
              </details>

				    </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>

			</div>
		</div>
</div>
<style>
summary::-webkit-details-marker {
   display: none
}

summary:after {
   content: "+";
   color: #ADCA48;
   float: left;
   font-size: 1.5em;
   font-weight: bold;
   margin: -5px 5px 0 0;
   padding: 0;
   text-align: center;
   width: 20px;
}

details[open] summary:after {
   content: "-";
}
</style>
	<!-- 	End modal-->
