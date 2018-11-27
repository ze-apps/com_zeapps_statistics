app.config(["$routeProvider",

	function ($routeProvider) {

		$routeProvider

		////////////////////// STATISTIQUES : LISTE REQUETES + REQUETEUR ////////////////////////
		//
		.when("/ng/com_zeapps_statistics/requetes_generees/search", {
			templateUrl: "/com_zeapps_statistics/requetes_generees/search",
			controller: "ComZeappsStatisticsRequestsListCtrl"
		})
		.when("/ng/com_zeapps_statistics/requetes_generees/requeteur", {
			templateUrl: "/com_zeapps_statistics/requetes_generees/requeteur",
			controller: "ComZeappsRequetesGenereesViewCtrl"
		});

	}]);

