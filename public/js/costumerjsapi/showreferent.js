$(document).ready(function () {

$.fn.extend({
  trackChanges: function() {
    $(":input",this).change(function() {
       $(this.form).data("changed", true);
    });
  }
  ,
  isChanged: function() { 
    return this.data("changed"); 
  }
 });
 $("#form").trackChanges();
});
function savebeforeapprouvebyref(s) {
            if ($("#form").isChanged()) {      
                var n = new Noty({
                    layout   : 'center',
                    type: 'info',
                    theme    : 'relax',
                    text: 'Voulez vous sauvegarder vos modifications avant d\'approuver la demande ?',
                    buttons: [
                      Noty.button('Oui', 'btn btn-success', function() {
                        $id=s.id;
                        $porteurID=$("#porteur").val();
                        $capex=$("#capex").val();
                        $codeprojet=$(".codeprojet").val();
                        $refpnimpacte=$(".refpnimpacte").val();
                        $pn=$(".pn").val();
                        $refoutillage=$(".refoutillage").val();
                        $degrepriorite=$(".degrepriorite").val();
                        $datesouhaite=$("#datesouhaite").val();
                        $dateprevue=$("#dateprevue").val();
                        $quantite=$(".quantite").val();
                        $fonctionoutil=$(".fonctionoutil").val();
                        $gainattendu=$(".gainattendu").val();
                        $montant=$(".montant").val();
                        $.ajax({
                          type : "POST",
                          url : '../../action/savebeforeapprouvebyref',
                          data: { 'id':  $id,
                                  'porteurID' : $porteurID,
                                  'capex' : $capex,
                                  'codeprojet' : $codeprojet,
                                  'refpnimpacte' : $refpnimpacte,
                                  'pn' : $pn,
                                  'refoutillage' : $refoutillage,
                                  'degrepriorite' : $degrepriorite,
                                  'datesouhaite' : $datesouhaite,
                                  'dateprevue' : $dateprevue,
                                  'quantite' : $quantite,
                                  'fonctionoutil' : $fonctionoutil,
                                  'gainattendu' : $gainattendu,
                                  'montant' : $montant
                                },
                          headers: {
                              "X-HTTP-Method-Override": "PUT",
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                          success : function(response) {
                  
                                  new Noty({
                                      text: "<div class='icon i_access_denied notifico'> Modifications sauvegardées avec succés</div>",
                                      type: 'info',
                                      layout: 'center',
                                      timeout:1000,
                                      animation: {
                                          open: 'animated bounceInLeft', // Animate.css class names
                                          close: 'animated bounceOutLeft', // Animate.css class names
                                      }
                                  }).show();
                                  setTimeout(function(){
                                    $("#modalForm").modal('show');
                                  }, 1200);                           
                          }
                              }); 	    		    	
                          n.close();
                        }, {id: 'button1', 'data-status': 'ok'}),

                      Noty.button('Non', 'btn space', function () {
                        n.close();
                        $("#modalForm").modal('show');
                      })
                    ]
                  }).show();
             }
             else{
                $("#modalForm").modal('show');
        }
    }