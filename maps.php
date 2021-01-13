<?php 
// header( "refresh:60;url=denied.php" );
?>
<!DOCTYPE html>
<!-- A pricing or cost calculator app based on directions distance -->
<!-- Authors: Yogi Bagus -->
<!-- Using Boostrap and Mapbox(mapbox-gl-directions) -->
<!-- www.deckodev.com -->
<html lang="en">
<head>
	<title>Deckodev - Map Directons and Cost Calculator</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://kit.fontawesome.com/a076d05399.js"></script>

	<!-- mapbox js-->
	<script src="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.js"></script>

	<!-- mapbox css -->
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.0.0/mapbox-gl.css" rel="stylesheet" />

	<!-- boostrap css -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="css/style.css">

	<!-- mapbox-gl-directions.css -->
	<link rel="stylesheet" href="css/mapbox-gl-directions.css" type="text/css"/>
	<style>

	#map { width: 100%; height: 595px; border-radius: 7px;}
/*watermark inside*/
.wminside {
  color: rgba(0,0,0,0.070); 
  font-size: 15vw; 
  font-weight: 900; 
  left: 0%; 
  line-height: 200px; 
  overflow: hidden; 
  position: absolute; 
  text-align: center; 
  text-transform: uppercase; 
  top: 40%; 
  white-space: nowrap; 
  width: 100%; 
  z-index: 0;
}

.dark-light {
	background-color :#424a4f;
}
</style>
</head>
<body>
	<div class="wminside">Deckodev</div>
	<!-- start nav -->
	<nav class="navbar navbar-expand-lg navbar-light bg-light ">
		<a class="navbar-brand" href="">
			<img src="img/deckodev-logo.png" width="210px" height="41px" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
				<li class="nav-item active">
					<a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
				</li>
				<li class="nav-item">
					<button class="btn btn-dark btn-sm my-2 my-sm-1" onclick="tes()" id="darkmode">Dark Mode</button>
				</li>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						Dropdown
					</a>
					<div class="dropdown-menu" aria-labelledby="navbarDropdown">
						<a class="dropdown-item" href="#">Action</a>
						<a class="dropdown-item" href="#">Another action</a>
						<div class="dropdown-divider"></div>
						<a class="dropdown-item" href="#">Something else here</a>
					</div>
				</li>
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Disabled</a>
				</li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
				<button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div>
	</nav> <!-- end nav -->


	<!-- main container -->
	<div class="container">
		<br>
		<div class="row">
			<div class="col-lg-8 col-sm-12">
				<button class="btn-primary d-block d-lg-none" data-toggle="collapse" data-target="#collapse">Hide/Show Map</button>
				<div onclick="getResultOnMap()" class="collapse show multi-collapse" id="collapse">
					<div class="card" id="map"></div>	
					<small>*) Pilih <i>destinasi tujuan</i> setelah itu klik tombol <b>hitung</b>.</small>
				</div>
				<br>
			</div>
			<div class="col-lg-4 col-sm-12">
				<div class="card container " id="cost-card" style="padding: 10px 10px;">
					<h4>Cost Calculator</h4>
					<hr>
					<div class="form-row">
						<div class="form-group col-md-6">
							<label for="">Jarak Kilometer</label>
							<input type="number" class="form-control" value="1" id="km" oninput="myFunction()">
						</div>
						<div class="form-group col-md-6">
							<label for="">Harga/Km</label>
							<input type="number" class="form-control" value="1800" id="harga" oninput="myFunction()">
						</div>
					</div>
					<div class="d-flex justify-content-between align-items-center">
						<p>Biaya Tambahan <a href="#" style="font-size: 12px;">Aditional Cost</a></p>
						<p>Nominal <a href="#" class="text-success">+</a></p>
					</div>
					<div class="form-check  d-flex justify-content-between align-items-center">
						<label class="form-check-label">
							<input class=" form-check-input" type="checkbox" id="cb1" value="3000" onclick="checkbox1()">Hujan</label>
							<span class="badge badge-success">+3000</span>
						</div><br>
						<div class="form-check  d-flex justify-content-between align-items-center">
							<label class="form-check-label">
								<input class=" form-check-input" type="checkbox" id="cb2" value="3000" onclick="checkbox2()">Malam Hari</label>
								<span class="badge badge-success">+3000</span>
							</div><br>
							<div class="form-check  d-flex justify-content-between align-items-center">
								<label class="form-check-label">
									<input class=" form-check-input" type="checkbox" id="cb3" value="1000" onclick="checkbox3()">Rush Hour</label>
									<span class="badge badge-success">+1000</span>
								</div>
								<hr>
								<label for="">Result</label>
								<div class="input-group mb-2">
									<div class="input-group-prepend">
										<div class="input-group-text">Rp.</div>
									</div>
									<input type="number" class="form-control"  id="result" >
								</div>
								<button href="#" class="btn btn-primary btn-block" onclick="btnGetResult()">Hitung | Update Result</button>
							</div><br>
							<p><b>Result Terhitung Otomatis.</b> Klik tombol <b>hitung</b> diatas untuk memastikan hitungan benar.</p>
							<a href="#">Butuh bantuan? <b>Contact Admin</b></a>
						</div>
					</div>


				</div> <!-- end of container-->


				<!-- dark mode switch -->
				<script type="text/javascript">
					function tes() {
						var element = document.body;
						element.classList.toggle("bg-dark");
						element.classList.toggle("text-light");
						element.style.transition = "all 1s";

						var a = document.getElementById("cost-card");
						a.classList.toggle("dark-light");
					}

				</script>

				<!-- load mapboc gl direction js -->
				<script src="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-directions/v4.1.0/mapbox-gl-directions.js"></script>
				<!-- load map-config -->
				<script src="js/map-config.js"></script>

				<!-- boostrap js -->
				<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
				<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
				<!-- calculate-distance -->
				<script src="js/calculate-distance.js"></script>
			</body>
			<hr>
			<footer class="text-muted">
				<div class="container">
					<p class="float-right">
						<a href="#">Back to top</a>
					</p>
					<p>Deckodev &copy; 2020 | By Yogi Bagus</p>
				</div>
			</footer>
			</html>
