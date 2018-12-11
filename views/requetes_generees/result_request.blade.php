<div id="breadcrumb">
    Résultat de la requête
    <div class="pull-right">
        <ze-btn fa="arrow-left" color="info" hint="Retour" direction="left" ng-click="back()"></ze-btn>
    </div>
</div>

<div id="content">

    <div class="row">
        <div class="col-md-12">

            <div class="col-md-6" style="padding-top: 5px">
                <span class="fa fa-filter pull-left" style="font-size: 24px"></span> <ze-filters class="pull-left" data-model="filter_model" data-filters="filters" data-update="loadList"></ze-filters>
            </div>

            <div class="col-md-6">
                <ze-btn class="pull-right" fa="download" color="success" hint="Excel" always-on="true"
                        ng-click="getExcel()"></ze-btn>
            </div>

        </div>
    </div>

    <div class="row" style="margin-top: 12px">

        <div class="col-md-12">

            <table class="table table-hover table-condensed table-responsive" ng-show="resultats.length" >
                <thead>
                    <tr>
                        <th ng-repeat="field in requete.affichages">@{{ field.field }}<span ng-if="field.operation != ''"> @{{ field.operation }}</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="resultat in resultats" >
                        <td ng-repeat="field in requete.affichages">@{{ resultat[field.indexAffichage] }}</td>
                    </tr>
                </tbody>
            </table>

            <script type="text/css">
                table > thead > th, table > tbody > tr > td {
                    text-align: center;
                }
            </script>

        </div>

    </div>

</div>