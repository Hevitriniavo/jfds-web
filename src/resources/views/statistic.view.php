<?= include_component("sidebar") ?>
<div class="content">
    <div class="container">
        <div class="mb-5">
            <h1 class="text-center mb-4">Statistiques des Membres par Année</h1>
            <div class="card">
                <div class="card-body">
                    <canvas id="memberChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>

        <div class="mb-5">
            <h1 class="text-center mb-4">Statistiques par Sexe</h1>
            <div class="card">
                <div class="card-body">
                    <canvas id="sexStatisticsChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>


        <div class="mb-5">
            <h1 class="text-center mb-4">Statistiques des Sacrements par Année</h1>
            <canvas id="sacramentChart" width="400" height="200"></canvas>
        </div>

        <div class="mb-5">
            <h1 class="text-center mb-4">Activités par Mois</h1>
            <canvas id="activityChart" width="400" height="200"></canvas>
        </div>

        <div class="mb-5">
            <h1 class="text-center mb-4">Budget par Mois</h1>
            <canvas id="budgetMonthChart" width="400" height="200"></canvas>
        </div>

        <div class="mb-5">
            <h1 class="text-center mb-4">Budget par Année</h1>
            <canvas id="budgetYearChart" width="400" height="200"></canvas>
        </div>

    </div>
</div>

