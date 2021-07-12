<?php
$headers=[];
$data=[];
$payload=[];
$master=isset($_GET['master']) ? 1 : 0;
$slave=isset($_GET['slave']) ? 1 : 0;
$i=0;
if (($handle = fopen("placenames.csv", "r")) !== FALSE) {
	while (($row = fgetcsv($handle, 1000, ",")) !== FALSE) {
		if (!count($headers)) $headers=$row;
		else {
			$e=[];
			foreach($headers as $key=>$val) {
				$e[strtolower($val)]=$row[$key];
			}
			if (
				isset($e[strtolower('Recorded Meaning of Place Name, or Reason Why it was Given')]) &&
				isset($e[strtolower('Original place name as recorded in SL Collections')]) &&
				isset($e[strtolower('Latitude')]) &&
				isset($e[strtolower('Longitude')])
				) {
				if (
					!empty($e[strtolower('Recorded Meaning of Place Name, or Reason Why it was Given')]) &&
					!empty($e[strtolower('Original place name as recorded in SL Collections')]) &&
					!empty($e[strtolower('Latitude')]) &&
					!empty($e[strtolower('Longitude')])
					) {
					$payload[]=[
				'meaning'=>strtoupper($e[strtolower('Recorded Meaning of Place Name, or Reason Why it was Given')]),
				'name'=>strtoupper($e[strtolower('Original place name as recorded in SL Collections')]),
				'lat'=>$e[strtolower('Latitude')],
				'lng'=>$e[strtolower('Longitude')],
				];
			}
		}
	}
}
fclose($handle);
}
shuffle($payload);
?>
<html>
<head>
	<meta charset="utf-8" />  
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<title>Muru View</title>
	<link id="favicon" rel="shortcut icon" href="favicon.ico">
	<meta name="description" content="An interactive online map experience and a projected installation at the State Library of New South Wales itself coinciding with NAIDOC week 2017.”/>
	<link rel="canonical" href="http://dxlab.sl.nsw.gov.au/muruview" />
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Muru View" />
	<meta property="og:description" content="An interactive online map experience and a projected installation at the State Library of New South Wales itself coinciding with NAIDOC week 2017." />
	<meta property="og:url" content="http://dxlab.sl.nsw.gov.au/muruview" />
	<meta property="og:site_name" content="Muru View" />
	<meta property="og:image" content="img/MuruView_OG_2.jpg” />
	<meta name="twitter:card" content="summary"/>
	<meta name="twitter:description" content="An interactive online map experience and a projected installation at the State Library of New South Wales itself coinciding with NAIDOC week 2017."/>
	<meta name="twitter:title" content="Muru View"/>
	<meta name="twitter:image" content="img/MuruView_OG_2.jpg"/>
	<meta itemprop="name" content="Muru View">
	<meta itemprop="description" content="An interactive online map experience and a projected installation at the State Library of New South Wales itself coinciding with NAIDOC week 2017.">
	<meta itemprop="image" content="img/MuruView_OG_2.jpg">

	<script src="js/functions.js"></script>
	<script src="js/raf_shim.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Rubik+Mono+One" rel="stylesheet">
	<link href="css.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/mobile-detect/1.3.6/mobile-detect.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/85/three.min.js"></script>
	<script src="js/gsvPano.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js"></script>
	<script src="fonts/Minion_Pro_normal_400.font.js"></script>
	<script src="fonts/Rubik_Mono_One_normal_400.font.js"></script>
	<script src="js/svg-morpheus.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/svg-injector/1.1.3/svg-injector.min.js"></script>
</head>
<body class="no-auto <?php if ($master) echo 'master'; else if ($slave) echo 'slave'; ?>">
	<svg><filter id="blur_0"><feGaussianBlur stdDeviation="0" /></filter><filter id="blur_1"><feGaussianBlur stdDeviation="0.4" /></filter><filter id="blur_2"><feGaussianBlur stdDeviation="0.8" /></filter><filter id="blur_3"><feGaussianBlur stdDeviation="1.2" /></filter><filter id="blur_4"><feGaussianBlur stdDeviation="1.6" /></filter><filter id="blur_5"><feGaussianBlur stdDeviation="2" /></filter><filter id="blur_6"><feGaussianBlur stdDeviation="2.4" /></filter><filter id="blur_7"><feGaussianBlur stdDeviation="2.8" /></filter><filter id="blur_8"><feGaussianBlur stdDeviation="3.2" /></filter><filter id="blur_9"><feGaussianBlur stdDeviation="3.6" /></filter><filter id="blur_10"><feGaussianBlur stdDeviation="4" /></filter><filter id="blur_11"><feGaussianBlur stdDeviation="4.4" /></filter><filter id="blur_12"><feGaussianBlur stdDeviation="4.8" /></filter><filter id="blur_13"><feGaussianBlur stdDeviation="5.2" /></filter><filter id="blur_14"><feGaussianBlur stdDeviation="5.6" /></filter><filter id="blur_15"><feGaussianBlur stdDeviation="6" /></filter><filter id="blur_16"><feGaussianBlur stdDeviation="6.4" /></filter><filter id="blur_17"><feGaussianBlur stdDeviation="6.8" /></filter><filter id="blur_18"><feGaussianBlur stdDeviation="7.2" /></filter><filter id="blur_19"><feGaussianBlur stdDeviation="7.6" /></filter><filter id="blur_20"><feGaussianBlur stdDeviation="8" /></filter><filter id="blur_21"><feGaussianBlur stdDeviation="8.4" /></filter><filter id="blur_22"><feGaussianBlur stdDeviation="8.8" /></filter><filter id="blur_23"><feGaussianBlur stdDeviation="9.2" /></filter><filter id="blur_24"><feGaussianBlur stdDeviation="9.6" /></filter><filter id="blur_25"><feGaussianBlur stdDeviation="10" /></filter><filter id="blur_26"><feGaussianBlur stdDeviation="10.4" /></filter><filter id="blur_27"><feGaussianBlur stdDeviation="10.8" /></filter><filter id="blur_28"><feGaussianBlur stdDeviation="11.2" /></filter><filter id="blur_29"><feGaussianBlur stdDeviation="11.6" /></filter><filter id="blur_30"><feGaussianBlur stdDeviation="12" /></filter><filter id="blur_31"><feGaussianBlur stdDeviation="12.4" /></filter><filter id="blur_32"><feGaussianBlur stdDeviation="12.8" /></filter><filter id="blur_33"><feGaussianBlur stdDeviation="13.2" /></filter><filter id="blur_34"><feGaussianBlur stdDeviation="13.6" /></filter><filter id="blur_35"><feGaussianBlur stdDeviation="14" /></filter><filter id="blur_36"><feGaussianBlur stdDeviation="14.4" /></filter><filter id="blur_37"><feGaussianBlur stdDeviation="14.8" /></filter><filter id="blur_38"><feGaussianBlur stdDeviation="15.2" /></filter><filter id="blur_39"><feGaussianBlur stdDeviation="15.6" /></filter><filter id="blur_40"><feGaussianBlur stdDeviation="16" /></filter><filter id="blur_41"><feGaussianBlur stdDeviation="16.4" /></filter><filter id="blur_42"><feGaussianBlur stdDeviation="16.8" /></filter><filter id="blur_43"><feGaussianBlur stdDeviation="17.2" /></filter><filter id="blur_44"><feGaussianBlur stdDeviation="17.6" /></filter><filter id="blur_45"><feGaussianBlur stdDeviation="18" /></filter><filter id="blur_46"><feGaussianBlur stdDeviation="18.4" /></filter><filter id="blur_47"><feGaussianBlur stdDeviation="18.8" /></filter><filter id="blur_48"><feGaussianBlur stdDeviation="19.2" /></filter><filter id="blur_49"><feGaussianBlur stdDeviation="19.6" /></filter><filter id="blur_50"><feGaussianBlur stdDeviation="20" /></filter><filter id="blur_51"><feGaussianBlur stdDeviation="20.4" /></filter><filter id="blur_52"><feGaussianBlur stdDeviation="20.8" /></filter><filter id="blur_53"><feGaussianBlur stdDeviation="21.2" /></filter><filter id="blur_54"><feGaussianBlur stdDeviation="21.6" /></filter><filter id="blur_55"><feGaussianBlur stdDeviation="22" /></filter><filter id="blur_56"><feGaussianBlur stdDeviation="22.4" /></filter><filter id="blur_57"><feGaussianBlur stdDeviation="22.8" /></filter><filter id="blur_58"><feGaussianBlur stdDeviation="23.2" /></filter><filter id="blur_59"><feGaussianBlur stdDeviation="23.6" /></filter><filter id="blur_60"><feGaussianBlur stdDeviation="24" /></filter><filter id="blur_61"><feGaussianBlur stdDeviation="24.4" /></filter><filter id="blur_62"><feGaussianBlur stdDeviation="24.8" /></filter><filter id="blur_63"><feGaussianBlur stdDeviation="25.2" /></filter><filter id="blur_64"><feGaussianBlur stdDeviation="25.6" /></filter><filter id="blur_65"><feGaussianBlur stdDeviation="26" /></filter><filter id="blur_66"><feGaussianBlur stdDeviation="26.4" /></filter><filter id="blur_67"><feGaussianBlur stdDeviation="26.8" /></filter><filter id="blur_68"><feGaussianBlur stdDeviation="27.2" /></filter><filter id="blur_69"><feGaussianBlur stdDeviation="27.6" /></filter><filter id="blur_70"><feGaussianBlur stdDeviation="28" /></filter><filter id="blur_71"><feGaussianBlur stdDeviation="28.4" /></filter><filter id="blur_72"><feGaussianBlur stdDeviation="28.8" /></filter><filter id="blur_73"><feGaussianBlur stdDeviation="29.2" /></filter><filter id="blur_74"><feGaussianBlur stdDeviation="29.6" /></filter><filter id="blur_75"><feGaussianBlur stdDeviation="30" /></filter><filter id="blur_76"><feGaussianBlur stdDeviation="30.4" /></filter><filter id="blur_77"><feGaussianBlur stdDeviation="30.8" /></filter><filter id="blur_78"><feGaussianBlur stdDeviation="31.2" /></filter><filter id="blur_79"><feGaussianBlur stdDeviation="31.6" /></filter><filter id="blur_80"><feGaussianBlur stdDeviation="32" /></filter><filter id="blur_81"><feGaussianBlur stdDeviation="32.4" /></filter><filter id="blur_82"><feGaussianBlur stdDeviation="32.8" /></filter><filter id="blur_83"><feGaussianBlur stdDeviation="33.2" /></filter><filter id="blur_84"><feGaussianBlur stdDeviation="33.6" /></filter><filter id="blur_85"><feGaussianBlur stdDeviation="34" /></filter><filter id="blur_86"><feGaussianBlur stdDeviation="34.4" /></filter><filter id="blur_87"><feGaussianBlur stdDeviation="34.8" /></filter><filter id="blur_88"><feGaussianBlur stdDeviation="35.2" /></filter><filter id="blur_89"><feGaussianBlur stdDeviation="35.6" /></filter><filter id="blur_90"><feGaussianBlur stdDeviation="36" /></filter><filter id="blur_91"><feGaussianBlur stdDeviation="36.4" /></filter><filter id="blur_92"><feGaussianBlur stdDeviation="36.8" /></filter><filter id="blur_93"><feGaussianBlur stdDeviation="37.2" /></filter><filter id="blur_94"><feGaussianBlur stdDeviation="37.6" /></filter><filter id="blur_95"><feGaussianBlur stdDeviation="38" /></filter><filter id="blur_96"><feGaussianBlur stdDeviation="38.4" /></filter><filter id="blur_97"><feGaussianBlur stdDeviation="38.8" /></filter><filter id="blur_98"><feGaussianBlur stdDeviation="39.2" /></filter><filter id="blur_99"><feGaussianBlur stdDeviation="39.6" /></filter><filter id="blur_100"><feGaussianBlur stdDeviation="40" /></filter></svg>
	<div class="persp">
		<div id="map"></div>
	</div>
	<div class="persp">
		<div id="gradient"></div>
		<div class="env"></div>
	</div>
	<div class="street"></div>
	<div class="marker">
		<div class="marker-desc"></div>
		<div class="marker-name"></div>
		<i class="fa fa-map-marker"></i>
	</div>
	<?php if (!$master && !$slave) { ?>
	<header>
		<div class="left"><a href="http://www.sl.nsw.gov.au/" class="m-l"><img src="img/n_l1m.gif"/></a><a href="http://www.sl.nsw.gov.au/"><img src="img/n_l1.gif"/></a><a href="http://dxlab.sl.nsw.gov.au/?utm_source=muru_view"><img src="img/n_l2.gif"/></a><a href="http://www.wearesandpit.com/?utm_source=muru_view"><img src="img/n_l3.gif"/></a></div>
		<h1>MURU VIEW</h1>
		<a href="#" class="m-l menu-button"><i class="fa fa-bars menu-button"></i></a>
		<ul class="right menu"><li><a href="#" data-target="about">ABOUT</a></li><li><a href="#" data-target="contact">CONTACT</a></li><li><a href="#" data-target="contribute">CONTRIBUTE</a></li></ul>
		<i class="fa fa-angle-down focus"></i>
	</header>
	<div class="back-button"><i class="fa fa-angle-left"></i> Back</div>
	<?php /*<div class="warning">Visitors should be aware that this website may contain images or documentation relating to aboriginal and torres strait islander people who are deceased.</div>*/ ?>
	<div class="scroller">
		<img src="img/scroll-icons.png"/>
	</div>
	<div class="dialog warning">
		<i class="fa fa-times close-button"></i>
		<div class="dialog-in">
			<h2>Special Care Notice</h2>
			<i>About the Aboriginal place names and meanings</i>
			<p>This website is not intended to be an authoritative source for Indigenous Languages and placenames in Australia. The language lists available from the State Library of New South Wales were recorded historically by many individuals — both amateurs and professionals — who documented Indigenous words, placenames and meanings. This includes records from surveyors and public officials.</p>
			<p>Visitors to this website should be aware that the language documentation may not reflect current understandings of the use of some languages. In addition, some historic lists may also record words and meanings inaccurately.</p>
			<p>This website presents information drawn from the Library’s Royal Anthropological Society of Australasia collection regarding ‘Aboriginal Place Names’, 1899 – 1903, 1921-1926.<br/>
				We are presenting data from this collection to encourage discussion. We welcome feedback from Aboriginal communities and users who may have knowledge and information on place names and meanings.</p>
				<p>Users are warned that there may be words and descriptions which may be considered sensitive and/or offensive in today's contexts.</p>
			</div>
		</div>
		<div id="dialog-about" class="dialog closed">
			<i class="fa fa-times close-button"></i>
			<div class="dialog-in">
				<p>Muru View (Muru – meaning path in Darug) is an interactive data visualisation drawing from the State Library of New South Wales Indigenous language collections. The data used in the interactive is over 120 years old, and is drawn from the survey forms collected by the Royal Anthropological Society of Australasia. We open this historic data to encourage dialogue and discussion around the words and meanings that have been recorded.</p>
				<p>Created in collaboration with creative studio, Sandpit, Muru View dynamically uses data to display locations around New South Wales incorporating their Indigenous name and meaning that were recorded at that time, all using the Google Maps API in a way never done before. The result is an interactive online experience and a projected installation at the State Library of New South Wales itself coinciding with NAIDOC week 2017 in the first week of July.</p>
				<p>The 2017 NAIDOC theme ‘Our Languages Matter’ focuses on the importance, resilience and richness of Aboriginal and Torres Strait Islander languages. This project seeks to increase public awareness of these historic Indigenous language archives and cultural history using cutting edge technology and beautiful design.</p>
				<p>For more about the <a href="http://dxlab.sl.nsw.gov.au/making-muruview">making of Muru View</a> visit the DX Lab website.</p>
			</div>
		</div>
		<div id="dialog-contribute" class="dialog closed">
			<i class="fa fa-times close-button"></i>
			<div class="dialog-in">
				<p>This project draws 360˚ images from Google Streetview to display place names in their correct locations. Some of these locations are in areas not yet photographed by Google. If you would like to contribute to this project and take your own 360˚ images please get in touch and we’ll let you know where we in NSW we could use your help!</p>
				<p>Please email us at <a href="mailto:dxlab@sl.nsw.gov.au">dxlab@sl.nsw.gov.au</a></p>
				<p>The words, placenames and meanings that are used in this project are drawn from historic sources, and were recorded by non-Aboriginal people about Aboriginal languages. Some of the words and meanings may have been misinterpreted when originally recorded, and could be inaccurate. If you would like to provide more information on the words, placenames and meanings please contact us. We encourage Aboriginal people and communities to get in touch.</p>
				<p>Please email the Indigenous Services Team at <a href="mailto:info.koori@sl.nsw.gov.au">info.koori@sl.nsw.gov.au</a></p>
			</div>
		</div>
		<div id="dialog-contact" class="dialog closed">
			<i class="fa fa-times close-button"></i>
			<div class="dialog-in">
				<p>If you have any queries or feedback about this project please email us at <a href="mailto:info.koori@sl.nsw.gov.au">info.koori@sl.nsw.gov.au</a> or <a href="mailto:dxlab@sl.nsw.gov.au">dxlab@sl.nsw.gov.au</a></p>
				<p>For any media enquiries please contact <a href="mailto:media.library@sl.nsw.gov.au">media.library@sl.nsw.gov.au</a></p>
			</div>
		</div>
		<?php } ?>
		<script>
		window.master=<?php echo json_encode($master); ?>;
		window.slave=<?php echo json_encode($slave); ?>;
		window.loaded=false;
		window.text={};
		var x=new Date();
		window.appStart=x.getTime();



		window.unfocusFunction=function() {
			if (!window.md.mobile()) {
				$(document.body).addClass('unfocus');
			}
		}
		window.unfocusTimer=setTimeout(window.unfocusFunction,4000);

		if (!slave && !master) {
			$(function() {
				$(document.body)
				.on('click','.close-button',function() {
					$(this).parent().addClass('closed');
				}).on('click','.menu a',function() {
					$('.dialog').addClass('closed');
					$(document.body).removeClass('show-menu');
					$('#dialog-'+$(this).data('target')).removeClass('closed');
				}).on('click hover','.menu-button',function() {
					$(document.body).toggleClass('show-menu');
					return false;
				})
				.on('mousemove mouseover mouseout blur touch touchmove touchend','header',function() {
					if (window.unfocusTimer) clearTimeout(window.unfocusTimer);
					$(document.body).removeClass('unfocus');
					window.unfocusTimer=setTimeout(window.unfocusFunction,4000);
				});
			});
		}


		$(function() {
			var lastLatLng={};
			var lastPlace=false;
			var fov = 90,
			texture_placeholder,
			isUserInteracting = false,
			onMouseDownMouseX = 0, onMouseDownMouseY = 0,
			lon = 0, onMouseDownLon = 0,
			lat = 0, onMouseDownLat = 0,
			phi = 0, theta = 0;
			lat = 15;
			var defaultLat=lat;
			var container=$('.street')[0];
			var runStreetTimer=false;
			var gmapsPanoService=false;
			window.md = new MobileDetect(window.navigator.userAgent);

			var SlaveApp=function() {
				this.init();
			}
			SlaveApp.prototype={
				init:function() {
					if (!window.loaded) {
						return setTimeout($.proxy(this.init,this),200);
					}
					lastPlace=this.randomPlace();
					this.newStreet();
				},
				masterSetPlace:function(place) {
					runMarker(place);
				},
				masterRunStreet:function() {
					runStreet();
				},
				newStreet:function() {
					var lat=lastPlace.lat;
					var lng=lastPlace.lng;
					var latlng={'lat':lat,'lng':lng};
					lastLatLng=latlng;
					setText();
					runStreet();
				},
				randomPlace:function() {
					return window.places[Math.floor(Math.random()*window.places.length)];
				},
				onError:function() {
					lastPlace=this.randomPlace();
					this.newStreet();
				}
			}
			var PlacesApp=function(container) {
				this.allowAutoScroll=false;
				if (window.md.mobile()) {
					this.perView=6;
				} else if (window.md.tablet()) {
					this.perView=7;
				} else {
					this.perView=8;
				}
				this.hSpaceMin=10;
				this.defaultPlaceWidth=600;
				this.speed=5;
				this.yRange=60;

				this.filled=0;
				this.zSpace=100/(this.perView+2);
				this.container=container;
				this.virtualPosition=0;
				this.touchPosition=0;
				this.autoScrollTimer=false;
				this.masterControlStep=0;
				this.init();
			}

			PlacesApp.prototype={
				init:function() {
					this.initBindings();
					this.firstFill();
					this.refresh();
					if (master) {
						this.initiateMasterControl();
					}
				},
				initBindings:function() {
					var _this=this;
					$(window).on('mousewheel DOMMouseScroll', function (e) {
						if (!$(e.target).closest('.dialog').length) {
							// e.preventDefault();
							_this.onAutoOverride();
							var delta = (function () {
								var delta = (e.type === 'DOMMouseScroll' ?
									e.originalEvent.detail * -40 :
									e.originalEvent.wheelDelta);
								return delta;
							}());
							delta=delta*2.5;
							_this.virtualPosition-=delta;
							_this.refresh();
							e.stopPropagation();
						}
					});

					$(document).bind('touchstart', function(e) {
						if (!$(e.target).closest('.dialog').length) {
							_this.onAutoOverride();
							_this.touchPosition = e.originalEvent.touches[0].clientY;
						}
					});

					$(document).bind('touchmove', function(e) {
						if (!$(e.target).closest('.dialog').length) {
							e.preventDefault();
							_this.onAutoOverride();
							var te = e.originalEvent.changedTouches[0].clientY;
							var delta=_this.touchPosition-te;
							_this.touchPosition=te;
							delta=delta*10;
							// delta=delta*20;
							_this.virtualPosition-=delta;
							_this.refresh();
							e.stopPropagation();
						}
					});
				},
				onAutoOverride:function() {
					var _this=this;
					this.allowAutoScroll=false;
					$(document.body).addClass('no-auto');
					if (this.autoScrollTimer) clearTimeout(this.autoScrollTimer);
					this.autoScrollTimer=setTimeout(function() {
						_this.allowAutoScroll=true;
						$(document.body).removeClass('no-auto');
					},3000);
				},
				firstFill:function() {
					if (typeof window.places[this.filled] != 'undefined') {
						this.appendPlace(this.filled);
						this.filled++;
						if (this.filled<=this.perView) {
							setTimeout($.proxy(this.firstFill,this),60);
						} else {
							this.loaded=true;
							this.refresh();
							this.allowAutoScroll=true;
							$(document.body).removeClass('no-auto')
						}
					}
				},
				drop:function(place,pos) {
					var key=place.key;
					place.retire();
					if (pos=='bottom') {
						nKey=key+this.perView;
						if (nKey>=(window.places.length-1)) nKey=nKey-window.places.length-1;
						if (nKey<0) nKey=(window.places.length)+nKey;
						return this.appendPlace(nKey);
					}
					nKey=key-(this.perView);
					if (nKey<0) nKey=(window.places.length)+nKey;
					return this.prependPlace(nKey);
				},
				prependPlace:function(i) {
					var currentPlace=window.places[i];
					if (currentPlace.inUse) return;
					var z=(100-(100/this.perView));
					var w=this.defaultPlaceWidth;
					var x=Math.random()*100;
					var fw=this.container.width();
					var fwb=fw/100;
					var lastId=i+1;
					// if (lastId>=window.places.length-1) lastId=lastId-(window.places.length);
					// if (lastId<0) lastId=(window.places.length)+lastId;
					// var lastPlace=window.places[lastId];
					// if (lastPlace.inUse) {
					// 	w=lastPlace.content.width();
					// 	var badX=lastPlace.content.data('x');
					// 	var dist=0;
					// 	var iterate=0;
					// 	if (!this.loaded) z=lastPlace.content.data('z')+this.zSpace;
					// 	while (dist<this.hSpaceMin) {
					// 		x=Math.random()*100;
					// 		dist=Math.abs(badX-x);
					// 		iterate++;
					// 		if (iterate>100) break;
					// 	}
					// } else if (!this.loaded) z=0;


					var lastEl=this.container.find('> .text:first');
					if (lastEl.length) {
						var lastPlace=lastEl.data('place');
						if (lastPlace) {
							w=lastEl.width();
							var badX=lastEl.data('x');
							var dist=0;
							var iterate=0;
							z=lastEl.data('z-current')+this.zSpace;
							while (dist<this.hSpaceMin) {
								x=Math.random()*100;
								dist=Math.abs(badX-x);
								iterate++;
								if (iterate>100) break;
							}
						}
					} else if (!this.loaded) z=0;

					var y=(Math.random()-0.5)*this.yRange;

					if (z<0) z=0;
					if (z>100) z=100;
					if (x<5) x=5;
					if (x>95) x=95;
					currentPlace
					.prependTo(this.container)
					.data('x',x)
					.data('z',z)
					.data('z-current',z)
					.data('z-delta',this.virtualPosition)
					.data('y',y)
					.css({'left':x+'%','top':z+'%'});
					this.refresh();
				},
				appendPlace:function(i) {
					var currentPlace=window.places[i];
					if (currentPlace.inUse) return;
					var z=(100/this.perView);
					var w=this.defaultPlaceWidth;
					var x=Math.random()*100;
					var fw=this.container.width();
					var fwb=fw/100;
					var lastId=i-1;

					// if (lastId<0) lastId=window.places.length+lastId;
					// var lastPlace=window.places[lastId];

					var lastEl=this.container.find('> .text:last');
					if (lastEl.length) {
						var lastPlace=lastEl.data('place');
						if (lastPlace) {
							w=lastEl.width();
							var badX=lastEl.data('x');
							var dist=0;
							var iterate=0;
							z=lastEl.data('z-current')-this.zSpace;
							while (dist<this.hSpaceMin) {
								x=Math.random()*100;
								dist=Math.abs(badX-x);
								iterate++;
								if (iterate>100) break;
							}
						}
					} else if (!this.loaded) z=100;


					var y=(Math.random()-0.5)*this.yRange;

					if (z<0) z=0;
					if (z>100) z=100;
					if (x<5) x=5;
					if (x>95) x=95;
					currentPlace
					.appendTo(this.container)
					.data('x',x)
					.data('z',z)
					.data('z-current',z)
					.data('z-delta',this.virtualPosition)
					.data('y',y)
					.css({'left':x+'%','top':z+'%'});
					this.refresh();
				},
				refresh:function() {
					var _this=this;
					if (hasMapping || inStreet) return;
					var wh=$(window).height();
					this.container.find('.text').each(function() {
						var oset=$(this).data('z');
						var y=$(this).data('y');
						var delta=$(this).data('z-delta');
						var nperc=(((_this.virtualPosition-delta)/wh)*_this.speed)+oset;
						if (nperc>100) {
							window.app.drop($(this).data('place'),'bottom');
							return;
						} else if (nperc<0) {
							window.app.drop($(this).data('place'),'top');
							return;
						}
						var blur=0;
						var scale=1;
						var opacity=1;

						if (nperc<=60) {
							blur=(1-(nperc/60))*50;
							if (nperc<30) {
								opacity=1-((30-nperc)/20);
							}
						} else if (nperc>=85) {
							blur=((nperc-85))*5;
							scale=1+(nperc-85)*0.02;
							opacity=1-(nperc-85)/10;
						}
						var tr='rotateX(-70deg) scale('+scale+') translate3D(-50%,'+y+'px,-10px)';
						// console.log(tr);
						$(this).data({
							'z-current':nperc,
						})
						.css({
							'top':nperc+'%',
							'text-shadow': '0 0 '+blur+'px #FFF',
							'transform':tr,
							'opacity':opacity
						});
						if ($(this).data('place')) {
							$(this).find('.name').css({
								'text-shadow': '0 0 '+blur+'px '+$(this).data('place').color,
							});
						}
					});
},
initiateMasterControl:function() {
	var _this=this;
	_this.slave=$(window.top.document).find('.r')[0].contentWindow;
	this.masterControlInterval=setInterval(function() {
		switch(_this.masterControlStep) {
			case 2:
			var sel=_this.container.find('.text');
			if (sel.length) {
				sel=$(sel[3]);
				var place=sel.data('place');
				runMarker(place);
				_this.allowAutoScroll=false;
				_this.slave.app.masterSetPlace(place);
			}
			break;
			case 3:
			_this.slave.app.masterRunStreet();
			break;
			case 4:
			var d=new Date();
			var elapsed=d.getTime()-window.appStart;
			if (elapsed>1800000) location.reload(); //half-hour refresh left side
			_this.allowAutoScroll=true;
			$(document.body).removeClass('in-street mapping');
			_this.masterControlStep=-1;
			break;
		}
		_this.masterControlStep++;
	},10000)
}
}

var Place=function(iid,name,alt,lat,lng) {
	this.key=iid;
	this.id='place_'+iid;
	this.name=name;
	this.alt=alt;
	this.lat=lat;
	this.lng=lng;
	this.color=getRandomPastelColor();
	this.content=false;
	this.width1=0;
	this.width2=0;
	this.inUse=false;
}
Place.prototype={
	generateContent:function(cont,plc) {
		var pastel=this.color;
		var len=this.alt.length;
		var scale=1;
		if (len>60) scale=3;
		else if (len>30) scale=2;
		var placeContent=$('<div class="text"><div class="wrap"><div class="name">'+this.name+'</div><div class="meaning scale-'+scale+'">'+this.alt+'</div></div></div>');
		if (plc=='pre') placeContent.prependTo(cont); else placeContent.appendTo(cont);
		placeContent.data({
			place:this,
		});
		this.content=placeContent;
		return placeContent;
	},
	prependTo:function(container) {
		this.inUse=true;
		return this.generateContent(container,'pre');
	},
	appendTo:function(container) {
		this.inUse=true;
		return this.generateContent(container,'pos');
	},
	retire:function() {
		this.content.remove();
		this.inUse=false;
	},
	onOver:function(e) {
		var _this=this;
		if (this.morphTimer) clearTimeout(this.morphTimer);
		if (!this.morphing) {
			this.morphing=true;
			this.content.addClass('morphing');
			this.morph.to(_this.id+'_g2',{},function() {
				_this.morphing=false;
				_this.content.removeClass('morphing');
			});
		}
	},
	onOut:function(e) {
		var _this=this;
		var _this=this;
		if (this.morphTimer) clearTimeout(this.morphTimer);
		this.morphTimer=setTimeout(function() {
			if ($(e.target).is('svg, #myPaper') && !this.morphing) {
				_this.morphing=true;
				_this.content.addClass('morphing');
				_this.morph.to(_this.id+'_g1',{easing:'quart-out'},function() {
					_this.morphing=false;
					_this.content.removeClass('morphing');
				});
			}
		},1200);
	}
}

window.places=[];
<?php foreach($payload as $key=>$val) { ?>
	window.places[<?php echo $key; ?>] = new Place(<?php echo $key; ?>,<?php echo json_encode($val['name']); ?>,<?php echo json_encode($val['meaning']); ?>,<?php echo json_encode((float) $val['lat']); ?>,<?php echo json_encode((float) $val['lng']); ?>);
	<?php } ?>

	if (!slave) {
		if (!master) {
			$('.persp,.marker').on('click',function() {
				if ($(document.body).hasClass('mapping')) {
					runStreet();
				}
			})

			$('.back-button').on('click',function() {
				if ($(document.body).hasClass('in-street')) {
					window.text.sphereMesh.material.map = new THREE.Texture( texture_placeholder ); 
					window.text.sphereMesh.material.map.needsUpdate = true;
					return $(document.body).removeClass('in-street streeting');
				}
				if ($(document.body).hasClass('mapping')) {
					return $(document.body).removeClass('mapping streeting');
				}

			});

			$(document.body).on('click','.text',function() {
				if (runStreetTimer) clearTimeout(runStreetTimer);
				runStreetTimer=setTimeout(runStreet,1800);
				var place=$(this).data('place');
				runMarker(place);
			});

		}
		try {
			var n=window.performance.now();
			var n=window.performance.now();
		} catch (e) {
			var x=new Date();
			var n=x.getTime();			
		}
		window.flowStart=n;
		window.flowLast=n;
		window.flow=function() {
			var last=window.flowLast
			try {
				var n=window.performance.now();
			} catch (e) {
				var x=new Date();
				var n=x.getTime();			
			}
			window.flowLast=n;
			var elapsed=window.flowLast-last;
			window.hasMapping=$(document.body).hasClass('mapping');
			window.inStreet=$(document.body).hasClass('in-street');
			if (window.app && !hasMapping && !inStreet && elapsed<60) {
				if (window.app.allowAutoScroll) {
					window.app.virtualPosition+=elapsed/2;
					window.app.refresh();
				}
			}
			requestAnimationFrame(window.flow);
		}
		window.flow();
	}

	function streetViewErr() {
		if (slave) {
			window.app.onError();
		} else {
			runningStreet=false;
			$(document.body).removeClass('mapping in-street');
		}
	}

	function runMarker(place) {
		$('.marker .marker-name').html(place.name).css({'color':place.color});
		$('.marker .marker-desc').html(place.alt);
		$('.marker i').css({'color':place.color});
		$(document.body).addClass('mapping').removeClass('in-street');
		if (!(window.md.mobile()) && !(window.md.tablet())) $(document.body).addClass('unfocus');
		var lat=parseFloat(place.lat);
		var lng=parseFloat(place.lng);
		var latlng=new google.maps.LatLng({'lat':lat,'lng':lng});
		map.panTo(latlng);
		// panTo(lat,lng);
		// smoothlyAnimatePanTo(map,latlng);
		lastLatLng=latlng;
		lastPlace=place;
		setText();
	}

	var runningStreet=false;
	function runStreet() {
		if (master) return;
		if (runStreetTimer) clearTimeout(runStreetTimer);
		if (!gmapsPanoService) gmapsPanoService= new google.maps.StreetViewService();
		gmapsPanoService.getPanoramaByLocation(lastLatLng, 5000 ,function(data){
			if(data){
				if(data.location){
					if(data.location.latLng){
						try {
							loadPanorama(data.location.latLng);
							return;
						} catch (e) {

						}
					}
				}
			}
			streetViewErr();
		});
		runningStreet=true;
		lat=15;
	}

	function initText() {
		if (master) return;
		var r=$(document.body).innerWidth() / $(document.body).innerHeight();
		window.text={
			scene:new THREE.Scene(),
			camera:new THREE.PerspectiveCamera( fov, r,0.1, 1100 ),
			renderer: new THREE.WebGLRenderer({antialias:true, alpha:true})
		};
		window.text.renderer.shadowMap.enabled=true;
		window.text.renderer.shadowMap.soft = true;
		window.text.renderer.sortObjects = false

		window.text.renderer.setSize( window.innerWidth, window.innerHeight );

		window.text.canvas=$(window.text.renderer.domElement).appendTo(document.body);
		window.text.canvas.addClass('canvasText');

		window.text.camera.position.z = 500;
		window.text.camera.target=new THREE.Vector3( 0, 0, 0 );

		window.text.loader=	new THREE.FontLoader();
		window.text.font=0;
		window.text.font2=0;
		window.text.loader.load( 'font.json', function ( font ) {
			window.text.font=font;
		});
		window.text.loader.load( 'font2.json', function ( font ) {
			window.text.font2=font;
			window.loaded=true;
		});


		var light = new THREE.DirectionalLight(0xbcd5f5,0.9);
		light.position.set(0,800,300);

		var d = 1500;

		window.text.scene.add(light);
		window.text.scene.add(new THREE.AmbientLight(0x333333));
		window.text.scene.add(new THREE.AmbientLight(0x7d7244));

		texture_placeholder=THREE.ImageUtils.loadTexture( 'placeholder.jpg' );

		window.text.sphereMesh = new THREE.Mesh( new THREE.SphereGeometry( 500, 60, 40 ), new THREE.MeshBasicMaterial( {  map:  texture_placeholder } ) );
		window.text.sphereMesh.scale.x = -1;
		window.text.sphereMesh.doubleSided=true;
		window.text.scene.add( window.text.sphereMesh );	

		window.text.mirrorSphereCamera = new THREE.CubeCamera( 0.1, 5000, 512 );
		window.text.mirrorSphereCamera.rotation.y=-1;
		window.text.scene.add(window.text.mirrorSphereCamera);

		container.addEventListener( 'mousedown', onMouseDown, false );
		container.addEventListener( 'mousemove', onMouseMove, false );
		container.addEventListener( 'mouseup', onMouseUp, false );

		window.addEventListener( 'resize', onWindowResized, false );

	}
	initText();
	function loadPanorama( location ) {
		loader = new GSVPANO.PanoLoader( {
			useWebGL: false,
			zoom: 3
		} );
		loader.onSizeChange = function() { 
		};
		loader.onProgress = function( p ) {
		};
		loader.onError = function( message ) {
			runningStreet=false;
			console.log('error',message);
		};
		loader.onPanoramaLoad = function() {
			runningStreet=false;
			if (!this.canvas.length) {
				streetViewErr();
			}
			var source = this.canvas[ 0 ];

			window.text.sphereMesh.material.map = new THREE.Texture( source ); 
			window.text.sphereMesh.material.map.needsUpdate = true;

			$(document.body).addClass('streeting');
			setTimeout(function() {
				$(document.body).removeClass('streeting');
				if (slave || master || hasMapping) {
					$(document.body).addClass('in-street');
					if (!(window.md.mobile()) && !(window.md.tablet())) $(document.body).addClass('unfocus');
					lat=defaultLat;
					isUserInteracting=false;
				}
			},300);
		};
		loader.load( location  );
	}




	function setText() {
		if (master) return;
		var str=lastPlace.alt;
		var str2=lastPlace.name
		var color=lastPlace.color;
		var size1=14;
		if (window.md.tablet()) size1=11;
		if (window.md.mobile()) size1=8;
		var size2=25;
		if (window.md.tablet()) size1=20;
		if (window.md.mobile()) size1=15;
		if (typeof window.text.pivot != 'undefined') {
			window.text.scene.remove(window.text.pivot);
		}


		pivot = new THREE.Object3D();

		var material = new THREE.MeshPhongMaterial({
			color:0xFFFFFF,
			specular: 0xFFF,
			shininess: 0,
			reflectivity:0.2,
			transparent: false,
		});

		str=splitString(str);
		var yOff=size1+1;
		var strlen=str.length;
		for (var i in str) {
			var part=str[i];
			var geometry = new THREE.TextGeometry( part, {
				font: window.text.font2,
				size: size1,
				height: 3,
				curveSegments: 12,
				bevelEnabled: false,
				bevelThickness: 0.5,
				bevelSize: 0.5,
				bevelSegments: 2
			} );


			var text = new THREE.Mesh( geometry, material );
			geometry.computeBoundingBox();
			var textWidth = geometry.boundingBox.max.x - geometry.boundingBox.min.x;
			text.position.set( -0.5 * textWidth, ((strlen-i-1)*yOff)+30, 1.5 );
			window.text.scene.add( text );
			pivot.add( text );
		}





		var material2 = new THREE.MeshPhongMaterial({
			color:shadeBlendConvert(-0.4,color),
			specular: 0xFFFFFF,
			shininess: 0,
			reflectivity:0.3,
			transparent: false,
			fog:false,
			emissive:shadeBlendConvert(-0.5,color),
			envMap: window.text.mirrorSphereCamera.renderTarget
		});

		str2=splitString(str2,3);
		yOff=size2+3;
		strlen=str2.length;
		for (var i in str2) {
			var part=str2[i];
			var geometry = new THREE.TextGeometry( part, {
				font: window.text.font,
				size: size2,
				height: 8,
				curveSegments: 12,
				bevelEnabled: true,
				bevelThickness: 0.5,
				bevelSize: 0.5,
				bevelSegments: 2
			} );


			var text2 = new THREE.Mesh( geometry, material2 );
			geometry.computeBoundingBox();
			var textWidth2 = geometry.boundingBox.max.x - geometry.boundingBox.min.x;
			text2.position.set( -0.5 * textWidth2, -i*yOff, 0 );
			window.text.scene.add( text2 );
			pivot.add( text2 );
		}


		pivot.rotation.y =1.5;
		window.text.pivot=pivot;
		window.text.scene.add( pivot );
		onWindowResized(null);
	}


	function onWindowResized( event ) {
		window.text.camera.aspect = window.innerWidth / window.innerHeight;
		window.text.camera.updateProjectionMatrix();

		window.text.renderer.setSize( window.innerWidth, window.innerHeight );
	}

	function onMouseDown( event ) {
		isUserInteracting = true;
		onPointerDownPointerX = event.clientX;
		onPointerDownPointerY = event.clientY;
		onPointerDownLon = lon;
		onPointerDownLat = lat;
	}

	function onMouseMove( event ) {
		if ( isUserInteracting ) {
			lon = ( event.clientX - onPointerDownPointerX ) * 0.1 + onPointerDownLon;
			lat = ( event.clientY - onPointerDownPointerY ) * 0.1 + onPointerDownLat;
		}
	}

	function onTouchStart(e) {
		isUserInteracting=true;
		onPointerDownPointerX =  e.touches[0].clientY;
		onPointerDownPointerY =  e.touches[0].clientX;
		onPointerDownLon = lon;
		onPointerDownLat = lat;
	}

	function onTouchMove(e) {
		event.preventDefault();
		if ( isUserInteracting ) {
			lon = ( e.touches[0].clientX - onPointerDownPointerX ) * 0.3 + onPointerDownLon;
			lat = ( e.touches[0].clientY - onPointerDownPointerY ) * 0.3 + onPointerDownLat;
		}
	}

	function onTouchEnd(e) {
		isUserInteracting = false;
	}

	function onMouseUp( event ) {
		isUserInteracting = false;
	}

	function renderTextInterval() {
		requestAnimationFrame( renderTextInterval );
		if ($(document.body).hasClass('in-street')) {

			window.text.mirrorSphereCamera.updateCubeMap( window.text.renderer, window.text.scene );
			if( !isUserInteracting ) {
				lon += .15;
			}


			lat = Math.max( - 90, Math.min( 90, lat ) );
			phi = ( 90 - lat ) * Math.PI / 180;
			theta = lon * Math.PI / 180;

			window.text.camera.position.x = 200 * Math.sin( phi ) * Math.cos( theta );
			window.text.camera.position.y = 200 * Math.cos( phi );
			window.text.camera.position.z = 200 * Math.sin( phi ) * Math.sin( theta );

			window.text.camera.lookAt( window.text.camera.target );
			window.text.renderer.render( window.text.scene, window.text.camera );
		}
	}
	renderTextInterval();

	if (slave) {
		window.app = new SlaveApp();
	} else {
		window.app=new PlacesApp($('.env'));
	}
});

async function initMap() {
	window.map = new google.maps.Map(document.getElementById('map'), {
		zoom: 12,
		center: {lat: -33.856159, lng:151.215256},
		disableDefaultUI: true,
		gestureHandling: 'greedy',
		backgroundColor: 'none',
		styles:gMapStyle
	});
	google.maps.event.addDomListener(window, "resize", function() {
		var center = map.getCenter();
		google.maps.event.trigger(map, "resize");
		map.setCenter(center); 
		google.maps.event.trigger(map, "resize");
	});
}


</script>

<!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDK2GF8-Hb1uJ2Uu22bMba2IbCZYw59JBA&callback=initMap"  type="text/javascript"></script> -->
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBuy3DeHfAbFkldDZjNnn4Tn_y1s5ezqzE&callback=initMap"  type="text/javascript"></script>
</body>
</html>