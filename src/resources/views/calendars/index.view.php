<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>


        <div class="container mx-auto mt-4">
                <div class="container">
                    <h1>Marik'andro</h1>
                    <div id='calendar'></div>
                </div>

                <div id="activityModal" class="modal">
                    <div class="c-modal">
                        <div class="modal-content">
                            <span class="close">&times;</span>
                            <h2>Détails de l'activité</h2>
                            <p id="modalContent"></p>
                        </div>
                    </div>
                </div>

        </div>



        <footer>
            <p>&copy; <?= date("Y") ?> My Application. All rights reserved.</p>
        </footer>

    </div>

    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
</div>

