           /* Formatting function for row details - modify as you need */
           function format ( d ) {
            // `d` is the original data object for the row
            return '<table cellpadding="13" cellspacing="0" border="0">'+
                '<tr>'+
                    '<td><strong>Statut : </strong>'+d.statuts+'</td>'+
                '</tr>'+  
                '<tr>'+
                '<td><strong>Commentaire : </strong>'+d.commantaire+'</td>'+
            '</tr>'+
            '<tr>'+
                '<td><strong>Date de la dernière modification : </strong>'+d.updated_at.substr(8,2)+'-'+d.updated_at.substr(5,2)+'-'+d.updated_at.substr(0,4)+'</td>'+
            '</tr>'+      
            '</table>';
        }                
                        function onclickrejectermodal(s){
                        
                        var id = s.id;
                        $(".btnrejet").attr("id",id.split("-")[1]);
                        
                                               
                    }
                    
                      function onclickapprouvermodal(s){
                        
                        var id = s.id;
                        $(".btnapprove").attr("id",id.split("-")[1]);
                        
                    }
                   
                    
                    
                     function onclickshowdemande(s){
                     var id = s.id;
                     window.location = './show-demande.php?id='+id.split("-")[1];
        
                     }
        
                $(document).ready(function () {
        
     /*    var indextable = 0;
                        $('#scrollTabledemandes thead th').each(function () {
                           if(indextable==0 || indextable==11 || indextable==12)
                           {
                               
                           }
                           else
                           {

                            if (indextable==9)
                            {
                                var column = this;
                                var select = $('<select><option value=""></option></select>')
                                .appendTo( $(column).empty() )
                                .on( 'change', function () {
                                    var val = $.fn.dataTable.util.escapeRegex(
                                        $(this).val()
                                    );
                                    column
                                    .search( val ? '^'+val+'$' : '', true, false )
                                    .draw();
                                  } );
                                  column.data().unique().sort().each( function ( d, j ) {
                                    select.append( '<option value="'+d+'">'+d+'</option>' )
                                } );

                            }
                            else
                            {
                                    var title = $('#scrollTabledemandes thead th').eq($(this).index()).text();
                                    $(this).html('<input  style="width: 100%; font-size: 12px;" type="text" placeholder="' + title + '" />');
                            }
                           }
                           indextable++;
                        });*/
        
                  /*      $('#scrollTabledemandes input').on('click', function (e) {
                            e.stopPropagation();
                        });  // stop propagation of the click to the parent		
                        $('#scrollTabledemandes input').on('keyup change', function () {
                            var id = this.id;
                            var value = this.value;
                            var i = 0;
                            $('#scrollTabledemandes').DataTable().columns().every(function () {
                                if (id == i) {
                                    this.search(value).draw();
                                }
                                i++;
                            });
                        });*/
        
        // add a text input to each Column  -- end
        
        
        //                table = $("#scrollTabledemandes").DataTable({
        //                    scrollY: "500px",
        //                    scrollCollapse: !0,
        //                    paging: !1,
        //                    iDisplayLength: 10,
        //                    language: {"url": "../js/datatables/French.json"},
        //
        //                    retrieve: true,
        //                    stateSave: true
        //                });
        
          var table =  $("#scrollTabledemandes").DataTable({
                "scrollY": "500px",
                "scrollX": "100%",
                "select": 'single',
                "scrollCollapse": !0,
                "paging": 0,
                //"pagingType": "full_numbers",
                //"iDisplayLength": 10,
                "language": {"url": "../js/datatables/French.json"},
                "columns": [
                    {
                        "className":      'details-control',
                        "orderable":      false,
                        "data":           null,
                        "defaultContent": ''
                    },
                    { "data": "REFERENCE DEMANDE" },
                    { "data": "TYPE D'INTERVENTION" },
                    { "data": "REFERENT SECTEUR" },
                    { "data": "SECTION EMETTRICE" },      
                    { "data": "PORTEUR" }, 
                    { "data": "REFERENCE PRODUIT" },
                    { "data": "DESCRIPTION DU BESOIN" },
                    { "data": "DATE CREATION" },
                    { "data": "STATUT DE LA DEMANDE" },
                    { "data": "WORKFLOW" },
                    { "data": "DATE DE LIVRAISON PREVUEN" },
                    { "data": "AVANCEMENT" },
                    { "data": "ACTION" },
                    { "data": "statuts"},
                    { "data": "commantaire"},
                    { "data": "updated_at"},
                    { "data": "DATE CREATION CACHEE" },          
                ],
                "columnDefs": [
                    {
                        "targets" : [ 8 ],
                        "visible" : true,
                        "bSortable" : true,
                        "iDataSort": 17
                    } , {
                        "targets" : [ 17 ],
                        "visible" : false,
                        "bSortable" : true,
                    },
                    {"className": "dt-center", "targets": "_all"}
                  ],
                "order": [[8, 'desc']],
                initComplete: function() {
                    var state = this.api().state.loaded();
                    this.api().columns().every(function(colIdx) {
                        var colSearch = state ? state.columns[colIdx].search: null;

                        var column = this;
                        var value = "";
                        if (colSearch)
                            value = colSearch.search;
                            var title = $(column.header()).text();

                            if(colIdx==0 || colIdx==11 || colIdx==12)
                            {
                                
                            }
                            else
                            {
 
                             if (colIdx==9)
                             {
                                 var column = this;
                                $('<br/>').appendTo($(column.header()));
                                 var select = $('<select><option value="">TOUTES</option></select>')
                                 .appendTo($(column.header()))
                                 .on( 'change', function () {
                                     var val = $.fn.dataTable.util.escapeRegex(
                                         $(this).val()
                                     );
                                     column
                                     .search(  val ? '^'+val+'$' : '', true, false )
                                     .draw();
                                   } ).on('click',
                                   function (e) {         
                                       //e.preventDefault();
                                       e.stopPropagation();
                                      // this.setSelectionRange(0, this.value.length);
                                   }).on('mousedown', function (e) {
                                       //e.preventDefault();
                                       e.stopPropagation();
                                        
                                   }).on('focus', function (e) {
                                       //e.preventDefault();
                                       e.stopPropagation();
                                        
                                   });
                                   column.data().unique().sort().each( function ( d, j ) {
                                       if(d=="      ")
                                       {
                                        select.append( '<option value="'+d+'">      </option>' )
                                       }
                                       else
                                       {
                                        select.append( '<option value="'+d+'">'+d+'</option>' )
                                       }
                                 } );
 
                             }
                             else
                             {
                                if (colIdx==10)
                                {
                                    var column = this;
                                   $('<br/>').appendTo($(column.header()));
                                    var select = $('<select><option value="">TOUTES</option></select>')
                                    .appendTo($(column.header()))
                                    .on( 'change', function () {
                                        var val = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        column
                                        .search(  val ? '^'+val+'$' : '', true, false )
                                        .draw();
                                      } ).on('click',
                                      function (e) {         
                                          //e.preventDefault();
                                          e.stopPropagation();
                                         // this.setSelectionRange(0, this.value.length);
                                      }).on('mousedown', function (e) {
                                          //e.preventDefault();
                                          e.stopPropagation();
                                           
                                      }).on('focus', function (e) {
                                          //e.preventDefault();
                                          e.stopPropagation();
                                           
                                      });
                                      column.data().unique().sort().each( function ( d, j ) {
                                          if(d=="      ")
                                          {
                                           select.append( '<option value="'+d+'">      </option>' )
                                          }
                                          else
                                          {
                                           select.append( '<option value="'+d+'">'+d+'</option>' )
                                          }
                                    } );
    
                                }
                                else{
                                $('<br/>').appendTo($(column.header()));
                                var input = $('<input type="text" class="form-control filter_select" style="width:100%; min-width:120px;" placeholder="Rechercher  ' + title + '" value="' + value +'"/>')
                                    .appendTo($(column.header())).on('keyup change',
                                    function () {
                                                var val = $.fn.dataTable.util.escapeRegex(
                                                    $(this).val()
                                                );
                        
                                                column
                                                    .search( val)
                                                    .draw();
                                        }).on('click',
                                    function (e) {         
                                        //e.preventDefault();
                                        e.stopPropagation();
                                        this.setSelectionRange(0, this.value.length);
                                    }).on('mousedown', function (e) {
                                        //e.preventDefault();
                                        e.stopPropagation();
                                         
                                    }).on('focus', function (e) {
                                        //e.preventDefault();
                                        e.stopPropagation();
                                         
                                    });
                             }
                            }
                            }
                       
                            table.columns.adjust();
                    });
                   
                },
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
                table.columns.adjust();
            } );
        // Apply the search
                   /*     table.columns().eq(0).each(function (colIdx) {
                            $('input', table.column(colIdx).header()).on('keyup change', function () {
                                table
                                        .column(colIdx)
                                        .search(this.value)
                                        .draw();
                            });
                        });*/
                    });
        
        