<section class="hero-section text-center py-5">
    <div class="container">
        <div class="hero-image-placeholder mx-auto mb-4">
            <span>IMAGE NATURE</span>
        </div>
        <h1 class="fw-bold">Voyagez écologique avec EcoRide</h1>
        <p class="lead mb-4">Trouver un covoiturage près de chez vous</p>

        <form action="/covoiturages" method="GET">
            <div class="row justify-content-center g-2">
                <div class="col-md-3">
                    <input type="text" class="form-control" id="depart" name="depart" placeholder="Ville de départ" required>
                </div>
                <div class="col-md-3">
                    <input type="text" class="form-control" id="arrivee" name="arrivee" placeholder="Ville d'arrivée" required>
                </div>
                <div class="col-md-2">
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="col-md-auto">
                    <button type="submit" class="btn btn-success px-4">Rechercher</button>
                </div>
            </div>
        </form>
    </div>
</section>

<section class="about-section py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-5">
                <div class="image-placeholder">
                    <span>IMAGE</span>
                </div>
            </div>
            <div class="col-md-7">
                <h2>Qui sommes-nous ?</h2>
                <p>
                    EcoRide est une jeune startup française née d'une conviction simple :
                    se déplacer ne devrait pas coûter cher, ni à votre porte-monnaie, ni à la planète.
                    Nous connectons chaque jour des conducteurs et des passagers qui partagent un
                    même trajet, pour transformer une habitude polluante en un geste solidaire
                    et économique. Notre mission est de devenir la référence du covoiturage
                    pour tous ceux qui veulent voyager autrement.
                </p>
            </div>
        </div>

        <div class="row align-items-center">
            <div class="col-md-7 order-md-1 order-2">
                <h2>Nos valeurs</h2>
                <p>
                    L'écologie est au cœur de chacune de nos décisions : nous mettons en avant
                    les trajets réalisés en véhicule électrique et encourageons chaque covoitureur
                    à réduire son empreinte carbone. Au-delà de l'environnement, nous croyons en
                    une communauté de confiance, où chaque avis compte et où chaque trajet partagé
                    rapproche des inconnus le temps d'un voyage.
                </p>
            </div>
            <div class="col-md-5 order-md-2 order-1 mb-4 mb-md-0">
                <div class="image-placeholder">
                    <span>IMAGE</span>
                </div>
            </div>
        </div>
    </div>
</section>