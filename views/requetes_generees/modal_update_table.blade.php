
<div ng-controller="ComZeappsRequetesGenereesCtrl">

    <div class="row">

        <div class="col-md-12" style="margin-bottom: 10px;">
            <div class="col-md-4" style="padding-top: 5px">
                <strong>Module</strong>
            </div>
            <div class="col-md-8">


                <select ng-model="form.id_module" class="form-control" ng-change="updateModule()">
                    <option ng-repeat="module in modules" ng-value="@{{module.label}}">
                        @{{ module.label }}
                    </option>
                </select>

            </div>
        </div>

        <div class="col-md-12">
            <div class="col-md-4" style="padding-top: 5px">
                <strong>Table</strong>
            </div>
            <div class="col-md-8">
                <select id="selectTable"
                        ng-class="tableModalAddTable==null||tableModalAddTable==''?'errorSelect form-control':'form-control'"
                        ng-options="table.sqlName as table.sqlName for table in tablesToAdd"
                        ng-model="tableModalAddTable" >
                    <option value="">-- Choisir --</option>
                </select>
            </div>
        </div>

    </div>

</div>