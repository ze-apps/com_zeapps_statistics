app.config(["$provide",
	function ($provide) {
		$provide.decorator("zeHttp", ["$delegate", function($delegate){
			var zeHttp = $delegate;

            zeHttp.statistics = {
				requetes_generees : {
					context : context_requetes_generees,
					get : get_requetes_generees,
                    contenu : contenu_requetes_generees,
					all : getAll_requetes_generees,
                    save : save_requetes_generees,
					excel : {
						make : makeExcel_requetes_generees,
						get : getExcel_requetes_generees
					}
				}
			};

			zeHttp.config = angular.extend(zeHttp.config || {}, {
			});

			return zeHttp;


            /////////////////////////////////// REQUETES GENEREES /////////////////////////////////////
            //
			function context_requetes_generees()
            {
				return zeHttp.get("/com_zeapps_statistics/requetes_generees/context/");
			}
			function get_requetes_generees(id_requete_generee)
            {
				return zeHttp.get("/com_zeapps_statistics/requetes_generees/get/" + id_requete_generee);
			}
            function contenu_requetes_generees(id_requete_generee)
            {
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/contenu/" + id_requete_generee);
            }
			function getAll_requetes_generees()
            {
				return zeHttp.post("/com_zeapps_statistics/requetes_generees/search");
			}
            function save_requetes_generees()
            {
                return zeHttp.post("/com_zeapps_statistics/requetes_generees/save");
            }
            function makeExcel_requetes_generees(filters)
            {
                return zeHttp.post("/com_zeapps_statistics/requetes_generees/make_export/", filters);
            }
            function getExcel_requetes_generees()
            {
                return "/com_zeapps_statistics/requetes_generees/get_export/";
            }

		}]);
	}]);