<div id="breadcrumb">
    Générateur de requêtes
</div>

<div id="content">

    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-12">
            <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Nom de la requête</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <input type="text" class="form-control" value="" placeholder="Nom de la requête" ng-model="nameRequest" autofocus/>
        </div>
    </div>


    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                    TABLES
     -------------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row" style="margin-top: 10px; margin-bottom: 10px">
        <div class="col-md-12">
            <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Table(s)
                <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalTable" hint="Ajouter" always-on="true"
                        href="#modalTable" data-toggle="modal" ></ze-btn>
            </h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <table id="tblTables" class="table table-condensed table-responsive table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="col-md-6">Module</th>
                        <th class="col-md-6">Table</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="table in tables">
                        <td>@{{ table.module }}</td>
                        <td>@{{ table.table }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                    JOINTURE
     -------------------------------------------------------------------------------------------------------------------------------------------->

    <div ng-if="tables.length >= 2">

        <div class="row" style="margin-top: 10px; margin-bottom: 10px">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Jointure(s)
                    <div class="pull-right">
                        <button type="button" class="btn btn-success btn-xs" ng-click="addJointure()" style="width: 69px"><span class="fa fa-plus"></span> Ajouter</button>
                    </div>
                </h4>
            </div>
        </div>

        <div class="row">

            <div class="col-md-12" id="divJointure">

                <div class="row" style="margin-bottom: 10px;" ng-repeat="jointure in jointures">
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <select ng-model="jointure.table_left" class="form-control" ng-change="getFieldsOfSelectedTableLeft(jointure.table_left, jointure)" ng-options="table.table for table in tables">
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <select ng-model="jointure.field_left" class="form-control" ng-options="field_left.name for field_left in jointure.fieldsLeft">
                        </select>
                    </div>

                    <div class="col-md-1 col-sm-12 col-xs-12" style="padding: 0" >
                        <select class="form-control" ng-model="jointure.type_join">
                            <option selected>LEFT JOIN</option>
                            <option>RIGHT JOIN</option>
                            <option>INNER JOIN</option>
                        </select>
                    </div>

                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <select ng-model="jointure.table_right" class="form-control" ng-change="getFieldsOfSelectedTableRight(jointure.table_right, jointure)" ng-options="table.table for table in tables">
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-6 col-xs-12">
                        <select ng-model="jointure.field_right" class="form-control" ng-options="field_right.name for field_right in jointure.fieldsRight">
                        </select>
                    </div>
                    <div class="col-md-1 col-sm-6 col-xs-12" style="text-align: center; padding-top: 5px">
                        <span ng-click="supprimerCetteJointure(jointure)" class="fa fa-remove text-danger center-block" style="font-size: 25px; cursor: pointer" title="Retirer"></span>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                    AFFICHAGE
     -------------------------------------------------------------------------------------------------------------------------------------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Affichage
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalAffichage" hint="Ajouter" always-on="true"
                            href="#modalAffichage" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-6">Champs</th>
                            <th class="col-md-6">Opération</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="affichage in affichages">
                            <td>@{{ affichage.field }}</td>
                            <td>@{{ affichage.operation }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                    CONDITION(S)
     -------------------------------------------------------------------------------------------------------------------------------------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Condition(s)
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalCondition" hint="Ajouter" always-on="true"
                            href="#modalCondition" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-5">Champs</th>
                            <th class="col-md-2">Opération</th>
                            <th class="col-md-5">Valeur / intervalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="condition in conditions">
                            <td>@{{ condition.field }}</td>
                            <td>@{{ condition.operation }}</td>
                            <td>@{{ condition.value }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                    Groupé par
     -------------------------------------------------------------------------------------------------------------------------------------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Groupé par
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalGroupePar" hint="Ajouter" always-on="true"
                            href="#modalGroupePar" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Champs</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="group in groupsBy">
                            <td>@{{ group.field }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                    Ordonné par
     -------------------------------------------------------------------------------------------------------------------------------------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Ordonné par
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalOrdonnePar" hint="Ajouter" always-on="true"
                            href="#modalOrdonnePar" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="col-md-6">Champs</th>
                            <th class="col-md-6">Sens</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr ng-repeat="order in ordersBy">
                            <td>@{{ order.field }}</td>
                            <td>@{{ order.sens }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                      LIMIT
     -------------------------------------------------------------------------------------------------------------------------------------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Limit
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalLimit" hint="Ajouter" always-on="true"
                            href="#modalLimit" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <tbody>
                        <tr ng-if="limits.length == 1">
                            <td>@{{limits[0]}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-------------------------------------------------------------------------------------------------------------------------------------------
                                                                   PAGINATION
     -------------------------------------------------------------------------------------------------------------------------------------------->

    <div ng-if="tables.length >= 1">
        <div class="row" style="margin-top: 10px; margin-bottom: 10px;">
            <div class="col-md-12">
                <h4 style="border-top: 4px solid #5e5e5e; padding-top: 10px">Pagination
                    <ze-btn class="pull-right" id="ajout" fa="plus" color="success open-modalPagination" hint="Ajouter" always-on="true"
                            href="#modalPagination" data-toggle="modal" ></ze-btn>
                </h4>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-condensed table-responsive table-striped table-bordered">
                    <tbody>
                        <tr ng-if="paginations.length == 1">
                            <td>@{{paginations[0]}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="row pull-right" style="margin-top: 10px; margin-bottom: 20px;">
        <div class="col-md-12">
            <button class="btn btn-danger" style="width: 150px"><span class="fa fa-close"></span> Annuler</button>
            <button class="btn btn-primary" style="width: 150px" ng-click="saveRequest()"><span class="fa fa-save"></span> Enregistrer</button>
        </div>
    </div>


    <!-- ****************************************************************************************************************************************
                                                                    MODALS
     **************************************************************************************************************************************** -->

    <div class="modal" id="modalTable" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouvelle table
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px;">
                            <div class="col-md-4" style="padding-top: 5px">
                                <strong>Module</strong>
                            </div>
                            <div class="col-md-8">
                                <select id="selectModule" ng-class="moduleModelAddTable==null||moduleModelAddTable==''?'errorSelect form-control':'form-control'" ng-options="module for module in moduleTables" ng-model="moduleModelAddTable" ng-change="loadTables(moduleModelAddTable)">
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4" style="padding-top: 5px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select id="selectTable" ng-class="tableModalAddTable==null||tableModalAddTable==''?'errorSelect form-control':'form-control'" ng-options="table.sqlName as table.sqlName for table in tablesToAdd" ng-model="tableModalAddTable" >
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" id="btnAddTables" ng-click="addTable()" >Valider</button>
                </div>

            </div>
        </div>
    </div>

    <!-- *************************************************************************** -->

    <div class="modal" id="modalAffichage" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouvel affichage
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select ng-class="tableModelAddField==null||tableModelAddField==''?'errorSelect form-control':'form-control'" ng-options="table.table for table in tables" ng-model="tableModelAddField" ng-change="loadFields(tableModelAddField)">
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>
                            <div class="col-md-8">
                                <select ng-class="fieldModelAddField==null||fieldModelAddField==''?'errorSelect form-control':'form-control'" ng-options="field.name as field.name for field in fieldsToAdd" ng-model="fieldModelAddField" >
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Opération</strong>
                            </div>
                            <div class="col-md-8">

                                <select class="form-control" ng-model="operationModalAddField" >
                                    <option value="">-- Aucune --</option>
                                    <option>COUNT ( )</option>
                                    <option>MIN ( )</option>
                                    <option>MAX ( )</option>
                                    <option>SUM ( )</option>
                                    <option>AVG ( )</option>
                                </select>

                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="addAffichage()">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <!-- *************************************************************************** -->

    <div class="modal" id="modalCondition" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouvelle condition
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Table</strong>
                            </div>
                            <div class="col-md-8">
                                <select ng-class="tableModelAddCondition==null||tableModelAddCondition==''?'errorSelect form-control':'form-control'" ng-options="table.table for table in tables" ng-model="tableModelAddCondition" ng-change="loadFields(tableModelAddCondition)">
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>
                            <div class="col-md-8">
                                <select ng-class="fieldModelAddCondition==null||fieldModelAddCondition==''?'errorSelect form-control':'form-control'" ng-options="field.name as field.name for field in fieldsToAdd" ng-model="fieldModelAddCondition" >
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Opération</strong>
                            </div>
                            <div class="col-md-8">
                                <select ng-class="operationModalAddCondition==null||operationModalAddCondition==''?'errorSelect form-control':'form-control'" class="form-control" ng-model="operationModalAddCondition">
                                    <option value="">-- Choisir --</option>
                                    <option>=</option>
                                    <option>></option>
                                    <option><</option>
                                    <option>>=</option>
                                    <option><=</option>
                                    <option>IN</option>
                                    <option>BETWEEN</option>
                                    <option>LIKE %valeur</option>
                                    <option>LIKE valeur%</option>
                                    <option>LIKE %valeur%</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Valeur / Intervalle</strong>
                            </div>
                            <div class="col-md-8">
                                <input ng-class="valueModalAddCondition==null||valueModalAddCondition==''?'errorSelect form-control':'form-control'" type="text" class="form-control" value="" ng-model="valueModalAddCondition" required />
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="addCondition()">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <!-- *************************************************************************** -->

    <div class="modal" id="modalGroupePar" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouveau champ de groupement
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-3" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>
                            <div class="col-md-9">
                                <select ng-class="fieldModelAddGroupBy==null||fieldModelAddGroupBy==''?'errorSelect form-control':'form-control'" ng-options="field.field as field.field for field in fieldsGroupAndOrderBy" ng-model="fieldModelAddGroupBy" >
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="addGroupBy()">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <!-- *************************************************************************** -->

    <div class="modal" id="modalOrdonnePar" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Nouveau champ de tri
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">

                            <div class="col-md-3" style="padding-top: 7px">
                                <strong>Champ</strong>
                            </div>

                            <div class="col-md-9">
                                <select ng-class="fieldModelAddOrderBy==null||fieldModelAddOrderBy==''?'errorSelect form-control':'form-control'" ng-options="field.field as field.field for field in fieldsGroupAndOrderBy" ng-model="fieldModelAddOrderBy" >
                                    <option value="">-- Choisir --</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12" style="margin-bottom: 10px">

                            <div class="col-md-3" style="padding-top: 7px">
                                <strong>Sens</strong>
                            </div>

                            <div class="col-md-9">
                                <select ng-class="fieldSensAddOrderBy==null||fieldSensAddOrderBy==''?'errorSelect form-control':'form-control'" ng-model="fieldSensAddOrderBy">
                                    <option value="">-- Choisir --</option>
                                    <option selected>ASC</option>
                                    <option>DESC</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="addOrderBy()">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <!-- *************************************************************************** -->

    <div class="modal" id="modalLimit" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Limite de sélection
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Valeur</strong>
                            </div>
                            <div class="col-md-8">
                                <input type="text" class="form-control" value="" required placeholder="Ex : 5, 10" ng-class="valueAddLimit==null||valueAddLimit==''?'errorSelect form-control':'form-control'" ng-model="valueAddLimit"/>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="addLimit()">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <!-- *************************************************************************** -->

    <div class="modal" id="modalPagination" tabindex="-1" role="dialog">

        <div class="modal-dialog" role="document">

            <div class="modal-content">

                <div class="modal-header">
                    <div id="breadcrumb">
                        Pagination
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                <div class="modal-body">

                    <div class="row">

                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="col-md-4" style="padding-top: 7px">
                                <strong>Valeur</strong>
                            </div>
                            <div class="col-md-8">
                                <select ng-class="fieldModelPagination==null||fieldModelPagination==''?'errorSelect form-control':'form-control'" ng-model="fieldModelPagination" >
                                    <option value="">-- Choisir --</option>
                                    <option value="Non">Non</option>
                                    <option value="Oui">Oui</option>
                                </select>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Annuler</button>
                    <button type="button" class="btn btn-success" ng-click="addPagination()">Valider</button>
                </div>

            </div>

        </div>

    </div>

    <!---------------
        JAVASCRIPT
     ---------------->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.14.0/jquery.validate.min.js"></script>

    <script type="text/javascript">

        // var tables = [];
        //
        // function supprimerCetteJointure(id_span_jointure)
        // {
        //     console.log(id_span_jointure);
        //     $('div#jointure_'+id_span_jointure).remove();
        //     /*if (nbJointures >= 1) {
        //         nbJointures--;
        //     }*/
        // }
        //
        // // Tables currently added
        // function getOptionsSelectsTables()
        // {
        //     var html_tables = '';
        //     tables.forEach(function (elem) {
        //         html_tables += '<option>' + elem + '</option>';
        //     });
        //     return html_tables;
        // }
        //
        // function getFieldsOfSelectedTable(id_select)
        // {
        //     /*
        //     var nom_table_selectionnee = $('#'+id_select+' :selected').text();
        //     console.log(nom_table_selectionnee);
        //
        //     $("#selectHiddenTables option").each(function()
        //     {
        //         if ($(this).text() == nom_table_selectionnee) {
        //             console.log($(this).bind().innerHTML);
        //         }
        //         // console.log($(this).val());
        //         // console.log($(this).bind());
        //     });*/
        // }
        //
        // $(document).ready(function() {
        //
        //     $(this).on("click", ".open-modalAffichage", function () {
        //
        //     });
        //
        //     $(this).on("click", ".open-modalCondition", function () {
        //
        //     });
        //
        //     $(this).on("click", ".open-modalGroupePar", function () {
        //
        //     });
        //
        //     $(this).on("click", ".open-modalOrdonnePar", function () {
        //
        //     });
        //
        // });

    </script>

    <!-------------
          CSS
    --------------->
    <script type="text/css">

    </script>

    <style>
        .errorSelect {
            border: 1px solid red ;
        }
    </style>

</div>