var chartData = generatechartData();

function generatechartData() {
	var chartData = [];
    var statisticsparsed = conteDemandebymonth;

    var cnt = 0;
    for (var i = 0; i < statisticsparsed.length; i++) {
        // we create date objects here. In your data, you can have date strings
        // and then set format of your dates using chart.dataDateFormat property,
        // however when possible, use date objects, as this will speed up chart rendering.
    	datecreation = new Date(statisticsparsed[i].datecreation);

    	cnt = statisticsparsed[i].cnt;

        chartData.push({
            datecreation: datecreation,
            cnt: cnt,
        });}
  return chartData;
}

var chart = AmCharts.makeChart( "demandebarAreaGraphparetape", {
  "type": "pie",
  "theme": "black",
  "radius": 100,
  "labelRadius": 30,
	"startDuration": 0,
	"hideCredits":true,
  "dataProvider": [ {
    "ETAPE": "DEMANDEUR",
    "pourcent": contDEMANDEUR,
    "color": "#449a5b"
  }, {
    "ETAPE": "REFERENT OUTILLAGE",
    "pourcent": contREF,
    "color":"#3693cf"
  }, {
    "ETAPE": "COORDINATEUR BE",
    "pourcent": contCORD,
    "color": "#2BF3ED"
  }, {
    "ETAPE": "PROJETEUR",
    "pourcent": contPROJ,
    "color": "#D0F915"
  }, {
    "ETAPE": "METHODE FAB",
    "pourcent": contFAB,
    "color": "#ffb400"
  }, {
    "ETAPE": "LIVRAISON",
    "pourcent": contLIVRAISON,
    "color": "#4cbe71"
  } ],
  "valueField": "pourcent",
  "titleField": "ETAPE",
  "colorField": "color",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": true
  }
} );

var chart = AmCharts.makeChart( "demandebarAreaGraphpartype", {
  "type": "pie",
  "theme": "black",
  "hideCredits":true,
  "labelRadius": 30,
	"startDuration": 0,
	"radius": 100,
  "dataProvider": [ {
		"TYPE": "CREATION",
    "pourcent": contCreation,
    "color":"#5DB924"
  }, {
    "TYPE": "MODIFICATION",
    "pourcent": contmodification,
    "color": "#F75813"
  }, {
    "TYPE": "DUPLICATION",
    "pourcent": contDuplication,
    "color": "#138966"
  }, {
    "TYPE": "REPARTITION",
    "pourcent": contrepartition,
    "color":"#DBF713"
  }],
  "valueField": "pourcent",
  "titleField": "TYPE",
  "colorField": "color",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": true
  }
} );
var chart = AmCharts.makeChart("demandesparmois", {
  "type": "serial",
  "theme": "black",
  "language": "fr", 
  "marginRight": 40,
  "marginLeft": 40,
  "autoMarginOffset": 20,
  "mouseWheelZoomEnabled":true,
  "dataDateFormat": "YYYY-MM-DD",
  "valueAxes": [{
      "id": "v1",
      "axisAlpha": 0,
      "position": "left",
      "ignoreAxisWidth":true
  }],
  "balloon": {
      "borderThickness": 1,
      "shadowAlpha": 0
  },
  "graphs": [{
      "id": "g1",
      "balloon":{
        "drop":true,
        "adjustBorderColor":false,
        "color":"#ffffff"
      },
      "bullet": "round",
      "bulletBorderAlpha": 1,
      "bulletColor": "#FFFFFF",
      "bulletSize": 5,
      "hideBulletsCount": 50,
      "lineThickness": 2,
      "title": "red line",
      "useLineColorForBulletBorder": true,
      "valueField": "value",
      "balloonText": "<span style='font-size:18px;'>[[value]]</span>"
  }],
  "chartCursor": {
      "pan": true,
      "valueLineEnabled": true,
      "valueLineBalloonEnabled": true,
      "categoryBalloonDateFormat": "MMM YYYY",
      "cursorAlpha":1,
      "cursorColor":"#258cbb",
      "limitToGraph":"g1",
      "valueLineAlpha":0.2,
      "valueZoomable":true
  },
  "valueScrollbar":{
    "oppositeAxis":false,
    "offset":50,
    "scrollbarHeight":10
  },
  "categoryField": "date",
  "categoryAxis": {
      "parseDates": true,
      "dashLength": 1,
      "minorGridEnabled": true,
      "minPeriod": "MM",
      "autoGridCount": false,
        "gridPosition": "start",
        "equalSpacing": true,
        "gridCount": 12, 
  },
  "export": {
    "enabled": true,
    "dateFormat" :  "MMM YYYY",
    "fileName": "Evolution des fonctions Schémathèque au cours des 12 derniers mois", 
    "menuReviver": function(item,li) {
        if (item.format === "CSV" || item.format === "JSON" || item.format === "PDF")
          li.style.display = "none";
        return li;
      }
  } ,
  "dataProvider": [{
      "date": demandemois11,
      "value": demandescount11
  }, {
      "date": demandemois10,
      "value": demandescount10
  }, {
      "date": demandemois9,
      "value": demandescount9
  }, {
      "date": demandemois8,
      "value": demandescount8
  }, {
      "date": demandemois7,
      "value": demandescount7
  }, {
      "date": demandemois6,
      "value": demandescount6
  }, {
      "date": demandemois5,
      "value": demandescount5
  }, {
      "date": demandemois4,
      "value": demandescount4
  }, {
      "date": demandemois3,
      "value": demandescount3
  }, {
      "date": demandemois2,
      "value": demandescount2
  }, {
      "date": demandemois1,
      "value": demandescount1
  }, {
      "date": demandemois0,
      "value": demandescount0
  }]
});

var chart = AmCharts.makeChart("graphedelaietude", {
  "type": "pie",
  "startDuration": 0,
  "theme": "black",
   "radius": 100,
   "labelRadius": -35,
   "labelsEnabled": true,
   "labelText": "[[percents]]%",
   "autoMargins": false,
   "marginTop": 0,
   "marginBottom": 0,
   "marginLeft": 0,
   "marginRight": 0,
   "pullOutRadius": 0,
  "addClassNames": true,
  "legend":{
   	"position":"right",
    "marginRight":100,
    "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
  "dataProvider": [{
    "country": "< 1 jour",
    "litres": delaietudelist0
  }, {
    "country": "1-2 journées",
    "litres": delaietudelist1
  }, {
    "country": "2-3 journées",
    "litres": delaietudelist2
  }, {
    "country": "3-4 journées",
    "litres": delaietudelist3
  }, {
    "country": "4-5 journées",
    "litres": delaietudelist4
  }, {
    "country": "5-6 journées",
    "litres": delaietudelist5
  }, {
    "country": "> 6 journées",
    "litres": delaietudelist6
  }],
  "valueField": "litres",
  "titleField": "country",
  "export": {
    "enabled": true
  }
});

var chart = AmCharts.makeChart("graphedelaifab", {
  "type": "pie",
  "startDuration": 0,
  "theme": "black",
   "radius": 100,
   "labelRadius": -35,
   "labelsEnabled": true,
   "labelText": "[[percents]]%",
   "autoMargins": false,
   "marginTop": 0,
   "marginBottom": 0,
   "marginLeft": 0,
   "marginRight": 0,
   "pullOutRadius": 0,
  "addClassNames": true,
  "legend":{
   	"position":"right",
    "marginRight":100,
    "autoMargins":false
  },
  "innerRadius": "30%",
  "defs": {
    "filter": [{
      "id": "shadow",
      "width": "200%",
      "height": "200%",
      "feOffset": {
        "result": "offOut",
        "in": "SourceAlpha",
        "dx": 0,
        "dy": 0
      },
      "feGaussianBlur": {
        "result": "blurOut",
        "in": "offOut",
        "stdDeviation": 5
      },
      "feBlend": {
        "in": "SourceGraphic",
        "in2": "blurOut",
        "mode": "normal"
      }
    }]
  },
  "dataProvider": [{
    "country": "< 1 jour",
    "litres": delaifablist0
  }, {
    "country": "1-2 journées",
    "litres": delaifablist1
  }, {
    "country": "2-3 journées",
    "litres": delaifablist2
  }, {
    "country": "3-4 journées",
    "litres": delaifablist3
  }, {
    "country": "4-5 journées",
    "litres": delaifablist4
  }, {
    "country": "5-6 journées",
    "litres": delaifablist5
  }, {
    "country": "> 6 journées",
    "litres": delaifablist6
  }],
  "valueField": "litres",
  "titleField": "country",
  "export": {
    "enabled": true
  }
});

var chart = AmCharts.makeChart( "demandesparservice", {
  "type": "pie",
  "theme": "black",
  "hideCredits":true,
  "labelRadius": 0,
	"startDuration": 0,
	"radius": 100,
  "dataProvider": demandesparservice,
  "valueField": "demande_count",
  "titleField": "service",
  "colorField": "color",
   "balloon":{
   "fixedPosition":true
  },
  "export": {
    "enabled": true
  }
} );


chart.addListener("init", handleInit);

chart.addListener("rollOverSlice", function(e) {
  handleRollOver(e);
});

function handleInit(){
  chart.legend.addListener("rollOverItem", handleRollOver);
}

function handleRollOver(e){
  var wedge = e.dataItem.wedge.node;
  wedge.parentNode.appendChild(wedge);
}
//chart.graphs[0].lineColor = "#ffffff";
chart.validateNow();