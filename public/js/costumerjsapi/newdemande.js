function onchangetypeintervenetion(s) {
    if (s.value != "") {
        $('.selecttype').removeClass("red");
        $('.selecttype').addClass("green");

        if (s.value != "C") {
            $('#refoutille').addClass("red");
            $('.etoilerequredref').html("*");
            $('#refoutille').attr('required', 'required');

        } else {
            $('#refoutille').removeClass("red");
            $('.etoilerequredref').html("");
            $('#refoutille').removeAttr('required');
        }
    }

    $("#typeinterref").html(s.value);

}

function onchangeporteur(s) {
    if (s.value != "") {
        $('.porteur').removeClass("red");
        $('.porteur').addClass("green");

    } else {
        $('.porteur').removeClass("green");
        $('.porteur').addClass("red");
    }
}

function onchangecapex(s) {
    if (s.value != "") {

        $('.capex').addClass("green");

    } else {
        $('.capex').removeClass("green");

    }
}

function onchangecodeprojet(s) {
    if (s.value != "") {
        $('.codeprojet').removeClass("red");
        $('.codeprojet').addClass("green");

    } else {
        $('.codeprojet').removeClass("green");
        $('.codeprojet').addClass("red");
    }
}

function onchangerefpnimpacte(s) {
    if (s.value != "") {
        $('.refpnimpacte').removeClass("red");
        $('.refpnimpacte').addClass("green");

    } else {
        $('.refpnimpacte').removeClass("green");
        $('.refpnimpacte').addClass("red");
    }
}

function onchangeind(s) {
    if (s.value != "") {
        $('.pn').removeClass("red");
        $('.pn').addClass("green");

    } else {
        $('.pn').removeClass("green");
        $('.pn').addClass("red");
    }
}

function onchangerefoutillage(s) {
    if (s.value != "") {
        $('.refoutillage').addClass("green");

    } else {
        $('.refoutillage').removeClass("green");
    }
}

function onchangedelaisouhaite(s) {
    if (s.value != "") {
        $('#datesouhaite').removeClass("red");
        $('#datesouhaite').addClass("green");

    } else {
        $('#datesouhaite').removeClass("green");
        $('#datesouhaite').addClass("red");
    }
}

function onchangedateprevue(s) {
    if (s.value != "") {
        $('#dateprevue').removeClass("red");
        $('#dateprevue').addClass("green");

    } else {
        $('#dateprevue').removeClass("green");
        $('#dateprevue').addClass("red");
    }
}

function onchangequantite(s) {
    if (s.value != "") {
        $('.quantite').removeClass("red");
        $('.quantite').addClass("green");

    } else {
        $('.quantite').removeClass("green");
        $('.quantite').addClass("red");
    }
}
$(".fonctionoutil").on("summernote.change", function (contents,e) {   // callback as jquery custom event 
    if (e != "") {
        $('.fonctionoutildev').removeClass("red");
        $('.fonctionoutildev').addClass("green");

    } else {
        $('.fonctionoutildev').removeClass("green");
        $('.fonctionoutildev').addClass("red");
    }
});

function onchangedescription(s) {
    if (s.value != "") {
        $('.fonctionoutildev').removeClass("red");
        $('.fonctionoutildev').addClass("green");

    } else {
        $('.fonctionoutildev').removeClass("green");
        $('.fonctionoutildev').addClass("red");
    }
}

function onchangemontant(s) {
    if (s.value != "") {
        $('.montant').removeClass("red");
        $('.montant').addClass("green");

    } else {
        $('.montant').removeClass("green");
        $('.montant').addClass("red");
    }
}

function onchangecomment(s) {
    if (s.value != "") {
        $('.comments').addClass("green");

    } else {
        $('.comments').removeClass("green");
    }
}


function gainchange(s) {
    if (s.value != "") {
        $('.gainattendu').removeClass("red");
        $('.gainattendu').addClass("green");
        if (s.value == "1") {
            $('#montantdiv').show();
            if($("#gainvalue").val()==0){
            $('.montant').addClass("red");
            $('.montant').attr('required', 'required');
            }

        } else {
            $('#montantdiv').hide();
            $('.montant').removeClass("red");
            $('.montant').removeAttr('required');

        }
    }
}

function onchangedegreprio(s) {
    switch (s.value) {
        case '1':
            var dattoset = new Date();
             dattoset = dattoset.setDate(dattoset.getDate()+15);
             dattoset = new Date(dattoset).toISOString().slice(0,10); //date('Y-m-d', strtotime(date(Y-m-d) +'15 DAY'));

            $('#datesouhaite').attr("min", dattoset);
            $('.degrepriorite').removeClass("red");
            $('.degrepriorite').addClass("green");
            break;
        case '2':
            var dattoset = new Date();
            dattoset = dattoset.setDate(dattoset.getDate()+30);
            dattoset = new Date(dattoset).toISOString().slice(0,10); //date('Y-m-d', strtotime(date(Y-m-d) +'30 DAY'));

            $('#datesouhaite').attr("min", dattoset);
            $('.degrepriorite').removeClass("red");
            $('.degrepriorite').addClass("green");
            break;
        case '3':
            var dattoset = new Date();
            dattoset = dattoset.setDate(dattoset.getDate()+90);
            dattoset = new Date(dattoset).toISOString().slice(0,10); //date('Y-m-d', strtotime(date(Y-m-d) +'90 DAY'));

            $('#datesouhaite').attr("min", dattoset);
            $('.degrepriorite').removeClass("red");
            $('.degrepriorite').addClass("green");
            break;
        case '4':
            var dattoset = new Date();
            dattoset = dattoset.setDate(dattoset.getDate()+18);
            dattoset = new Date(dattoset).toISOString().slice(0,10); //date('Y-m-d', strtotime(date(Y-m-d) +'180 DAY'));

            $('#datesouhaite').attr("min", dattoset);
            $('.degrepriorite').removeClass("red");
            $('.degrepriorite').addClass("green");
            break;
        default:
            var dattoset = new Date().toISOString().slice(0,10); //date('Y-m-d', strtotime(date(Y-m-d) +'0 DAY'));
            $('.degrepriorite').removeClass("green");
            $('.degrepriorite').addClass("red");
            $('#datesouhaite').attr("min", dattoset);
            break;
    }
}
$(document).ready(function () {

    $(".fonctionoutil").summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['fontname', ['fontname']],
            ['style', ['bold', 'italic']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
    $('#summernoteComment').summernote({
        toolbar: [
            // [groupName, [list of button]]
            ['fontname', ['fontname']],
            ['style', ['bold', 'italic']],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', ['ol', 'paragraph']],
            ['height', ['height']]
        ]
    });
   

    $('input[name="myfiles[]"]').fileuploader({
        addMore: true,
        captions: {
            button: function (options) {
                return 'choisir ' + (options.limit == 1 ? 'fichier' : 'fichiers');
            },
            feedback: function (options) {
                return 'choisir ' + (options.limit == 1 ? 'fichier' : 'fichiers') + ' à télécharger';
            },
            feedback2: function (options) {
                return options.length + ' ' + (options.length > 1 ? ' files were' : ' file was') + ' chosen';
            },
            confirm: 'Confirmer',
            cancel: 'Annuler',
            name: 'Nom',
            type: 'Type',
            size: 'Taille',
            dimensions: 'Dimensions',
            duration: 'Durée',
            crop: 'Crop',
            rotate: 'Tourner',
            sort: 'Trier',
            download: 'Télécharger',
            remove: 'Retirer',
            drop: 'Déposez les fichiers ici pour télécharger',
            paste: '<div class="fileuploader-pending-loader"></div> Coller un fichier, cliquez ici pour annuler.',
            removeConfirmation: 'Êtes-vous sûr de vouloir supprimer ce fichier?',
            errors: {
                filesLimit: 'Seulement ${limit} fichier(s) peuvent être téléchargés.',
                filesType: 'Seulement ${extensions} fichier(s) peuvent être téléchargés.',
                fileSize: '${name} est trop grand! Veuillez choisir un fichier jusqu ${fileMaxSize}MB.',
                filesSizeAll: 'Les fichiers que vous avez choisis sont trop grands! Veuillez télécharger des fichiers jusqu ${maxSize} MB.',
                fileName: 'Le fichier portant le nom $ {name} est déjà sélectionné.',
                folderUpload: "Vous n'êtes pas autorisé à télécharger des dossiers."
            }
        }
    });
    $("#getinfosection").on("change", function () {
        var id = $(this).val();
        if (id != "") {

            $('#getinfosection').removeClass("red");
            $('#getinfosection').addClass("green");


                   
                    $("#namesection").html($("#getinfosection option:selected")[0].className.split("+")[0]);
                    $("#refsecteur").html($("#getinfosection option:selected")[0].className.split("+")[1]);
                
           
        } else {
            $('#getinfosection').removeClass("green");
            $('#getinfosection').addClass("red");
            $("#namesection").html("");
            $("#refsecteur").html("");

        }
        $("#sectionnum").html($("#getinfosection option:selected").text());
    });

});
function supprimerDemande(s) {
                    $id=s.id;
                    var n = new Noty({
                    layout   : 'center',
                    type: 'info',
                    theme    : 'relax',
                    text: 'Voulez-vous supprimer diffinitivement la demande?',
                    buttons: [
                      Noty.button('Oui', 'btn btn-success', function() {
                        $id=s.id;
                        $.ajax({
                          type : "POST",
                          url : '../../action/supprimerDemande',
                          data: { 'id':  $id
                                },
                          headers: {
                              "X-HTTP-Method-Override": "DELETE",
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                           },
                          success : function(response) {
                                  new Noty({
                                      text: "<div class='icon i_access_denied notifico'> Demande supprimée avec succés</div>",
                                      type: 'info',
                                      layout: 'center',
                                      timeout:2000,
                                      animation: {
                                          open: 'animated bounceInLeft', // Animate.css class names
                                          close: 'animated bounceOutLeft', // Animate.css class names
                                      }
                                  }).show();
                                     window.location="../../demandes";                     
                          }
                              }); 	    		    	
                          n.close();
                        }, {id: 'button1', 'data-status': 'ok'}),

                      Noty.button('Non', 'btn space', function () {
                          n.close();
                      })
                    ]
                  }).show();
}

