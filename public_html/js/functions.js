
function hslToHex(h, s, l) {
	h /= 360;
	s /= 100;
	l /= 100;
	var r, g, b;
	if (s === 0) {
		r = g = b = l;
	} else {
		var hue2rgb = function(p, q, t) {
			if (t < 0) t += 1;
			if (t > 1) t -= 1;
			if (t < 1 / 6) return p + (q - p) * 6 * t;
			if (t < 1 / 2) return q;
			if (t < 2 / 3) return p + (q - p) * (2 / 3 - t) * 6;
			return p;
		};
		var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
		var p = 2 * l - q;
		r = hue2rgb(p, q, h + 1 / 3);
		g = hue2rgb(p, q, h);
		b = hue2rgb(p, q, h - 1 / 3);
	}
	var toHex = function(x) {
		var hex = Math.round(x * 255).toString(16);
		return hex.length === 1 ? '0' + hex : hex;
	};
	return '#'+toHex(r)+toHex(g)+toHex(b);
}

function makeSVGEl(tag, attrs) {
	var el = document.createElementNS('http://www.w3.org/2000/svg', tag);
	for (var k in attrs) {
		el.setAttribute(k, attrs[k]);
	}
	return el;
}
var lastPastelColor=-100;
function getRandomPastelColor() {
	var c=Math.random() * 360;
	while (Math.abs(c-lastPastelColor)<30) {
		c=Math.random() * 360;
	}
	var hue = Math.floor(c);
	var pastel = hslToHex( hue ,100,65);
	return pastel;
	lastPastelColor=c;
}
function shadeBlendConvert(p, from, to) {
    if(typeof(p)!="number"||p<-1||p>1||typeof(from)!="string"||(from[0]!='r'&&from[0]!='#')||(typeof(to)!="string"&&typeof(to)!="undefined"))return null; //ErrorCheck
    if(!this.sbcRip)this.sbcRip=function(d){
    	var l=d.length,RGB=new Object();
    	if(l>9){
    		d=d.split(",");
            if(d.length<3||d.length>4)return null;//ErrorCheck
            RGB[0]=i(d[0].slice(4)),RGB[1]=i(d[1]),RGB[2]=i(d[2]),RGB[3]=d[3]?parseFloat(d[3]):-1;
        }else{
            if(l==8||l==6||l<4)return null; //ErrorCheck
            if(l<6)d="#"+d[1]+d[1]+d[2]+d[2]+d[3]+d[3]+(l>4?d[4]+""+d[4]:""); //3 digit
            d=i(d.slice(1),16),RGB[0]=d>>16&255,RGB[1]=d>>8&255,RGB[2]=d&255,RGB[3]=l==9||l==5?r(((d>>24&255)/255)*10000)/10000:-1;
        }
        return RGB;}
        var i=parseInt,r=Math.round,h=from.length>9,h=typeof(to)=="string"?to.length>9?true:to=="c"?!h:false:h,b=p<0,p=b?p*-1:p,to=to&&to!="c"?to:b?"#000000":"#FFFFFF",f=sbcRip(from),t=sbcRip(to);
    if(!f||!t)return null; //ErrorCheck
    if(h)return "rgb("+r((t[0]-f[0])*p+f[0])+","+r((t[1]-f[1])*p+f[1])+","+r((t[2]-f[2])*p+f[2])+(f[3]<0&&t[3]<0?")":","+(f[3]>-1&&t[3]>-1?r(((t[3]-f[3])*p+f[3])*10000)/10000:t[3]<0?f[3]:t[3])+")");
    else return "#"+(0x100000000+(f[3]>-1&&t[3]>-1?r(((t[3]-f[3])*p+f[3])*255):t[3]>-1?r(t[3]*255):f[3]>-1?r(f[3]*255):255)*0x1000000+r((t[0]-f[0])*p+f[0])*0x10000+r((t[1]-f[1])*p+f[1])*0x100+r((t[2]-f[2])*p+f[2])).toString(16).slice(f[3]>-1||t[3]>-1?1:3);
}
function splitString(str,minLength) {
	if (!str) str=[];
	if (!minLength) minLength=30;
	if (str.length<=minLength) return [str];
	var rows=2;
	if (str.length>70) rows=3;
	if (str.length>110) rows=4;
	// if (str.length>150) rows=5;
	var len=Math.ceil(str.length/rows);
	str=str.split(' ');
	var parts=[''];
	var i=0;
	for (var j in str) {
		parts[i]+=(parts[i].length ? ' ' : '')+str[j];
		if (parts[i].length>=len) {
			i++;
			parts[i]='';	
		}
	}
	return parts;
}

var gMapStyle=[
{
	"elementType": "geometry",
	"stylers": [
	{
		"color": "#212121"
	}
	]
},
{
	"elementType": "labels.icon",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#757575"
	}
	]
},
{
	"elementType": "labels.text.stroke",
	"stylers": [
	{
		"color": "#212121"
	}
	]
},
{
	"featureType": "administrative",
	"elementType": "geometry",
	"stylers": [
	{
		"color": "#757575"
	},
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "administrative.country",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#9e9e9e"
	}
	]
},
{
	"featureType": "administrative.land_parcel",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "administrative.locality",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#bdbdbd"
	}
	]
},
{
	"featureType": "administrative.neighborhood",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "administrative.province",
	"elementType": "geometry.fill",
	"stylers": [
	{
		"color": "#000000"
	}
	]
},
{
	"featureType": "poi",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "poi",
	"elementType": "labels.text",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "poi",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#757575"
	}
	]
},
{
	"featureType": "poi.park",
	"elementType": "geometry",
	"stylers": [
	{
		"color": "#181818"
	}
	]
},
{
	"featureType": "poi.park",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#616161"
	}
	]
},
{
	"featureType": "poi.park",
	"elementType": "labels.text.stroke",
	"stylers": [
	{
		"color": "#1b1b1b"
	}
	]
},
{
	"featureType": "road",
	"elementType": "geometry.fill",
	"stylers": [
	{
		"color": "#2c2c2c"
	}
	]
},
{
	"featureType": "road",
	"elementType": "labels",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "road",
	"elementType": "labels.icon",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "road",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#8a8a8a"
	}
	]
},
{
	"featureType": "road.arterial",
	"elementType": "geometry",
	"stylers": [
	{
		"color": "#373737"
	}
	]
},
{
	"featureType": "road.arterial",
	"elementType": "labels",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "road.highway",
	"elementType": "geometry",
	"stylers": [
	{
		"color": "#3c3c3c"
	}
	]
},
{
	"featureType": "road.highway",
	"elementType": "labels",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "road.highway.controlled_access",
	"elementType": "geometry",
	"stylers": [
	{
		"color": "#4e4e4e"
	}
	]
},
{
	"featureType": "road.local",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "road.local",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#616161"
	}
	]
},
{
	"featureType": "transit",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "transit",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#757575"
	}
	]
},
{
	"featureType": "water",
	"elementType": "geometry",
	"stylers": [
	{
		"color": "#000000"
	}
	]
},
{
	"featureType": "water",
	"elementType": "labels.text",
	"stylers": [
	{
		"visibility": "off"
	}
	]
},
{
	"featureType": "water",
	"elementType": "labels.text.fill",
	"stylers": [
	{
		"color": "#3d3d3d"
	}
	]
}
];

if (!window.Uint8ClampedArray && window.Uint8Array && window.ImageData) {
	window.Uint8ClampedArray = function(input,arg1,arg2) {
		var len = 0;
		if (typeof input == "undefined") { }
	else if (!isNaN(parseInt(input.length))) { //an array, yay
		len = input.length;
	}
	else if (input instanceof ArrayBuffer) {
		return new Uint8ClampedArray(new Uint8Array(input,arg1,arg2));
	}
	else {
		len = parseInt(input);
		if (isNaN(len) || len < 0) {
			throw new RangeError();
		}
		input = undefined;
	}
	len = Math.ceil(len / 4);
	
	if (len == 0) len = 1;
	
	var array = document.createElement("canvas")
	.getContext("2d")
	.createImageData(len, 1)
	.data;
	
	if (typeof input != "undefined") {
		for (var i=0;i<input.length;i++) {
			array[i] = input[i];
		}
	}
	try {
		Object.defineProperty(array,"buffer",{
			get: function() {
				return new Uint8Array(this).buffer;
			}
		});
	} catch(e) { try {
		array.__defineGetter__("buffer",function() {
			return new Uint8Array(this).buffer;
		});
	} catch(e) {} }
	return array;
}
}










/**
 * Handy functions to project lat/lng to pixel
 * Extracted from: https://developers.google.com/maps/documentation/javascript/examples/map-coordinates
 **/
function project(latLng) {
    var TILE_SIZE = 256

    var siny = Math.sin(latLng.lat() * Math.PI / 180)

    // Truncating to 0.9999 effectively limits latitude to 89.189. This is
    // about a third of a tile past the edge of the world tile.
    siny = Math.min(Math.max(siny, -0.9999), 0.9999)

    return new google.maps.Point(
        TILE_SIZE * (0.5 + latLng.lng() / 360),
        TILE_SIZE * (0.5 - Math.log((1 + siny) / (1 - siny)) / (4 * Math.PI)))
}

/**
 * Handy functions to project lat/lng to pixel
 * Extracted from: https://developers.google.com/maps/documentation/javascript/examples/map-coordinates
 **/
function getPixel(latLng, zoom) {
    var scale = 1 << zoom
    var worldCoordinate = project(latLng)
    return new google.maps.Point(
            Math.floor(worldCoordinate.x * scale),
            Math.floor(worldCoordinate.y * scale))
}

/**
 * Given a map, return the map dimension (width and height)
 * in pixels.
 **/
function getMapDimenInPixels(map) {
    var zoom = map.getZoom()
    var bounds = map.getBounds()
    var southWestPixel = getPixel(bounds.getSouthWest(), zoom)
    var northEastPixel = getPixel(bounds.getNorthEast(), zoom)
    return {
        width: Math.abs(southWestPixel.x - northEastPixel.x),
        height: Math.abs(southWestPixel.y - northEastPixel.y)
    }
}

/**
 * Given a map and a destLatLng returns true if calling
 * map.panTo(destLatLng) will be smoothly animated or false
 * otherwise.
 *
 * optionalZoomLevel can be optionally be provided and if so
 * returns true if map.panTo(destLatLng) would be smoothly animated
 * at optionalZoomLevel.
 **/
function willAnimatePanTo(map, destLatLng, optionalZoomLevel) {
    var dimen = getMapDimenInPixels(map)

    var mapCenter = map.getCenter()
    optionalZoomLevel = !!optionalZoomLevel ? optionalZoomLevel : map.getZoom()

    var destPixel = getPixel(destLatLng, optionalZoomLevel)
    var mapPixel = getPixel(mapCenter, optionalZoomLevel)
    var diffX = Math.abs(destPixel.x - mapPixel.x)
    var diffY = Math.abs(destPixel.y - mapPixel.y)

    return diffX < dimen.width && diffY < dimen.height
}

/**
 * Returns the optimal zoom value when animating 
 * the zoom out.
 *
 * The maximum change will be currentZoom - 3.
 * Changing the zoom with a difference greater than 
 * 3 levels will cause the map to "jump" and not
 * smoothly animate.
 *
 * Unfortunately the magical number "3" was empirically
 * determined as we could not find any official docs
 * about it.
 **/
function getOptimalZoomOut(map, latLng, currentZoom) {
    if(willAnimatePanTo(map, latLng, currentZoom - 1)) {
        return currentZoom - 1
    } else if(willAnimatePanTo(map, latLng, currentZoom - 2)) {
        return currentZoom - 2
    } else {
        return currentZoom - 3
    }
}

/**
 * Given a map and a destLatLng, smoothly animates the map center to
 * destLatLng by zooming out until distance (in pixels) between map center
 * and destLatLng are less than map width and height, then panTo to destLatLng
 * and finally animate to restore the initial zoom.
 *
 * optionalAnimationEndCallback can be optionally be provided and if so
 * it will be called when the animation ends
 **/
function smoothlyAnimatePanToWorkarround(map, destLatLng, optionalAnimationEndCallback) {
    var initialZoom = map.getZoom(), listener

    function zoomIn() {
        if(map.getZoom() < initialZoom) {
            map.setZoom(Math.min(map.getZoom() + 3, initialZoom))
        } else {
            google.maps.event.removeListener(listener)

            //here you should (re?)enable only the ui controls that make sense to your app 
            map.setOptions({draggable: true, zoomControl: true, scrollwheel: true, disableDoubleClickZoom: false})

            if(!!optionalAnimationEndCallback) {
                optionalAnimationEndCallback()
            }
        }
    }

    function zoomOut() {
        if(willAnimatePanTo(map, destLatLng)) {
            google.maps.event.removeListener(listener)
            listener = google.maps.event.addListener(map, 'idle', zoomIn)
            map.panTo(destLatLng)
        } else {
            map.setZoom(getOptimalZoomOut(map, destLatLng, map.getZoom()))
        }
    }

    //here you should disable all the ui controls that your app uses
    map.setOptions({draggable: false, zoomControl: false, scrollwheel: false, disableDoubleClickZoom: true})
    map.setZoom(getOptimalZoomOut(map, destLatLng, initialZoom))
    listener = google.maps.event.addListener(map, 'idle', zoomOut)
}

function smoothlyAnimatePanTo(map, destLatLng) {
    if(willAnimatePanTo(map, destLatLng)) {
        map.panTo(destLatLng)
    } else {
        smoothlyAnimatePanToWorkarround(map, destLatLng)
    }
}

var panPath = [];   // An array of points the current panning action will use
var panQueue = [];  // An array of subsequent panTo actions to take
var STEPS = 50;     // The number of steps that each panTo action will undergo

function panTo(newLat, newLng) {
  if (panPath.length > 0) {
    // We are already panning...queue this up for next move
    panQueue.push([newLat, newLng]);
  } else {
    // Lets compute the points we'll use
    panPath.push("LAZY SYNCRONIZED LOCK");  // make length non-zero - 'release' this before calling setTimeout
    var curLat = map.getCenter().lat();
    var curLng = map.getCenter().lng();
    var dLat = (newLat - curLat)/STEPS;
    var dLng = (newLng - curLng)/STEPS;

    for (var i=0; i < STEPS; i++) {
      panPath.push([curLat + dLat * i, curLng + dLng * i]);
    }
    panPath.push([newLat, newLng]);
    panPath.shift();      // LAZY SYNCRONIZED LOCK
    setTimeout(doPan, 20);
  }
}

function doPan() {
  var next = panPath.shift();
  if (next != null) {
    // Continue our current pan action
    map.panTo( new google.maps.LatLng(next[0], next[1]));
    setTimeout(doPan, 20 );
  } else {
    // We are finished with this pan - check if there are any queue'd up locations to pan to 
    var queued = panQueue.shift();
    if (queued != null) {
      panTo(queued[0], queued[1]);
    }
  }
}