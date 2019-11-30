//set stat to EN COURS
function setstattoENCOURSFAB(s) {
   
  
    $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoENCOURSFAB',
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
                   location.reload();
                }
            });
}
//set stat to BE STAND-BY
function setstattoSTANDBYFAB(s) {
    $id=s.id;
    $.ajax({
        type : "PUT",
        url : '../../action/setstattoSTANDBYFAB',
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
                   location.reload();
                
        }
            });
  
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
       $("#form2").trackChanges();
});

function JoursFeries (an){
    var JourAn = new Date(an, "00", "01");
    var FeteTravail = new Date(an, "04", "01");
    var Victoire1945 = new Date(an, "04", "08");
    var FeteNationale = new Date(an,"06", "14");
    var Assomption = new Date(an, "07", "15");
    var Toussaint = new Date(an, "10", "01");
    var Armistice = new Date(an, "10", "11");
    var Noel = new Date(an, "11", "25");
    //**var SaintEtienne = new Date(an, "11", "26");**//
  
    var G = an%19;
    var C = Math.floor(an/100);
    var H = (C - Math.floor(C/4) - Math.floor((8*C+13)/25) + 19*G + 15)%30;
    var I = H - Math.floor(H/28)*(1 - Math.floor(H/28)*Math.floor(29/(H + 1))*Math.floor((21 - G)/11));
    var J = (an*1 + Math.floor(an/4) + I + 2 - C + Math.floor(C/4))%7;
    var L = I - J;
    var MoisPaques = 3 + Math.floor((L + 40)/44);
    var JourPaques = L + 28 - 31*Math.floor(MoisPaques/4);
    var Paques = new Date(an, MoisPaques-1, JourPaques);
    //**var VendrediSaint = new Date(an, MoisPaques-1, JourPaques-2);**//
    var LundiPaques = new Date(an, MoisPaques-1, JourPaques+1);
    var Ascension = new Date(an, MoisPaques-1, JourPaques+39);
    var Pentecote = new Date(an, MoisPaques-1, JourPaques+49);
    var LundiPentecote = new Date(an, MoisPaques-1, JourPaques+50);
  
    //**SaintEtienne et Vendredi Saint sont des fêtes exclusivement**//
    //**alscacienne. On les ignore dans notre cas.**//
    return new Array(JourAn, Paques, LundiPaques, FeteTravail, Victoire1945, Ascension, Pentecote, LundiPentecote, FeteNationale, Assomption, Toussaint, Armistice, Noel);
  }
  
  //******************************************************************************************************************************//
  //************************Calcul de la date minimum de portage (15 jours ouvrables après la date du jour)***********************//
  //******************************************************************************************************************************//
  function calc_date_mini(){
      if($('#datedebutfab').val()!="" && $('#estimationtotal').val()!=""){
      var date_debut =new  Date($('#datedebutfab').val());
      var jours_ouvres = $('#estimationtotal').val();
      var date_debut_annee = date_debut.getFullYear();
      var date_debut_mois = date_debut.getMonth();
      var date_debut_jour = date_debut.getDate();
  
      //**init. des compteurs**//
      var cpt_i = 0;
      var cpt_j = 0;
      var cpt_k = 0;
  
      //**init. des tableaux récupérant les jours feries de l'annee en cours et de l'annee suivante.**//
      var tab_1=new Array;
      var tab_2=new Array;
      tab_1=JoursFeries(date_debut.getFullYear());
      tab_2=JoursFeries(date_debut.getFullYear()+1);
  
      for(cpt_i=0; cpt_j < jours_ouvres ; cpt_i++) {
          var date_eval = new Date(date_debut_annee, date_debut_mois, date_debut_jour+cpt_i,12,0,0);
          var day_date_eval = date_eval.getDay();
          if((day_date_eval != 6) && (day_date_eval != 0)) {
              cpt_j++;
              for(cpt_k = 0; cpt_k <13; cpt_k++){
                  if(date_eval.getMonth() == tab_1[cpt_k].getMonth() && date_eval.getFullYear() == tab_1[cpt_k].getFullYear() && date_eval.getDate() == tab_1[cpt_k].getDate()){
                      cpt_j--;
                      break;
                  }
                  if(date_eval.getMonth() == tab_2[cpt_k].getMonth() && date_eval.getFullYear() == tab_2[cpt_k].getFullYear() && date_eval.getDate() == tab_2[cpt_k].getDate()){
                      cpt_j--;
                      break;
                  }
              }
          }
      }
      $("#delaiestimelivr").val(new Date(date_eval).toISOString().substring(0,10));

    }
    if($("#estimationtotal").val()!=0){
        var num = $("#reeltotal").val()*100/$("#estimationtotal").val();
        var rounded = Math.round(num);
        if(rounded<=100){
        $("#pourcentage").val(rounded+"%");
        }
        else{
            $("#pourcentage").val("100%");
        }
        }
        else{
            $("#pourcentage").val("%");
        }

  }
  
  //******************************************************************************************************************************//
  //************************Fonction de vérification si une date entrée est au de^là de la date minimum***************************//
  //******************************************************************************************************************************//
  function verif_date_mini(date_entree, date_mini){
      var date_entree_n = new Date(date_entree);
      var date_mini_n = new Date(date_mini);
  
      if (date_entree_n != "") {
      //**Transformation d'une date en jj/mm/aaaa en mm/jj/aaaa puis en date :Fri Sep 5 15:14:41 UTC+0200 2003)**//
          date_entree_jour = date_entree.substring(0,2);
           date_entree_mois= date_entree.substring(3,5);
           date_entree_annee = date_entree.substring(6,10);
           nouvelle_date_entree = new Date(date_entree_annee, date_entree_mois-1, date_entree_jour);
  
          if (nouvelle_date_entree.getTime()<date_mini_n.getTime()) {
              return 0;
          }
          else {
          return 1;
          }
      }
  }

  function calc_pourcentage(){
    if($("#estimationtotal").val()!=0){
    var num = $("#reeltotal").val()*100/$("#estimationtotal").val();
    var rounded = Math.round(num);
    if(rounded<=100){
        $("#pourcentage").val(rounded+"%");
        }
        else{
            $("#pourcentage").val("100%");
        }
    }
    else{
        $("#pourcentage").val("%");
    }
  }
  function finfabrication(){
      $('#pourcentage').val('100%');
  }
  function afficherModal(){
      if(parseInt($("#pourcentage").val().substr(0,$("#pourcentage").val().length-1))<100){
        new Noty({
            text: "<div class='icon i_access_denied notifico'> Vous ne pouvez pas soumettre tant que le pourcentage est inférieur à 100% </div>",
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
        $("#modalForm").modal('show');
      }
  }

  function affecteraureferentbymethodefab(s) {
    $("#modalForm3").modal('show'); 
}

function affecteraucoordbymethodefab(s) {
    $("#modalForm2").modal('show'); 
}
function savepoursoumettre(s) {
    if ($("#form2").isChanged()) {      
        var n = new Noty({
            layout   : 'center',
            type: 'info',
            theme    : 'relax',
            text: 'Voulez vous sauvegarder vos modifications avant de soumettre la demande pour livraison?',
            buttons: [
              Noty.button('Oui', 'btn btn-success', function() {
                $id=s.id;
                $datedebutfab=$("#datedebutfab").val();
                $reeltotal=$("#reeltotal").val();
                $estimationtotal=$("#estimationtotal").val();
                $delaiestimelivr=$("#delaiestimelivr").val();
                $delaiestimelivr=$("#delaiestimelivr").val();
                $coutoutil=$("#coutoutil").val();
                $datefinfab=$("#datefinfab").val();
                $pourcentage=$("#pourcentage").val();
                $comment=$("#comment").val();
                $.ajax({
                  type : "POST",
                  url : '../../action/saveAndsoumettre',
                  data: { 'id':  $id,
                          'datedebutfab':$datedebutfab,
                          'reeltotal' : $reeltotal,
                          'estimationtotal' : $estimationtotal,
                          'delaiestimelivr' : $delaiestimelivr,
                          'datefinfab' : $datefinfab,
                          'pourcentage' : $pourcentage,
                          'comment' : $comment
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
                $comment=$("#comment").val();
                $.ajax({
                  type : "POST",
                  url : '../../action/soumettre',
                  data: { 'id':  $id,
                        'comment' : $comment},
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
        $comment=$("#comment").val();
        $.ajax({
          type : "POST",
          url : '../../action/soumettre',
          data: { 'id':  $id,
                'comment' : $comment},
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
     }
  };