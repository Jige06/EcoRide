<section class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="h3 mb-4 text-center">Connexion</h1>

                    <form action="/login" method="POST">
                        <input type="hidden" name="csrf_token" value="<?= $this->generateCsrfToken() ?>">

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <div class="input-group">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <button class="btn btn-outline-secondary toggle-password" type="button" data-target="#password">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-success px-5">Se connecter</button>
                        </div>
                    </form>

                    <p class="text-center mt-3 mb-0">
                        <a href="/inscription">Pas encore de compte ? S'inscrire</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>