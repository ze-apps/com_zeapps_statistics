app.config(["$routeProvider",

	function ($routeProvider) {

		$routeProvider

		////////////////////// STATISTIQUES : LISTE REQUETES + REQUETEUR ////////////////////////
		//
		.when("/ng/com_zeapps_statistics/requetes_generees/search", {
			templateUrl: "/com_zeapps_statistics/requetes_generees/search",
			controller: "ComZeappsStatisticsRequestsListCtrl"
		})
		.when("/ng/com_zeapps_statistics/requetes_generees/get/:id_requete_generee", {
			templateUrl: "/com_zeapps_statistics/requetes_generees/view",
			controller: "ComZeappsRequetesGenereesViewCtrl"
		})
		.when("/ng/com_zeapps_statistics/requetes_generees/new", {
			templateUrl: "/com_zeapps_statistics/requetes_generees/new",
			controller: "ComZeappsRequetesGenereesNewCtrl"
		});

	}]);

