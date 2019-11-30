           /* Formatting function for row details - modify as you need */
           function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="9" cellspacing="0" border="0" style="padding-left:50px;">'+
                '<tr>'+
                    '<td><strong>Statut : </strong>'+d.statuts+'</td>'+
                '</tr>'+  
                '<tr>'+
                '<td><strong>Commentaire : </strong>'+d.commantaire+'</td>'+
            '</tr>'+      
            '</table>';
        }                
                        function onclickrejectermodal(s){
                        
                        var id = s.id;
                        $(".btnrejet").attr("id",id.split("-")[1]);
                        
                                               
                    }
                         function onclickrejecter(s){
                        
                        var id = s.id;
                        var msg=$('.messagerejet').val();
                                $.ajax({
                    type : "GET",
                    url : "rejeter-demande.php",
                                data: {'id': id,
                                'msg':msg},
                    
                    success : function(response) {
                        if (response==1)
                            {
                            new Noty({
                                text: "<div class='icon i_access_denied notifico'> La demande  a été rejetée</div>",
                                type: 'info',
                                layout: 'center',
                                timeout:2000,
                                animation: {
                                    open: 'animated bounceInLeft', // Animate.css class names
                                    close: 'animated bounceOutLeft', // Animate.css class names
                                }
                            }).show();
                         
                                        var toto=$("#rejet-"+id);	
                                        
                                        //rowtocomf.style.visibility = "hidden";
                                 // Hide Validation Button
        //	                   	rowtocomf.hide();
                                 // Hide Rejection Button
        //	                   	rowtocomf.next().hide();
                                        var abrouvelem=toto[0].previousElementSibling;
                                   
                                 // Change Status From Current to new	                   
                                 // Show Valid sign
                                       // rowtocomf.parentElement.parentElement.style.background="#C4FFD3";  
                                   toto[0].parentElement.innerHTML='<span style="padding-left: 9px;font-size: 25px;color: red;" class="icon-circle-with-cross"></span>';
                                        abrouvelem.style.visibility = "hidden";
                                        $("#rejet-"+id).hide();
                                   
                            }
                    }
                        });
                        
                        
                    }
                      function onclickapprouvermodal(s){
                        
                        var id = s.id;
                        $(".btnapprove").attr("id",id.split("-")[1]);
                        
                        
                        
                    }
                    function onclickapprouver(s){
                        
                        var id = s.id;
                        var msg=$('.messagapprove').val();
        
                                $.ajax({
                    type : "GET",
                    url : "confirm-demande.php",
                                 data: {'id': id,
                                'msg':msg},
                    
                    success : function(response) {
                        if (response!="")
                            {
                            new Noty({
                                text: "<div class='icon i_access_denied notifico'> La demande  a été approuvée</div>",
                                type: 'info',
                                layout: 'center',
                                timeout:2000,
                                animation: {
                                    open: 'animated bounceInLeft', // Animate.css class names
                                    close: 'animated bounceOutLeft', // Animate.css class names
                                }
                            }).show();
                            
                                       // rowtocomf.style.visibility = "hidden";
        
                                 // Hide Validation Button
        //	                   	rowtocomf.hide();
                                 // Hide Rejection Button
        //	                   	rowtocomf.next().hide();
                                   //rowtocomf.nextElementSibling.style.visibility = "hidden";
                                 // Change Status From Current to new	                   
                                 // Show Valid sign
                                       // rowtocomf.parentElement.parentElement.style.background="#C4FFD3";  
                                   //rowtocomf.parentElement.innerHTML='<span style="padding-left: 9px;font-size: 25px;" class="icon-checkbox-checked"></span>';
                                           var toto=$("#approuve-"+id);	
                                        
                                      
                                        var abrouvelem=toto[0].nextElementSibling;
                                   
                                 
                                   toto[0].parentElement.innerHTML='<span style="padding-left: 9px;font-size: 25px;color: green;" class="icon-checkbox-checked"></span>';
                                        abrouvelem.style.visibility = "hidden";
                                        $("#approuve-"+id).hide();
                                   
                                        
                                        $("#amender-"+response).html('<a id="'+response+'"'+'class="btn i_tick icon-pencil confirmation icon small"'
                                       +'style="padding-left: 9px;font-size: 25px;" title="AMENDER" onClick="onclickammander(this)"></a>');
                                   
                            }
                    }
                        });
                        
                        
                    }
                    
                    
                     function onclickshowdemande(s){
                     var id = s.id;
                     window.location = './show-demande.php?id='+id.split("-")[1];
        
                     }
        
                $(document).ready(function () {
        
       
        
        
                    
                       var table =  $("#scrollTabledemandes").DataTable({
                        "scrollY": "500px",
                        "ordering": false,
                        "scrollCollapse": !0,
                        "paging": !1,
                        "iDisplayLength": 10,
                        "language": {"url": "../js/datatables/French.json"},
                        "retrieve": true,
                        "stateSave": true,
                        "columns": [
                            {
                                "className":      'details-control',
                                "orderable":      false,
                                "data":           null,
                                "defaultContent": ''
                            },
                            { "data": ""},
                            { "data": "REFERENCE DEMANDE" },
                            { "data": "REFERENT SECTEUR" },
                            { "data": "SECTION EMETTRICE" },      
                            { "data": "STATUT DE LA DEMANDE" },
                            { "data": "DATE DE LIVRAISON PREVUEN" },
                            { "data": "AVANCEMENT" },
                            { "data": "Action" },
                            { "data": "statuts"},
                            { "data": "commantaire"}            
                        ],
                        "columnDefs": [
  		  		        {"className": "dt-center", "targets": "_all"}
                          ],
                          "drawCallback": function ( settings ) {
                            var api = this.api();
                            var rows = api.rows( {page:'current'} ).nodes();
                            var last=null;
                 
                            api.column(1, {page:'current'} ).data().each( function ( group, i ) {
                                if ( last !== group ) {
                                    $(rows).eq( i ).before(
                                        '<tr class="group"><td colspan="13">'+group+'</td></tr>'
                                    );
                 
                                    last = group;
                                }
                            } );
                        }
                    } );
         
             
            // Add event listener for opening and closing details
            $('#scrollTabledemandes tbody').on('click', 'td.details-control', function () {
                var tr = $(this).closest('tr');
                var row = table.row( tr );
         
                if ( row.child.isShown() ) {
                    // This row is already open - close it
                    row.child.hide();
                    tr.removeClass('shown');
                }
                else {
                    // Open this row
                    row.child( format(row.data()) ).show();
                    tr.addClass('shown');
                }
            } );
  
                    });
        
        