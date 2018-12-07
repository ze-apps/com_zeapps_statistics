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
            <table class="table table-hover table-condensed table-responsive" ng-show="requeteResultats.length">
                <thead>
                    <tr>
                        <th class="col-md-1">#</th>
                        <th class="col-md-1">Nom requête</th>
                        <th class="col-md-4">Contenu</th>
                        <th class="col-md-1">Date création</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="requeteResult in requeteResultats" style="cursor: pointer" >

                        <td>xxx</td>
                        <td>@{{requeteResult.nom_requete}}</td>
                        <td>@{{requeteResult.contenu}}</td>
                        <td>@{{requeteResult.created_at || "-" | date:'dd/MM/yyyy'}}</td>
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