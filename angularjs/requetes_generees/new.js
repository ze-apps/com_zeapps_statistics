app.controller("ComZeappsRequetesGenereesCtrl", ["$scope", "$routeParams", "$location", "$rootScope", "zeHttp", "zeapps_modal", "menu",

    function ($scope, $routeParams, $location, $rootScope, zhttp, zeapps_modal, menu) {

        menu("com_zeapps_statistics", "com_zeapps_statistics_requeteur");


        // Load all data
        $scope.loadModules = loadModules;
        $scope.loadTables = loadTables;
        $scope.loadFields = loadFields;

        // private variables
        $scope.moduleTables = [] ;
        $scope.tablesToAdd = [] ;

        $scope.moduleModelAddTable = null ;
        $scope.tableModalAddTable = null ;

        $scope.fieldModelAddField = null;
        $scope.operationModalAddField = null;

        $scope.fieldModelAddCondition = null;
        $scope.operationModalAddCondition = null;

        // default variables to load from Database
        $scope.id = 0 ;
        $scope.tables = [] ;
        $scope.jointures = [] ;
        $scope.fields = [] ;
        $scope.affichages = [] ;
        $scope.conditions = [] ;
        $scope.limits = [] ;
        $scope.paginations = [] ;

        $scope.groupsBy = [] ;
        $scope.ordersBy = [] ;

        $scope.fieldsGroupAndOrderBy = [] ;

        // Update elements templates
        $scope.templateUpdateTable = '/com_zeapps_statistics/requetes_generees/modal_update_table';

        // Function implementations =>  Get data from backend controller
        function loadModules()
        {
            zhttp.statistics.requetes_generees.modules().then(function (response) {
                if (response.status === 200) {
                    $scope.moduleTables = response.data.modules;
                }
            });
        }

        // Load defaults modules
        loadModules();


        // Select table drop-downs
        function loadFields(table, next)
        {
            if (table) {
                for (var i = 0; i < $scope.fields.length; i++) {
                    if ($scope.fields[i].table == table.table) {
                        $scope.fieldsToAdd = $scope.fields[i].fields;

                        if (next) {
                            next();
                        }
                    }
                }
            }
        }

        // Get tables of a module
        function loadTables(module, next)
        {
            $scope.tablesToAdd = [];
            zhttp.statistics.requetes_generees.tablesWithFields(module).then(function (response) {
                if (response.status === 200) {
                    $scope.tablesToAdd = response.data.tables;

                    if (next) {
                        next() ;
                    }
                }
            });
        }


        // reload request
        if ($routeParams.id) {
            zhttp.statistics.requetes_generees.get($routeParams.id).then(function (response) {
                if (response.status === 200) {
                    var dataJson = JSON.parse(response.data.contenu);

                    $scope.id = $routeParams.id;
                    $scope.nameRequest = response.data.nom_requete;
                    $scope.tables = dataJson.tables;
                    $scope.jointures = dataJson.jointures;
                    $scope.affichages = dataJson.affichages;
                    $scope.conditions = dataJson.conditions;
                    $scope.limits = dataJson.limits;
                    $scope.paginations = dataJson.pagination;

                    $scope.groupsBy = dataJson.groupsBy;
                    $scope.ordersBy = dataJson.ordersBy;


                    // repeuple les jointures avec les objets javascript qui sont en mémoire sinon ne fonctionne pas
                    if ($scope.jointures && $scope.jointures.length) {
                        for (var iJointures = 0; iJointures < $scope.jointures.length; iJointures++) {
                            for (var iTables = 0; iTables < $scope.tables.length; iTables++) {
                                if ($scope.tables[iTables].module == $scope.jointures[iJointures].table_left.module && $scope.tables[iTables].table == $scope.jointures[iJointures].table_left.table) {
                                    $scope.jointures[iJointures].table_left = $scope.tables[iTables];

                                    Object.keys($scope.jointures[iJointures].fieldsLeft).forEach(function (elem) {
                                        if ($scope.jointures[iJointures].fieldsLeft[elem].name == $scope.jointures[iJointures].field_left.name) {
                                            $scope.jointures[iJointures].field_left = $scope.jointures[iJointures].fieldsLeft[elem] ;
                                        }

                                    });
                                }

                                if ($scope.tables[iTables].module == $scope.jointures[iJointures].table_right.module && $scope.tables[iTables].table == $scope.jointures[iJointures].table_right.table) {
                                    $scope.jointures[iJointures].table_right = $scope.tables[iTables];

                                    Object.keys($scope.jointures[iJointures].fieldsRight).forEach(function (elem) {
                                        if ($scope.jointures[iJointures].fieldsRight[elem].name == $scope.jointures[iJointures].field_right.name) {
                                            $scope.jointures[iJointures].field_right = $scope.jointures[iJointures].fieldsRight[elem] ;
                                        }

                                    });
                                }
                            }
                        }
                    }


                    // reconstitue le tableau fields
                    $scope.fields = [];
                    for (var iTables = 0; iTables < $scope.tables.length; iTables++) {
                        $scope.fields.push({
                            table: $scope.tables[iTables].table,
                            fields: $scope.tables[iTables].fields
                        });
                        Object.keys($scope.tables[iTables].fields).forEach(function (elem) {
                            $scope.fieldsGroupAndOrderBy.push({field: $scope.tables[iTables].table + "." + elem});
                        });
                    }

                }
            });
        }

        // *************************************************************

        var tableEdit = null ;
        $scope.editTable = function (table) {
            tableEdit = table ;

            if (table) {
                $scope.moduleModelAddTable = table.module ;

                $scope.loadTables($scope.moduleModelAddTable, function () {
                    $scope.tableModalAddTable = table.table ;
                });
            }
        };

        $scope.saveTable = function () {

            if ($scope.moduleModelAddTable && $scope.tableModalAddTable && $scope.moduleModelAddTable != '' && $scope.tableModalAddTable != '') {

                // Close modal and append data
                $('#modalTable').modal('hide');

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < $scope.tables.length; i++) {
                    if ($scope.tables[i].module == $scope.moduleModelAddTable && $scope.tables[i].table == $scope.tableModalAddTable) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {

                    // Get fields from back-end
                    zhttp.statistics.requetes_generees.fields($scope.moduleModelAddTable, $scope.tableModalAddTable).then(function (response) {
                        if (response.status === 200) {
                            $scope.fields.push({table: $scope.tableModalAddTable, fields:response.data.fields});

                            if (tableEdit != null) {
                                tableEdit.module = $scope.moduleModelAddTable ;
                                tableEdit.table = $scope.tableModalAddTable ;
                                tableEdit.fields = response.data.fields ;
                            } else {
                                $scope.tables.push({
                                    module: $scope.moduleModelAddTable,
                                    table: $scope.tableModalAddTable,
                                    fields: response.data.fields
                                });
                            }

                            // Update list of folders of group by and order by
                            Object.keys(response.data.fields).forEach(function(elem) {
                                $scope.fieldsGroupAndOrderBy.push({field: $scope.tableModalAddTable + "." + elem});
                            });
                        }
                    });
                }

                return true;
            }
        };

        // *************************************************************

        var affichageEdit = null ;
        $scope.editAffichage = function (affichage) {

            affichageEdit = affichage ;

            if (affichage) {

                var nameTable = affichage.field.split('.');

                for (var i = 0; i < $scope.tables.length; i++) {
                    if ($scope.tables[i].table == nameTable[0]) {
                        $scope.tableModelAddField = $scope.tables[i];

                        $scope.loadFields($scope.tableModelAddField, function () {
                            $scope.fieldModelAddField = nameTable[1] ;
                            $scope.operationModalAddField = affichage.operation;
                        });
                    }
                }
            }
        };

        $scope.saveAffichage = function () {

            if ($scope.fieldModelAddField && $scope.tableModelAddField && $scope.fieldModelAddField != '' && $scope.tableModelAddField != '') {

                // Close modal and append data
                $('#modalAffichage').modal('hide');

                // test si la table est déjà présente
                var possibleAjout = true;

                // Json to array
                var arrAffichage = $.map($scope.affichages, function(el, i) {
                    return el;
                });

                for (var i = 0; i < arrAffichage.length; i++) {

                    if (arrAffichage[i].field == $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField &&
                        arrAffichage[i].operation == $scope.operationModalAddField) {

                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {

                    if (affichageEdit != null) {
                        affichageEdit.field = $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField ;
                        affichageEdit.operation = $scope.tableModalAddTable ;
                    } else {
                        arrAffichage.push({
                            field: $scope.tableModelAddField.table + '.' + $scope.fieldModelAddField,
                            operation: $scope.operationModalAddField
                        });
                        $scope.affichages = arrAffichage;
                    }
                }

                return true;
            }
        };

        // *************************************************************

        var conditionEdit = null ;
        $scope.editCondition = function (condition) {
            conditionEdit = condition ;

            if (condition) {

                var nameTable = condition.field.split('.');

                for (var i = 0; i < $scope.tables.length; i++) {
                    if ($scope.tables[i].table == nameTable[0]) {
                        $scope.tableModelAddCondition = $scope.tables[i];

                        $scope.loadFields($scope.tableModelAddCondition, function () {
                            $scope.fieldModelAddCondition = nameTable[1] ;
                            $scope.operationModalAddCondition = condition.operation;
                            $scope.valueModalAddCondition = condition.value;
                        });
                    }
                }
            }
        };

        $scope.saveCondition = function () {

            if ($scope.tableModelAddCondition && $scope.fieldModelAddCondition && $scope.operationModalAddCondition && $scope.valueModalAddCondition &&
                $scope.tableModelAddCondition != '' && $scope.fieldModelAddCondition != '' &&  $scope.operationModalAddCondition != '' && $scope.valueModalAddCondition != '') {

                // Close modal and append data
                $('#modalCondition').modal('hide');

                // Json to array
                var arrCondition = $.map($scope.conditions, function(el, i) {
                    return el;
                });

                // test si la table est déjà présente
                var possibleAjout = true;

                for (var i = 0; i < arrCondition.length; i++) {

                    if (arrCondition[i].field == $scope.tableModelAddCondition.table + '.' + $scope.fieldModelAddCondition &&
                        arrCondition[i].operation == $scope.operationModalAddCondition &&
                        arrCondition[i].value == $scope.valueModalAddCondition) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {

                    if (conditionEdit != null) {
                        conditionEdit.field = $scope.tableModelAddCondition.table + '.' + $scope.fieldModelAddCondition ;
                        conditionEdit.operation = $scope.operationModalAddCondition ;
                        conditionEdit.value = $scope.valueModalAddCondition ;
                    } else {
                        arrCondition.push({
                            field: $scope.tableModelAddCondition.table + '.' + $scope.fieldModelAddCondition,
                            operation: $scope.operationModalAddCondition,
                            value: $scope.valueModalAddCondition});
                        $scope.conditions = arrCondition;
                    }
                }

                return true;
            }
        };

        // *************************************************************

        var groupbyEdit = null ;
        $scope.editGroupby = function (groupby) {
            groupbyEdit = groupby ;

            if (groupby) {

                var nameTable = groupby.field.split('.');

                for (var i = 0; i < $scope.tables.length; i++) {
                    if ($scope.tables[i].table == nameTable[0]) {
                        $scope.fieldModelAddGroupBy = $scope.tables[i].table + '.' + nameTable[1];
                    }
                }
            }
        };

        $scope.saveGroupBy = function () {

            if ($scope.fieldModelAddGroupBy && $scope.fieldModelAddGroupBy != '') {

                // Close modal and append data
                $('#modalGroupePar').modal('hide');

                // Json to array
                var arrGroupsBy = $.map($scope.groupsBy, function(el, i) {
                    return el;
                });

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < arrGroupsBy.length; i++) {

                    if (arrGroupsBy[i].field == $scope.fieldModelAddGroupBy) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {

                    if (groupbyEdit != null) {
                        groupbyEdit.field = $scope.fieldModelAddGroupBy ;
                    } else {
                        arrGroupsBy.push({
                            field: $scope.fieldModelAddGroupBy});
                        $scope.groupsBy = arrGroupsBy;
                    }
                }

                return true;
            }
        };

        // *************************************************************

        var orderbyEdit = null ;
        $scope.editOrderby = function (orderby) {
            orderbyEdit = orderby ;

            if (orderby) {

                var nameTable = orderby.field.split('.');

                for (var i = 0; i < $scope.tables.length; i++) {
                    if ($scope.tables[i].table == nameTable[0]) {
                        $scope.fieldModelAddOrderBy = $scope.tables[i].table + '.' + nameTable[1];
                        $scope.fieldSensAddOrderBy = orderby.sens;
                    }
                }
            }
        };

        $scope.saveOrderBy = function () {

            if ($scope.fieldModelAddOrderBy && $scope.fieldModelAddOrderBy != '' && $scope.fieldSensAddOrderBy && $scope.fieldSensAddOrderBy != '') {

                // Close modal and append data
                $('#modalOrdonnePar').modal('hide');

                // Json to array
                var arrOrdersBy = $.map($scope.ordersBy, function(el, i) {
                    return el;
                });

                // test si la table est déjà présente
                var possibleAjout = true;
                for (var i = 0; i < arrOrdersBy.length; i++) {

                    if (arrOrdersBy[i].field == $scope.fieldModelAddOrderBy &&
                        arrOrdersBy[i].sens == $scope.fieldSensAddOrderBy) {
                        possibleAjout = false ;
                        break;
                    }
                }

                if (possibleAjout) {

                    if (orderbyEdit != null) {
                        orderbyEdit.field = $scope.fieldModelAddOrderBy ;
                        orderbyEdit.sens = $scope.fieldSensAddOrderBy ;
                    } else {
                        arrOrdersBy.push({
                            field: $scope.fieldModelAddOrderBy,
                            sens: $scope.fieldSensAddOrderBy});
                        $scope.ordersBy = arrOrdersBy;
                    }
                }

                return true;
            }
        };

        // *************************************************************

        var limitEdit = null ;
        $scope.editLimit = function (limit) {

            limitEdit = limit ;

            if (limit) {
                $scope.limits = [limit];
                $scope.valueAddLimit = limit;
            }
        };

        $scope.saveLimit = function() {

            // Validation
            $scope.valueAddLimit = $scope.valueAddLimit.replace('.', ',');

            if ($scope.valueAddLimit && $scope.valueAddLimit.indexOf(',') >= 1) {

                var reg = new RegExp("[ ,;]+", "g");
                var _split = $scope.valueAddLimit.split(reg);

                var from = parseInt(_split[0]);
                var to = parseInt(_split[1]);

                if (!$.isNumeric(_split[0]) || !$.isNumeric(_split[1])) {
                    return false;
                } else if (from >= to) {
                    return false;
                } else {

                    // Close modal and append data
                    $('#modalLimit').modal('hide');

                    if ($scope.limits.length === 0 || limitEdit) {
                        $scope.limits = [];
                        $scope.limits.push(_split[0] + ',' + _split[1]);
                    }

                    return true;
                }

            } else if ($.isNumeric($scope.valueAddLimit)) {

                // Close modal and append data
                $('#modalLimit').modal('hide');

                if ($scope.limits.length === 0 || limitEdit) {
                    $scope.limits = [];
                    $scope.limits.push($scope.valueAddLimit);
                }

                return true;
            }

        };

        // *************************************************************

        var paginationEdit = null ;
        $scope.editPagination = function (pagination) {

            paginationEdit = pagination ;

            if (pagination) {
                $scope.paginations = [pagination];
                $scope.fieldModelPagination = pagination;
            }
        };

        $scope.savePagination = function () {

            if ($scope.fieldModelPagination && $scope.fieldModelPagination != '') {

                // Close modal and append data
                $('#modalPagination').modal('hide');

                if ($scope.paginations.length === 0 || paginationEdit) {
                    $scope.paginations = [];
                    $scope.paginations.push($scope.fieldModelPagination);
                }

                return true;
            }
        };

        $scope.addJointure = function () {
            $scope.jointures.push({table_left: {}, field_left: {}, type_join: {}, table_right: {}, field_right: {}});
        };

        $scope.getFieldsOfSelectedTableLeft = getFieldsOfSelectedTableLeft;
        function getFieldsOfSelectedTableLeft(table, jointure)
        {
            if (table != null) {
                jointure.fieldsLeft = table.fields;
            }
        }

        $scope.getFieldsOfSelectedTableRight = getFieldsOfSelectedTableRight;
        function getFieldsOfSelectedTableRight(table, jointure)
        {
            if (table != null) {
                jointure.fieldsRight = table.fields;
            }
        }

        /**********************
         **** SAVE REQUEST ****
         **********************/
        $scope.saveRequest = function() {

            var arr_request = [] ;
            var validation_tables_et_affichages = true;
            var validation_table_sans_jointure = true;

            // Elements of request
            arr_request['tables'] = $scope.tables ;
            arr_request['fields'] = $scope.fields ;
            arr_request['jointures'] = $scope.jointures ;
            arr_request['affichages'] = $scope.affichages ;
            arr_request['conditions'] = $scope.conditions ;
            arr_request['groupsBy'] = $scope.groupsBy ;
            arr_request['ordersBy'] = $scope.ordersBy ;
            arr_request['limits'] = $scope.limits ;
            arr_request['pagination'] = $scope.paginations ;

            var jsonObject = {
                'id' : $scope.id,
                'nom_requete' : $scope.nameRequest,
                'contenu' : Object.assign({}, arr_request)
            };

            // All tables must be used in joins
            if ($scope.tables.length > 0 && $scope.affichages.length > 0 ) {

                var arrTablesOfJointures = [];
                $scope.jointures.forEach(function(elem) {

                    if (arrTablesOfJointures.includes(elem.table_right.table) == false) {
                        arrTablesOfJointures.push(elem.table_right.table);
                    }

                    if (arrTablesOfJointures.includes(elem.table_left.table) == false) {
                        arrTablesOfJointures.push(elem.table_left.table);
                    }
                });

                if (arrTablesOfJointures.length == 0) {
                    validation_table_sans_jointure = false;
                }

                $scope.tables.forEach(function(elem) {

                    if (arrTablesOfJointures.includes(elem.table) == false &&
                        arrTablesOfJointures.includes(elem.table) == false) {

                        validation_table_sans_jointure = false;
                    }

                });

            } else if ($scope.tables.length == 0 || $scope.affichages.length == 0) {
                validation_tables_et_affichages = false;
            }

            if (validation_tables_et_affichages && validation_table_sans_jointure) {

                zhttp.statistics.requetes_generees.save(jsonObject).then(function (response) {
                    if (response.data && response.data !== "false") {
                        if (isNaN(response.data) === false && response.data > 0) {
                            // Insert request is ok => redirect to list
                            $location.path("/ng/com_zeapps_statistics/requetes_generees");
                        }
                    }
                });

                return true;
            } else {

                if (!validation_tables_et_affichages) {
                    alert('Requête invalide, car au moins une des clauses suivantes n\'a pas été renseignée : \r\n - Table(s) \n - Affichage.');
                } else if (!validation_table_sans_jointure) {
                    alert('Requête invalide, car au moins une des tables n\'est pas utilisée dans une jointure.');
                }

                return false;
            }

        };


        /*********************************
         *** DELETE ELEMENT OF REQUEST ***
         *********************************/
        if ($routeParams.id) {

            $scope.supprimerCetteJointure = supprimerCetteJointure;
            function supprimerCetteJointure(jointure)
            {
                for (var i=0; i < $scope.jointures.length; i++) {
                    if ($scope.jointures[i].$$hashKey === jointure.$$hashKey) {
                        $scope.jointures.splice(i, 1);
                        break;
                    }
                }

                for (var i=0; i < $scope.jointures.length; i++) {
                    if ($scope.jointures[i].$$hashKey === jointure.$$hashKey) {
                        $scope.jointures.splice(i, 1);
                        break;
                    }
                }
            }

            $scope.deleteTableFromRequest = deleteTableFromRequest;
            function deleteTableFromRequest(table)
            {
                var tableUsedInJoin = false;
                for (var i = 0; i < $scope.jointures.length; i++) {
                    if ($scope.jointures[i].table_left.table === table.table || $scope.jointures[i].table_right.table === table.table) {
                        tableUsedInJoin = true;
                        break;
                    }
                }

                if (tableUsedInJoin) {

                    alert('Table non supprimée car utilisée dans une jointure !');
                    return false;

                } else {

                    // Remove data from DOM
                    var tableDeleted = false;
                    for (var i = 0; i < $scope.tables.length; i++) {
                        if ($scope.tables[i].table === table.table) {
                            $scope.tables.splice(i, 1);
                            tableDeleted = true;
                            break;
                        }
                    }

                    if (tableDeleted) {

                        for (var i = 0; i < $scope.fields.length; i++) {
                            if ($scope.fields[i].table === table.table) {
                                $scope.fields.splice(i, 1);
                                break;
                            }
                        }

                        for (var i = 0; i < $scope.affichages.length; i++) {
                            var _table = $scope.affichages[i].field.split(".");
                            if (_table[0] === table.table) {
                                $scope.affichages.splice(i, 1);
                                break;
                            }
                        }

                        for (var i = 0; i < $scope.conditions.length; i++) {
                            var _table = $scope.conditions[i].field.split(".");
                            if (_table[0] === table.table) {
                                $scope.conditions.splice(i, 1);
                                break;
                            }
                        }

                        for (var i = 0; i < $scope.groupsBy.length; i++) {
                            var _table = $scope.groupsBy[i].field.split(".");
                            if (_table[0] === table.table) {
                                $scope.groupsBy.splice(i, 1);
                                break;
                            }
                        }

                        for (var i = 0; i < $scope.ordersBy.length; i++) {
                            var _table = $scope.ordersBy[i].field.split(".");
                            if (_table[0] === table.table) {
                                $scope.ordersBy.splice(i, 1);
                                break;
                            }
                        }
                    }

                }

            }

            $scope.deleteAffichageFromRequest = deleteAffichageFromRequest;
            function deleteAffichageFromRequest(affichage)
            {
                // Remove data from DOM
                var arrAffichages = $.map($scope.affichages, function(el, i) {
                    return el;
                });

                for (var i=0; i < arrAffichages.length; i++) {
                    if ( arrAffichages[i].field === affichage.field) {
                        arrAffichages.splice(i, 1);
                        break;
                    }
                }

                $scope.affichages = arrAffichages;
            }

            $scope.deleteConditionFromRequest = deleteConditionFromRequest;
            function deleteConditionFromRequest(condition)
            {
                // Remove data from DOM => Transfet de Json vers array pour le "splice"
                var arrConditions = $.map($scope.conditions, function(el, i) {
                    return el;
                });

                for (var i=0; i < arrConditions.length; i++) {
                    if ( arrConditions[i].field === condition.field) {
                        arrConditions.splice(i, 1);
                        break;
                    }
                }

                $scope.conditions = arrConditions;
            }

            $scope.deleteGroupByFromRequest = deleteGroupByFromRequest;
            function deleteGroupByFromRequest(GroupBy)
            {
                // Remove data from DOM
                var arrGroupsBy = $.map($scope.groupsBy, function(el, i) {
                    return el;
                });

                for (var i=0; i < arrGroupsBy.length; i++) {
                    if ( arrGroupsBy[i].field === GroupBy.field) {
                        arrGroupsBy.splice(i, 1);
                        break;
                    }
                }

                $scope.groupsBy = arrGroupsBy;
            }

            $scope.deleteOrderByFromRequest = deleteOrderByFromRequest;
            function deleteOrderByFromRequest(OrderBy)
            {
                // Remove data from DOM
                var arrOrdersBy = $.map($scope.ordersBy, function(el, i) {
                    return el;
                });

                for (var i=0; i < arrOrdersBy.length; i++) {
                    if ( arrOrdersBy[i].field === OrderBy.field) {
                        arrOrdersBy.splice(i, 1);
                        break;
                    }
                }

                $scope.ordersBy = arrOrdersBy;
            }

            $scope.deleteLimitRequest = deleteLimitRequest;
            function deleteLimitRequest(Limit)
            {
                // Remove data from DOM
                var arrLimitsOrdersBy = $.map($scope.limits, function(el, i) {
                    return el;
                });

                for (var i=0; i < arrLimitsOrdersBy.length; i++) {
                    if ( arrLimitsOrdersBy[i] === Limit) {
                        $scope.limits = [];
                    }
                }
            }

            $scope.deletePaginationRequest = deletePaginationRequest;
            function deletePaginationRequest(pagination)
            {
                // Remove data from DOM
                var arrPaginations = $.map($scope.paginations, function(el, i) {
                    return el;
                });

                for (var i=0; i < arrPaginations.length; i++) {
                    if ( arrPaginations[i] === pagination) {
                        $scope.paginations = [];
                    }
                }
            }

        }

        $scope.back = back;
        function back()
        {
            $location.path("/ng/com_zeapps_statistics/requetes_generees");
        }

}]);