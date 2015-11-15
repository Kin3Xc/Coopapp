angular.module('coopapp.controllers', ['ionic', 'ngCordova'])
.controller('LoginCtrl',function($scope, $location){

	//Defino el modelo a utilizar, en este caso un sensillo login
	//con los datos de usuario y clave
	$scope.login = {
		usuario: '',
		clave: ''
	};

	//Funcion para ingresar, se ejecuta al hacer clic sobre el boton Ingresar
	$scope.ingresar = function(){
		//Aquí validaria los datos que ingresa el usuario
		if ($scope.login.usuario != "" && $scope.login.clave != "") {
			if ($scope.login.usuario === "root") {
				if ($scope.login.clave === "root") {
					// alert('Bienvenido al sistema');
					$location.url("/home");
				}else{
					alert('Su clave es incorrecta\nPor favor vuelva a intentarlo');
					$scope.login.clave = "";
				}
			}else{
				alert('El usuario ingresado no existe\nPor favor vuelva a intentarlo');
				$scope.login.usuario = "";
			}
		}else{
			alert('Existen campos vacios, por favor verifique\nIngrese todos los datos.');
		}
	};
})
.controller('HomeCtrl',function($scope,$location,$ionicHistory){

	$scope.verMapa = function(){
		$location.url("/mapa");
	};
	$scope.verlistAlumno = function(){
		$location.url("/listaalumnos");
	};
	$scope.verNotification = function(){
		$location.url('/notification');
	};
	$scope.verEstadoRuta = function(){
		$location.url('/estadoRuta');
	};
	$scope.myGoBack = function() {
		$ionicHistory.goBack();
	};
})

.factory('mapa', function(){
	service = {};

	service.render = function(lat, long){
		var point1 = new google.maps.LatLng(4.666331, -74.125977);
		var point2 = new google.maps.LatLng(4.666277, -74.120199);
		var point3 = new google.maps.LatLng(4.658499, -74.115711);
		// set the origin and destination
		var org = new google.maps.LatLng ( 4.666359, -74.133825);
		var finalCo = new google.maps.LatLng(4.668102, -74.103561);

		var wps = [{ location: point1 }, { location: point2 }, {location: point3}];

		var location = new google.maps.LatLng(lat, long);
		var option = {
			zoom: 14,
			center: location,
			mapTypeId: google.maps.MapTypeId.ROADMAP
			// origin: org,
			// destination: dest,
			// waypoints: wps,
			// travelMode: google.maps.DirectionsTravelMode.DRIVING
		};

		directionsDisplay = new google.maps.DirectionsRenderer();

		map = new google.maps.Map(document.getElementById('map'), option);

		directionsDisplay.setMap(map);

		marker = new google.maps.Marker({
			map: map,
			position: location,
			title: 'Mi ubicación'
		});

	}
	return service;
})

//Controlador para octener la pocision actual del usuario
.controller('MapaCtrl',function($scope, $cordovaGeolocation, mapa){
	$scope.titulo = "Pocisión actual";
	var posOptions = {timeout: 5000, enableHighAccuracy: true};
	$scope.lat;
	$scope.long;
	$cordovaGeolocation
	.getCurrentPosition(posOptions)
	.then(function(position) {
		var lat  = position.coords.latitude
		var long = position.coords.longitude

		mapa.render(lat, long);

		$scope.lat = lat;
		$scope.long = long;

	}, function(err) {
		// error
		console.log('Error: ' + err);
	});
})
//Controlador para octener la pocision actual del usuario
.controller('listAlumCtrl',  function($scope, $http, $ionicHistory, $timeout, $ionicLoading){

	// Setup the loader
  	$ionicLoading.show({
	    content: 'Loading',
	    animation: 'fade-in',
	    showBackdrop: true,
	    maxWidth: 200,
	    showDelay: 0
	  });

	$scope.myGoBack = function() {
		$ionicHistory.goBack();
	};


	// $http.get('http://jsonplaceholder.typicode.com/users')
	// 	.success(function(data) {
	// 		$ionicLoading.hide();
	// 		console.log(data);
	// 		$scope.alumnos = data;
	// 	})
	// 	.error(function(err) {
	// 		alert("No hay data para mostrar: " + err);
	// 	});


	// $scope.alumnos=[];


	// Set a timeout to clear loader, however you would actually call the $ionicLoading.hide(); method whenever everything is ready or loaded.
	  $timeout(function () {

			$scope.$apply(function(){
				$scope.alumnos = [
					{
						name: 'Pepito Perez',
						address: 'Calle 1 # 11 - 21',
						state: 'Activo'
					},

					{
						name: 'Juan Castelanos',
						address: 'Calle 1 # 11 - 21',
						state: 'Activo'
					},

					{
						name: 'Pedro Martinez',
						address: 'Calle 1 # 11 - 21',
						state: 'Activo'
					},

					{
						name: 'Alexander Acosta',
						address: 'Calle 1 # 11 - 21',
						state: 'Activo'
					},

					{
						name: 'Manuel Perez',
						address: 'Calle 1 # 11 - 21',
						state: 'Activo'
					}
				];
			});
			 $ionicLoading.hide();
	  }, 2000);
});
