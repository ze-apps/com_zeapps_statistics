<div id="breadcrumb">
    Générateur de requêtes
    <div class="pull-right">
        <ze-btn fa="arrow-left" color="info" hint="Retour" direction="left" ng-click="back()"></ze-btn>
    </div>
</div>

<div id="content">

    <div class="well">

        <div class="row">

        </div>

    </div>

    <div class="well">

        <div class="row">
            <div class="col-md-12">
                <label>Autres lignes de la commande</label>
                <select class="form-control">
                    <option>2891178	- Chaise Café Marly - Qte : 37</option>
                    <option>9874560	- Fauteuil Frizz - Qte : 17</option>
                    <option>2757901	- Fauteuil Karavel - Qte : 38</option>
                    <option>4004287	- Fauteuil Tracks Magic Window - Qte : 6</option>
                    <option>3474055	- Guéridon Karla Mazoo - Qte : 10</option>
                </select>
            </div>
        </div>
    </div>

    <div class="well">

        <div class="row">
            <div class="col-md-4">
                <div class="titleWell">
                    <strong>Article : </strong> @{{commande.titre_article}}
                </div>
            </div>

            <div class="col-md-4">
                <strong>Quantité : </strong>@{{commande.nb_articles}}
            </div>

            <div class="col-md-4">
                <strong>Temps unitaire : </strong>@{{commande.temps_unitaire}} min
            </div>
        </div>

        <div class="row" style="margin-top: 7px">
            <div class="col-md-4">
                <div class="titleWell">
                    <strong>Date Lancement : </strong> @{{commande.date_lancement}}
                </div>
            </div>

            <div class="col-md-4">
                <strong>Date Expédition : </strong>@{{commande.date_expedition}}
            </div>

            <div class="col-md-4">
                <strong>Date Livraison : </strong>@{{commande.date_livraison}}
            </div>

        </div>

    </div>

    <style>
        tr > th, tr > td {
            font-family: 'Microsoft Sans Serif', Tahoma, Arial, Verdana, Sans-Serif;
            text-align: center;
            font-weight: bold;
            color: #2b2b2b;
            border-color: #545454;
        }
    </style>

</div>