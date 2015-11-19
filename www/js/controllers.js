angular.module('coopapp.controllers', ['ionic', 'ngCordova','LocalStorageModule'])
.controller('LoginCtrl',function($scope, $location, $http, localStorageService){

	//Defino el modelo a utilizar, en este caso un sensillo login
	//con los datos de usuario y clave
	$scope.login = {
		usuario: '',
		password: ''
	};

	//Funcion para ingresar, se ejecuta al hacer clic sobre el boton Ingresar

	$scope.ingresar = function(){
		//Aquí validaria los datos que ingresa el usuario
		if ($scope.login.usuario != "" && $scope.login.password != "") {
			console.log($scope.login);

			$http({
				method: 'POST',
				url: "https://ikarotech.com/cooptranslibre2/api/loginConductor",
				params: $scope.login
			})
			.success(function(data){
				console.log(data[0].con_id);
				if (data != null) {
					localStorageService.set('con_id', data[0].con_id);
					$location.url("/home");
				}else{
					alert('Error en el inicio de sesión')
				}
			})
			.error(function(err){
				alert('Error: ' + err);
			});

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



//Controlador para octener la pocision actual del usuario
.controller('MapaCtrl',[ '$scope', '$cordovaGeolocation', function($scope, $cordovaGeolocation){

	$scope.map = {center: {latitude: 4.99663, longitude: -73.6680 }, zoom: 8 };
	$scope.options = {scrollwheel: true};
	$scope.markers = []
	// get position of user and then set the center of the map to that position
	//  $cordovaGeolocation.getCurrentPosition().then(function (position) {
		navigator.geolocation.watchPosition(function(position) {
		console.log('getCurrentPosition');
		var lat  = position.coords.latitude
		var long = position.coords.longitude
		console.log(lat);
		console.log(long);

		$scope.map = {center: {latitude: lat, longitude: long}, zoom: 16 };
		//just want to create this loop to make more markers
		for(var i=0; i<5; i++) {
			$scope.markers.push({
				id: $scope.markers.length,
				latitude: lat + (i * 0.0100),
				longitude: long + (i * 0.005),
				title: 'm' + i
			})
		}
	}, function(err) {
		console.log('Error: ' + err);
	});
}])




//Controlador para octener la pocision actual del usuario
.controller('listAlumCtrl',  function($scope, $http, $ionicHistory, $timeout, $ionicLoading, localStorageService){
	$scope.alumnos=[];

	// Setup the loader
	$ionicLoading.show({
		content: 'Loading',
		animation: 'fade-in',
		showBackdrop: true,
		maxWidth: 200,
		showDelay: 0
	});

	var con_id = localStorageService.get('con_id');
	console.log(con_id);
	// $http.get('https://ikarotech.com/cooptranslibre2/api/cConductorVehiculo/'+ con_id)
	$http({
		method: 'GET',
		url: 'https://ikarotech.com/cooptranslibre2/api/cConductorRuta/'+ con_id
		})
		.success(function(data){
			console.log(data);
			localStorageService.set('veh_id', data[0].veh_id);

			$http({
				method: 'GET',
				url: 'https://ikarotech.com/cooptranslibre2/api/cIdRutaConductor/'+ data[0].veh_id
				})
				.success(function(data1){
					console.log(data1);
					localStorageService.set('idRuta', data1[0].idRuta);

					$http({
					method: 'GET',
					url: 'https://ikarotech.com/cooptranslibre2/api/cRutaConductor/'+ data1[0].idRuta
					})
					.success(function(data2){
						console.log(data2);
						localStorageService.set('idColegio', data2[0].idColegio);

						$http({
						method: 'GET',
						url: 'https://ikarotech.com/cooptranslibre2/api/cAlumnosRuta/'+ data2[0].idColegio+'/'+data1[0].idRuta
						})
						.success(function(data3){
							console.log(data3);
							$scope.alumnos = data3;
							if (data3 == null) {
								alert('No hay datos asociados');
								$ionicLoading.hide();
							}
							$ionicLoading.hide();
						})
						.error(function(err3){
							alertalert('Error al consultar los datos ' + err3);	
							$ionicLoading.hide();
						})

					})
					.error(function(err2){
						alertalert('Error al consultar los datos ' + err2);
						$ionicLoading.hide();
					})

				})
				.error(function(err1){
					alert('Error al consultar los datos ' + err1);
					$ionicLoading.hide();
				})

			// $ionicLoading.hide();
		})
		.error(function(err){
			alert('Error al consultar los datos ' + err);
			$ionicLoading.hide();
		})

});
