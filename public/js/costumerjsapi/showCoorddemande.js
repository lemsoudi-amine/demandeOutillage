function calculestimtotal() {
  toto= $("#estimationverification2D").val()==""? 0: parseFloat($("#estimationverification2D").val());
  toto+=$("#estimationlaisse2D").val()==""? 0: parseFloat($("#estimationlaisse2D").val());
  toto+=$("#estimationetude3D").val()==""? 0: parseFloat($("#estimationetude3D").val());
    $("#estimationtotal").val(toto);

}
function calculreeltotal() {
    toto= parseFloat($("#reeletude3D").val());
    toto+=parseFloat($("#reellaisse2D").val());
    toto+=parseFloat($("#reelverification2D").val());
      $("#reeltotal").val(toto);
  
  }
  //set stat to BE PAS COMMENCE
  function assigneprojeteur(s) {
    var toto = $( "#projeteur" ).val();
    if($( "#projeteur" ).val()==null)
    {
        new Noty({
            text: "<div class='icon i_access_denied notifico'> Veuillez selectionner un projeteur</div>",
            type: 'error',
            layout: 'center',
            animation: {
                open: 'animated bounceInLeft', // Animate.css class names
                close: 'animated bounceOutLeft', // Animate.css class names
            }
        }).show();   

    }
    else{
        if($( "#estimationetude3D" ).val()=="" && $( "#estimationlaisse2D" ).val()=="" && $( "#estimationverification2D" ).val()==""){
            new Noty({
                text: "<div class='icon i_access_denied notifico'> Veuillez remplir au moins un champ de l'estimation</div>",
                type: 'error',
                layout: 'center',
                timeout:2000,
                animation: {
                    open: 'animated bounceInLeft', // Animate.css class names
                    close: 'animated bounceOutLeft', // Animate.css class names
                }
            }).show();
        }
        else{
            if ($("#form1").isChanged() || $("#form2").isChanged() || $("#form3").isChanged()) {      
                var n = new Noty({
                    layout   : 'center',
                    type: 'info',
                    theme    : 'relax',
                    text: 'Voulez vous sauvegarder vos modifications avant d\'assigner le projeteur ?',
                    buttons: [
                      Noty.button('Oui', 'btn btn-success', function() {
                        $id=s.id;
                        $projteur=$(".projeteur").val();
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
                        $summernoteComment=$("#summernoteComment").val();
                        $datededutetude=$("#datededutetude").val();
                        $delaisfinetude=$("#delaisfinetude").val();
                        $estimationetude3D=$("#estimationetude3D").val();
                        $estimationlaisse2D=$("#estimationlaisse2D").val();
                        $estimationverification2D=$("#estimationverification2D").val();
                        $estimationtotal=$("#estimationtotal").val();
                        $periodicite=$("#periodicite").val();
                        $.ajax({
                          type : "POST",
                          url : '../../action/saveAndassigneByCoord',
                          data: { 'id':  $id,
                                  'projteur':$projteur,
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
                                  'montant' : $montant,
                                  'summernoteComment' : $summernoteComment,
                                  'datededutetude' : $datededutetude,
                                  'delaisfinetude' : $delaisfinetude,
                                  'estimationetude3D' : $estimationetude3D,
                                  'estimationlaisse2D' : $estimationlaisse2D,
                                  'estimationverification2D' : $estimationverification2D,
                                  'estimationtotal' : $estimationtotal,
                                  'periodicite' : $periodicite
                                },
                          headers: {
                              "X-HTTP-Method-Override": "PUT",
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                          success : function(response) {
                  
                                  new Noty({
                                      text: "<div class='icon i_access_denied notifico'> Demande traitée avec succés</div>",
                                      type: 'info',
                                      layout: 'center',
                                      timeout:2000,
                                      animation: {
                                          open: 'animated bounceInLeft', // Animate.css class names
                                          close: 'animated bounceOutLeft', // Animate.css class names
                                      }
                                  }).show();
                                  setTimeout(function(){
                                     window.location.reload();
                                  }, 2000);                           
                          }
                              }); 	    		    	
                          n.close();
                        }, {id: 'button1', 'data-status': 'ok'}),

                      Noty.button('Non', 'btn space', function () {
                        $id=s.id;
                        $projteur=$(".projeteur").val();
                        $.ajax({
                          type : "POST",
                          url : '../../action/assigneByCoord',
                          data: { 'id':  $id,
                                  'projteur':$projteur},
                          headers: {
                              "X-HTTP-Method-Override": "PUT",
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                          success : function(response) {
                  
                                  new Noty({
                                      text: "<div class='icon i_access_denied notifico'> Demande traitée avec succés</div>",
                                      type: 'info',
                                      layout: 'center',
                                      timeout:2000,
                                      animation: {
                                          open: 'animated bounceInLeft', // Animate.css class names
                                          close: 'animated bounceOutLeft', // Animate.css class names
                                      }
                                  }).show();
                                  setTimeout(function(){
                                    window.location.reload();
                                  }, 2000);                           
                          }
                              });
                          n.close();
                      })
                    ]
                  }).show();
             }
             else{
      $id=s.id;
      $projteur=$(".projeteur").val();
      $.ajax({
        type : "POST",
        url : '../../action/assigneByCoord',
        data: { 'id':  $id,
                'projteur':$projteur},
        headers: {
            "X-HTTP-Method-Override": "PUT",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success : function(response) {

                new Noty({
                    text: "<div class='icon i_access_denied notifico'> Demande traitée avec succés </div>",
                    type: 'info',
                    layout: 'center',
                    timeout:2000,
                    animation: {
                        open: 'animated bounceInLeft', // Animate.css class names
                        close: 'animated bounceOutLeft', // Animate.css class names
                    }
                }).show();
                setTimeout(function(){
                   window.location.reload();
                }, 2000);                           
        }
            });
        }
    }
    }
  }


  $(document).ready(function () {
    $('[data-toggle="popover"]').popover();
    $('[data-toggle="tooltip"]').tooltip();
    $('[data-toggle="popover"]').on('shown.bs.popover', function () {
        $('[data-toggle="tooltip"]').tooltip();
      });
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
       $("#form1").trackChanges();
       $("#form2").trackChanges();
       $("#form3").trackChanges();
});

//set stat to BE STAND-BY
function setstattoSTANDBY(s) {
    $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoSTANDBY',
        data: {'id':  $id},
        headers: {
            "X-HTTP-Method-Override": "PUT",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success : function(response) {
        
                new Noty({
                    text: "<div class='icon i_access_denied notifico'> "+response+"</div>",
                    type: 'info',
                    layout: 'center',
                    timeout:2000,
                    animation: {
                        open: 'animated bounceInLeft', // Animate.css class names
                        close: 'animated bounceOutLeft', // Animate.css class names
                    }
                }).show();                 
                   $('.projecteurstatdiv').html(response);
                
        }
            });
  
}

function setstattoANNULE(s) {
    $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoANNULE',
        data: {'id':  $id},
        headers: {
            "X-HTTP-Method-Override": "PUT",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success : function(response) {
        
                new Noty({
                    text: "<div class='icon i_access_denied notifico'> "+response+"</div>",
                    type: 'info',
                    layout: 'center',
                    timeout:2000,
                    animation: {
                        open: 'animated bounceInLeft', // Animate.css class names
                        close: 'animated bounceOutLeft', // Animate.css class names
                    }
                }).show();
             
                            
                   $('.projecteurstatdiv').html(response);
                //location.reload();
                
        }
            });
  
}

function setstattoWithout(s) {
    $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoWithout',
        data: {'id':  $id},
        headers: {
            "X-HTTP-Method-Override": "PUT",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success : function(response) {
        
                new Noty({
                    text: "<div class='icon i_access_denied notifico'> "+response+"</div>",
                    type: 'info',
                    layout: 'center',
                    timeout:2000,
                    animation: {
                        open: 'animated bounceInLeft', // Animate.css class names
                        close: 'animated bounceOutLeft', // Animate.css class names
                    }
                }).show();
                   $('.projecteurstatdiv').html(response);
                //location.reload();
        }
            });
  
}

function affecteraureferent(s) {
    $("#modalForm3").modal('show'); 
}
function savebeforeapprouvebycoord(s) {
    if ($("#form1").isChanged()) {      
        var n = new Noty({
            layout   : 'center',
            type: 'info',
            theme    : 'relax',
            text: 'Voulez vous sauvegarder vos modifications avant d\'approuver la demande ?',
            buttons: [
              Noty.button('Oui', 'btn btn-success', function() {
                $id=(s.id.split("-"))[1];
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
                  url : '../../action/savebeforeapprouvebycoord',
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