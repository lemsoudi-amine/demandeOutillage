function calculestimtotal() {
  toto= parseFloat($("#estimationverification2D").val());
  toto+=parseFloat($("#estimationlaisse2D").val());
  toto+=parseFloat($("#estimationetude3D").val());
    $("#estimationtotal").val(toto);

}
function calculreeltotal() {
    toto=$("#reeletude3D").val()==""? 0: parseFloat($("#reeletude3D").val());
    toto+=$("#reellaisse2D").val()==""? 0:parseFloat($("#reellaisse2D").val());
    toto+=$("#reelverification2D").val()==""? 0:parseFloat($("#reelverification2D").val());
    $("#reeltotal").val(toto);

    if($("#estimationetude3D").val()!=0){
        if($("#reeletude3D").val()!=""){
        var num = $("#reeletude3D").val()*100/$("#estimationetude3D").val();
        var rounded = Math.round(num);
        $("#percentetude3D").val(rounded+"%");
        }
    }

    if($("#estimationlaisse2D").val()!=0){
        if($("#reellaisse2D").val()!=""){
        var num = $("#reellaisse2D").val()*100/$("#estimationlaisse2D").val();
        var rounded = Math.round(num);
        $("#percentlaisse2D").val(rounded+"%");
        }
    }
    if($("#estimationverification2D").val()!=0){
        if($("#reelverification2D").val()!=""){
        var num = $("#reelverification2D").val()*100/$("#estimationverification2D").val();
        var rounded = Math.round(num);
        $("#percentverification2D").val(rounded+"%");
        }
    } 

        if($("#percentetude3D").val()!="" && $("#percentlaisse2D").val()!="" && $("#percentverification2D").val()!=""){
        var rounded = $pourcentage=Math.round((Math.min($("#percentetude3D").val().substr(0,$("#percentetude3D").val().length-1),100)+Math.min($("#percentlaisse2D").val().substr(0,$("#percentlaisse2D").val().length-1),100)+Math.min($("#percentverification2D").val().substr(0,$("#percentverification2D").val().length-1),100))/3);
        $("#percenttotal").val(rounded+"%");
        }
    }  

  //set stat to BE PAS COMMENCE
  function setstattoBEPASCOMMENCE(s) {
      $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoBEPASCOMMENCE',
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
//set stat to EN COURS
  function setstattoENCOURS(s) {
   
  
    $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoENCOURS',
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
//set stat to CLOSE BE
function setstattoCLOSEBE(s) {
   
   
    $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoCLOSEBE',
        data: {'id':  $id},
        headers: {
            "X-HTTP-Method-Override": "PUT",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         },
        success : function(response) {
            if (response!="En cours Fab")
                {
                new Noty({
                    text: "<div class='icon i_access_denied notifico'> "+response+"</div>",
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
  
                    window.location.reload() 
                }
        }
            });
  
}

  $(document).ready(function () {
    // if($("#percentetude3D").val()!="" && $("#percentlaisse2D").val()!="" && $("#percentverification2D").val()!=""){
    //  var rounded = $pourcentage=Math.round((Math.min($("#percentetude3D").val().substr(0,$("#percentetude3D").val().length-1),100)+Math.min($("#percentlaisse2D").val().substr(0,$("#percentlaisse2D").val().length-1),100)+Math.min($("#percentverification2D").val().substr(0,$("#percentverification2D").val().length-1),100))/3);
    //    $("#percenttotal").val(rounded+"%");
    //    }
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
       $("#form").trackChanges();
});

    //assign atelier
    function assigneatelier(s) {
        var toto = $( "#atelier" ).val();

        if($("#percenttotal").val().substr(0,$("#percenttotal").val().length-1) != "100")
        {
            new Noty({
                text: "<div class='icon i_access_denied notifico'> Impossible d'assigner un responsable METHODE FAB tant que le pourcentage total est inférieur à 100%</div>",
                type: 'error',
                layout: 'center',
                timeout:2000,
                animation: {
                    open: 'animated bounceInLeft', // Animate.css class names
                    close: 'animated bounceOutLeft', // Animate.css class names
                }
            }).show();

        }
        else if($( "#atelier" ).val()==null)
        {
            new Noty({
                text: "<div class='icon i_access_denied notifico'> Veuillez selectionner un responsable METHODE FAB</div>",
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
            if($("#form").isChanged()){
                      
                var n = new Noty({
                    layout   : 'center',
                    type: 'info',
                    theme    : 'relax',
                    text: 'Voulez vous sauvegarder vos modifications avant d\'assigner le responsable methode fab?',
                    buttons: [
                      Noty.button('Oui', 'btn btn-success', function() {
                        $id=s.id;
                        $atelier=$("#atelier").val();
                        $reeletude3D=$("#reeletude3D").val();
                        $percentetude3D=$("#percentetude3D").val().substr(0,$("#percentetude3D").val().length-1);
                        $reellaisse2D=$("#reellaisse2D").val();
                        $percentlaisse2D=$("#percentlaisse2D").val().substr(0,$("#percentlaisse2D").val().length-1);
                        $reelverification2D=$("#reelverification2D").val();
                        $percentverification2D=$("#percentverification2D").val().substr(0,$("#percentverification2D").val().length-1);
                        $reeltotal=$("#reeltotal").val();
                        $percenttotal=$("#percenttotal").val().substr(0,$("#percenttotal").val().length-1);
                        
                        $.ajax({
                          type : "POST",
                          url : '../../action/saveAndassigneByProj',
                          data: { 'id':  $id,
                                  'atelier':$atelier,
                                  'reeletude3D' : $reeletude3D,
                                  'percentetude3D' : $percentetude3D,
                                  'reellaisse2D' : $reellaisse2D,
                                  'percentlaisse2D' : $percentlaisse2D,
                                  'reelverification2D' : $reelverification2D,
                                  'percentverification2D' : $percentverification2D,
                                  'reeltotal' : $reeltotal,
                                  'percenttotal' : $percenttotal
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
                        $atelier=$("#atelier").val();
                        $.ajax({
                          type : "POST",
                          url : '../../action/assigneByProj',
                          data: { 'id':  $id,
                                    'atelier':$atelier},
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
        $atelier=$("#atelier").val();
      $.ajax({
          type : "PUT",
          url : '../../action/assigneByProj',
          data: { 'id':  $id,
                  'atelier':$atelier},
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