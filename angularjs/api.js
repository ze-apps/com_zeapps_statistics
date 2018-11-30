app.config(["$provide",
	function ($provide) {
		$provide.decorator("zeHttp", ["$delegate", function($delegate){
			var zeHttp = $delegate;

            zeHttp.statistics = {
				requetes_generees : {
					context : context_requetes_generees,
					get : get_requete_generee,
					new : new_requete_generee,
                    contenu : contenu_requetes_generees,

					modules : get_modules,
					tables : get_tables,
                    tablesWithFields : get_tables_with_fields,
					fields : get_fields,

                    selectTables : selectTables,

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
			function get_requete_generee(id_requete_generee)
            {
				return zeHttp.get("/com_zeapps_statistics/requetes_generees/get/" + id_requete_generee);
			}
            function new_requete_generee()
            {
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/view");
            }
            function contenu_requetes_generees(id_requete_generee)
            {
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/contenu/" + id_requete_generee);
            }



            function get_modules()
            {
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/modules");
            }
            function get_tables(module)
            {
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/tables/" + module);
            }
            function get_tables_with_fields(module)
            {
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/tables/" + module+"/true");
            }
            function get_fields(module, table)
            {
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/fields/" + module + "/" + table);
            }
            function selectTables(module)
            {
                console.log('XXX XXX XXX XXX XXX XXX');
                return zeHttp.get("/com_zeapps_statistics/requetes_generees/fields/" + module);
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