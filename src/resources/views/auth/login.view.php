<section class="bg-light p-1 p-md-2 p-xl-3">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-xxl-11">
                <div class="card border-light-subtle shadow-sm">
                    <div class="row g-0">
                        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center flex-column">
                            <img class="img-fluid rounded-start w-100 h-50 object-fit-cover" loading="lazy" src="<?= pubUrl("assets/logo.jpeg") ?>" alt="Tongasoa indray, tsaroanay ianao!">
                            <div>
                                <h2 class="h4 text-center"> EKAR MD PIERA SY MD PAOLY SOAVIMASOANDRO</h2>
                                <p>Fikambanan'ny tanora Katolika</p>
                            </div>
                        </div>
                        <div class="col-12 col-md-6 d-flex align-items-center justify-content-center">
                            <div class="col-12 col-lg-11 col-xl-10">
                                <div class="card-body p-3 p-md-4 p-xl-5">
                                    <form id="signupForm" action="<?= path("/auth/login") ?>" method="post" novalidate>
                                        <div class="row gy-3 overflow-hidden">
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="first_name" id="firstName" placeholder="Anarana Voalohany" required>
                                                    <label for="firstName" class="form-label">Anarana Voalohany</label>
                                                    <div class="invalid-feedback">Azafady, ampidiro ny anarana voalohany.</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <input type="text" class="form-control" name="last_name" id="lastName" placeholder="Fanampin'anarana" required>
                                                    <label for="lastName" class="form-label">Fanampin'anarana</label>
                                                    <div class="invalid-feedback">Azafady, ampidiro ny fanampin'anarana.</div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-floating mb-3">
                                                    <select name="responsibility_id" id="responsibility" class="form-select bg-white text-dark" >
                                                        <option value="" disabled selected>Safidio ny andraikitra</option>
                                                        <?php foreach ($responsibilities as $responsibility): ?>
                                                            <option value="<?= $responsibility["id"]?>"><?= $responsibility["name"]?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <label for="responsibility">Andraikitra</label>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="mb-3">
                                                    <label class="form-label">Safidio ny kaonty</label>
                                                    <div>
                                                        <?php foreach ($roles as $index => $role): ?>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio" name="role_id" id="role<?= $index ?>" value="<?= $role['id'] ?>" required>
                                                                <label class="form-check-label" for="role<?= $index ?>"><?= $role['name'] ?></label>
                                                            </div>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="d-grid">
                                                    <button class="btn btn-dark btn-lg" type="submit">Hiditra</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
