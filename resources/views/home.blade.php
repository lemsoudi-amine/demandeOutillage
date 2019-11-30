@extends('layouts.master')	
@section('nameUser')
			 @isset ($_SESSION['glpiname']) 
			{{ $_SESSION['glpiname'] }} @endisset
@endsection
@section('h4title')
Dashboard
@endsection
@section('content')
		<div class="row gutter">
			
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="mini-widget redd">
					<div class="mini-widget-heading clearfix">
						<div class="pull-left">DEMANDES<p>En attente</p></div>
						<div class="pull-right">
								@if ($conteDemandeall!=0)
								{{round(($conteDemandeenattente*100)/$conteDemandeall) }}%
								@else
								0%
								@endif
							 </div>
					</div>
					<div class="mini-widget-body clearfix">
						<div class="pull-left">
							<i class="icon-schedule"></i>
						</div>
						<div class="pull-right number">{{ $conteDemandeenattente }}</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="mini-widget">
					<div class="mini-widget-heading clearfix">
						<div class="pull-left">DEMANDES<p> (Nouvelles & Attribuées)</p></div>
						<div class="pull-right">
								@if ($conteDemandeall!=0)
								{{round(($conteDemandenew*100)/$conteDemandeall) }}%
								@else
								0%
								@endif
							 </div>
					</div>
					<div class="mini-widget-body clearfix">
						<div class="pull-left">
							<i class="icon-tag"></i>
						</div>
						<div class="pull-right number">{{ round($conteDemandenew) }} </div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="mini-widget yellow">
					<div class="mini-widget-heading clearfix">
						<div class="pull-left">DEMANDES<p>En cours de fabrication</p></div>
						<div class="pull-right">
@if ($conteDemandeall!=0)
{{ round(($conteDemandeEncoursFAB*100)/$conteDemandeall) }}%
@else
0%
@endif</div>
					</div>
					<div class="mini-widget-body clearfix">
						<div class="pull-left">
							<i class="icon-beenhere"></i>
						</div>
						<div class="pull-right number">{{ $conteDemandeEncoursFAB }}</div>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-md-3 col-sm-6">
				<div class="mini-widget greenn">
					<div class="mini-widget-heading clearfix">
						<div class="pull-left">DEMANDES<p>Livrées client</p></div>
						<div class="pull-right">
							@if ($conteDemandeall!=0)
							{{ round(($conteDemandelivre*100)/$conteDemandeall) }}%
							@else
							0%
							@endif</div>
					</div>
					<div class="mini-widget-body clearfix">
						<div class="pull-left">
							<i class="icon-aircraft-take-off"></i>
						</div>
						<div class="pull-right number">{{  $conteDemandelivre }}</div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="panel">
				<div class="panel-body" style="background-color:#303030">
          <div class="col-md-4" style="border:1px">
					<p style="color:#bbbbbb;font-size:15px;"><span style="color:#AAAAAA;font-size:20px;font-weight:bold">.</span> DEMANDES PAR MOIS</p>
					<hr style="margin:0px">
          <div class="col-md-offset-4" style="position:absolute;z-index=999">
          <div style="color:#ffffff;font-weight:200;font-size:400%;letter-spacing : 6px;display:inline-block">{{$thismonthdemandecount}}</div>
					@if($ecart<=0)
					<div  style="display:inline-block">
					<div class="arrow-down"></div>
					<span style="color:#ff0000;font-size:2em">{{abs($ecart)}}%</span>
					</div>
					@else
					<div style="display:inline-block">
					<div class="arrow-up"></div>
					<span style="color:green;font-size:2em">{{abs($ecart)}}%</span>
					</div>
					@endif
          </div>
					<div id="demandesparmois"></div>
					</div>
			<div class="col-md-4" style="border:1px">
					<p style="color:#bbbbbb;font-size:15px;"><span style="color:#AAAAAA;font-size:20px;font-weight:bold">.</span> DEMANDES PAR TYPE</p>
					<hr style="margin:0px">
					<div id="demandebarAreaGraphpartype" style="z-index : 9000"></div>
			</div>
			<div class="col-md-4" style="border:1px">
					<p style="color:#bbbbbb;font-size:15px;"><span style="color:#AAAAAA;font-size:20px;font-weight:bold">.</span> DEMANDES PAR ETAPE</p>
					<hr style="margin:0px">
					<div id="demandebarAreaGraphparetape" style="z-index : 9000"></div>
			</div>
          <div class="col-md-4" style="border:1px">
					<p style="color:#bbbbbb;font-size:15px;"><span style="color:#AAAAAA;font-size:20px;font-weight:bold">.</span> DÉLAI D'ÉTUDE</p>
					<hr style="margin:0px">
					<div id="graphedelaietude" style="z-index : 9000"></div>
					</div>
          <div class="col-md-4" style="border:1px">
					<p style="color:#bbbbbb;font-size:15px;"><span style="color:#AAAAAA;font-size:20px;font-weight:bold">.</span> DÉLAI DE FABRICATION</p>
					<hr style="margin:0px">
					<div id="graphedelaifab" style="z-index : 9000"></div>
			</div>
			<div class="col-md-4" style="border:1px">
					<p style="color:#bbbbbb;font-size:15px;"><span style="color:#AAAAAA;font-size:20px;font-weight:bold">.</span> DEMANDES PAR SERVICE</p>
					<hr style="margin:0px">
					<div id="demandesparservice" style="z-index : 9000"></div>
			</div>
				</div>
			</div>
@endsection
@section('style')
<link rel="stylesheet" href="{{ asset('css/amcharts/export.css') }}">
<style>
#demandebarAreaGraphparetape {
  width: 100%;
  height: 300px;
}
#demandebarAreaGraphpartype {
  width: 100%;
  height: 300px;
}
#demandesparmois {
	width	: 100%;
	height	: 300px;
}
#graphedelaietude {
	width	: 100%;
	height	: 300px;
}
#graphedelaifab {
	width	: 100%;
	height	: 300px;
}
#demandesparservice {
	width	: 100%;
	height	: 300px;
}
.arrow-down {
  width: 0; 
  height: 0; 
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  display : inline-block;
  border-top: 20px solid #f00;
}
.arrow-up {
  width: 0; 
  height: 0; 
  border-left: 15px solid transparent;
  border-right: 15px solid transparent;
  display : inline-block;
  border-bottom: 20px solid green;
}
.amcharts-pie-slice {
  transform: scale(1);
  transform-origin: 50% 50%;
  transition-duration: 0.3s;
  transition: all .3s ease-out;
  -webkit-transition: all .3s ease-out;
  -moz-transition: all .3s ease-out;
  -o-transition: all .3s ease-out;
  cursor: pointer;
  box-shadow: 0 0 30px 0 #000;
}

.amcharts-pie-slice:hover {
  transform: scale(1.1);
  filter: url(#shadow);
}							
	</style>
@endsection
@section('scripts')
<script src="{{ asset('js/amcharts/amcharts.js') }}"></script>
<script src="{{ asset('js/amcharts/serial.js') }}"></script>
<script src="{{ asset('js/amcharts/pie.js') }}"></script>
<script src="{{ asset('js/amcharts/export.min.js') }}"></script>
<script src="{{ asset('js/amcharts/black.js') }}"></script>
<script src="{{ asset('js/amcharts/lang/fr.js') }}"></script>
<script>
var conteDemandebymonth = {!! $conteDemandebymonth !!};
var contDEMANDEUR = {!! $contDEMANDEUR !!};
var contREF ={!! $contREF !!};
var contCORD ={!! $contCORD !!};
var contPROJ = {!! $contPROJ !!};
var contFAB = {!! $contFAB !!};
var contLIVRAISON ={!! $contLIVRAISON !!};
var contCreation ={!! $contCreation !!};
var contmodification = {!! $contmodification !!};
var contDuplication = {!! $contDuplication !!};
var contrepartition = {!! $contrepartition !!};
var demandescount11 = {!! $demandescount[11] !!};
var demandescount10 = {!! $demandescount[10] !!};
var demandescount9 = {!! $demandescount[9] !!};
var demandescount8 = {!! $demandescount[8] !!};
var demandescount7 = {!! $demandescount[7] !!};
var demandescount6 = {!! $demandescount[6] !!};
var demandescount5 = {!! $demandescount[5] !!};
var demandescount4 = {!! $demandescount[4] !!};
var demandescount3 = {!! $demandescount[3] !!};
var demandescount2 = {!! $demandescount[2] !!};
var demandescount1 = {!! $demandescount[1] !!};
var demandescount0 = {!! $demandescount[0] !!};
var demandemois11 = {!! "'".$demandemois[11]."'" !!};
var demandemois10 ={!! "'".$demandemois[10]."'" !!};
var demandemois9 = {!! "'".$demandemois[9]."'"!!};
var demandemois8 = {!! "'".$demandemois[8]."'"!!};
var demandemois7 = {!! "'".$demandemois[7]."'"!!};
var demandemois6 = {!! "'".$demandemois[6]."'"!!};
var demandemois5 = {!! "'".$demandemois[5]."'"!!};
var demandemois4 = {!! "'".$demandemois[4]."'"!!};
var demandemois3 = {!! "'".$demandemois[3]."'"!!};
var demandemois2 = {!! "'".$demandemois[2]."'"!!};
var demandemois1 = {!! "'".$demandemois[1]."'"!!};
var demandemois0 = {!! "'".$demandemois[0]."'"!!};

var delaietudelist6 = {!! "'".$delaietudelist[6]."'"!!};
var delaietudelist5 = {!! "'".$delaietudelist[5]."'"!!};
var delaietudelist4 = {!! "'".$delaietudelist[4]."'"!!};
var delaietudelist3 = {!! "'".$delaietudelist[3]."'"!!};
var delaietudelist2 = {!! "'".$delaietudelist[2]."'"!!};
var delaietudelist1 = {!! "'".$delaietudelist[1]."'"!!};
var delaietudelist0 = {!! "'".$delaietudelist[0]."'"!!};

var delaifablist6 = {!! "'".$delaifablist[6]."'"!!};
var delaifablist5 = {!! "'".$delaifablist[5]."'"!!};
var delaifablist4 = {!! "'".$delaifablist[4]."'"!!};
var delaifablist3 = {!! "'".$delaifablist[3]."'"!!};
var delaifablist2 = {!! "'".$delaifablist[2]."'"!!};
var delaifablist1 = {!! "'".$delaifablist[1]."'"!!};
var delaifablist0 = {!! "'".$delaifablist[0]."'"!!};

var  demandesparservice = {!! $demandesparservice !!}
</script>
<script src="{{ asset('js/costumerjsapi/dashboard.js') }}"></script>

@endsection

