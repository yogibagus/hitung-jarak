// calculate-distance js mapbox
// by yogibagus, deckodev.com

var x = document.getElementById("km").value;
var a = document.getElementById("harga").value;
var result = x * a;
document.getElementById("result").value = result;;

function myFunction() {
	document.getElementById("cb1").checked = false;
	document.getElementById("cb2").checked = false;
	document.getElementById("cb3").checked = false;

	var x = document.getElementById("km").value;
	var a = document.getElementById("harga").value;
	var result = x * a;
	document.getElementById("result").value = result;;
}

function getResultOnMap() {
	document.getElementById("cb1").checked = false;
	document.getElementById("cb2").checked = false;
	document.getElementById("cb3").checked = false;
	
	var delayInMilliseconds = 1500;
	setTimeout(function() {

		var get = document.querySelector(".mapbox-directions-component h1").innerHTML;
		var x = get.replace("km", "");
		document.getElementById("km").value = x;

		var a = document.getElementById("harga").value;
		var result = x * a;
		document.getElementById("result").value = result;;
	}, delayInMilliseconds);
}


function btnGetResult() {
	document.getElementById("cb1").checked = false;
	document.getElementById("cb2").checked = false;
	document.getElementById("cb3").checked = false;

	var get = document.querySelector(".mapbox-directions-component h1").innerHTML;
	var x = get.replace("km", "");
	document.getElementById("km").value = x;

	var a = document.getElementById("harga").value;
	var result = x * a;
	document.getElementById("result").value = result;
}


// cb result

function checkbox1(){
	var cb = document.getElementById("cb1");
	var cbval = document.getElementById("cb1").value;
	var res = parseInt(document.getElementById("result").value);
	if (cb.checked == true){
		// one of the var is string so i have to put parseInt before the var
		var result = parseInt(res) + parseInt(cbval);
		document.getElementById("result").value = result;
	}else{
		var result = res -cbval;
		document.getElementById("result").value = result;
	}
}

function checkbox2(){
	var cb = document.getElementById("cb2");
	var cbval = document.getElementById("cb2").value;
	var res = parseInt(document.getElementById("result").value);
	if (cb.checked == true){
		// one of the var is string so i have to put parseInt before the var
		var result = parseInt(res) + parseInt(cbval);
		document.getElementById("result").value = result;
	}else{
		var result = res -cbval;
		document.getElementById("result").value = result;
	}
}

function checkbox3(){
	var cb = document.getElementById("cb3");
	var cbval = document.getElementById("cb3").value;
	var res = parseInt(document.getElementById("result").value);
	if (cb.checked == true){
		// one of the var is string so i have to put parseInt before the var
		var result = parseInt(res) + parseInt(cbval);
		document.getElementById("result").value = result;
	}else{
		var result = res -cbval;
		document.getElementById("result").value = result;
	}
}