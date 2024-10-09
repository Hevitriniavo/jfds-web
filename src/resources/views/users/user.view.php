<div class="container-xxl position-relative bg-white d-flex p-0">
    <?= include_component("the-sidebar") ?>

    <div class="content">
        <?= include_component("navbar") ?>

        <div class="container mx-auto mt-4">
            <h2 class="mb-4">Lisitr'ireo mpampiasa</h2>

            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createUserModal">
                    Ampio Mpikambana
                </button>

            </div>


            <table class="table table-striped table-hover table-bordered">
                <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Anarana</th>
                    <th>Fanampin'anarana</th>
                    <th>Adresy</th>
                    <th>Lahy/Vavy</th>
                    <th class="text-center">Asa</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr id="table-row" data-id="<?= $user['id'] ?>"
                        data-first_name="<?= htmlspecialchars($user['first_name'] ?? '', ENT_QUOTES) ?>"
                        data-last_name="<?= htmlspecialchars($user['last_name'] ?? '', ENT_QUOTES) ?>"
                        data-cin="<?= htmlspecialchars($user['cin'] ?? '', ENT_QUOTES) ?>"
                        data-photo="<?= htmlspecialchars($user['photo'] ?? '', ENT_QUOTES) ?>"
                        data-qr_code="<?= htmlspecialchars($user['qr_code'] ?? '', ENT_QUOTES) ?>"
                        data-birth_date="<?= htmlspecialchars($user['birth_date'] ?? '', ENT_QUOTES) ?>"
                        data-address="<?= htmlspecialchars($user['address'] ?? '', ENT_QUOTES) ?>"
                        data-gender="<?= htmlspecialchars($user['gender'] ?? '', ENT_QUOTES) ?>"
                        data-apv="<?= htmlspecialchars($user['apv'] ?? '', ENT_QUOTES) ?>"
                        data-role="<?= htmlspecialchars($user['role_id'] ?? '', ENT_QUOTES) ?>"
                        data-responsibility="<?= htmlspecialchars($user['responsibility_id'] ?? '', ENT_QUOTES) ?>">
                        <td><?= $user['id'] ?></td>
                        <td><?= htmlspecialchars($user['first_name'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['last_name'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['address'] ?? '', ENT_QUOTES) ?></td>
                        <td><?= htmlspecialchars($user['gender'] ?? '', ENT_QUOTES) ?></td>
                        <td class="text-center">
                            <button class="btn btn-sm btn-warning edit-btn d-inline" data-bs-toggle="modal"
                                    data-bs-target="#editUserModal">
                                <i class="bi bi-pencil-fill"></i>
                            </button>
                            <button class="btn btn-sm btn-info add-sacrament-btn" data-bs-toggle="modal"
                                    data-bs-target="#addSacramentModal" data-user-id="<?= $user['id'] ?>">
                                <i class="bi bi-plus-circle-fill"></i> Ampidiro ny sakramenta
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn d-inline" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                <i class="bi bi-trash-fill"></i>
                            </button>
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>


        </div>


        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Mametraha Mpampiasa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="createUserForm" method="post" action="<?= path("users/create") ?>" novalidate
                              enctype="multipart/form-data">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="firstName" class="form-label">Anarana</label>
                                    <input type="text" name="first_name" class="form-control" id="firstName" required>
                                </div>
                                <div class="col">
                                    <label for="lastName" class="form-label">Fanampin'anarana</label>
                                    <input type="text" name="last_name" class="form-control" id="lastName" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="cin" class="form-label">CIN</label>
                                    <input type="text" name="cin" class="form-control" id="cin" required>
                                </div>
                                <div class="col">
                                    <label for="birthDate" class="form-label">Daty nahaterahana</label>
                                    <input type="date" name="birth_date" class="form-control" id="birthDate" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="apv" class="form-label">APV</label>
                                    <input type="text" name="apv" class="form-control" id="apv" required>
                                </div>
                                <div class="col">
                                    <label for="address" class="form-label">Adiresy</label>
                                    <input type="text" name="address" class="form-control" id="address" required>
                                </div>
                                <div class="col">
                                    <label for="responsibility" class="form-label">Andraikitra</label>
                                    <select name="responsibility_id" class="form-select" id="responsibility" required>
                                        <option value="">Safidio</option>
                                        <?php foreach ($responsibilities as $responsibility) : ?>
                                            <option value="<?= $responsibility["id"] ?>"><?= $responsibility["name"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col">
                                    <label for="gender" class="form-label">Lahy/Vavy</label>
                                    <select name="gender" class="form-select" id="gender" required>
                                        <option value="">Safidio</option>
                                        <option value="lehilahy">Lehilahy</option>
                                        <option value="vehivavy">Vehivavy</option>
                                        <option value="hafa">Hafa</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="photo" class="form-label">Sary</label>
                                    <input name="photo" type="file" class="form-control" id="photo" accept="image/*"
                                           required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fanoherana
                                </button>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Mametraha</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Hanova Mpampiasa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editUserForm" method="post" action="<?= path("users/update") ?>" novalidate
                              enctype="multipart/form-data">
                            <input type="hidden" name="id" id="editUserId">
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="editFirstName" class="form-label">Anarana</label>
                                    <input type="text" name="first_name" class="form-control" id="editFirstName"
                                           required>
                                </div>
                                <div class="col">
                                    <label for="editLastName" class="form-label">Fanampin'anarana</label>
                                    <input type="text" name="last_name" class="form-control" id="editLastName" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="editCin" class="form-label">CIN</label>
                                    <input type="text" name="cin" class="form-control" id="editCin" required>
                                </div>
                                <div class="col">
                                    <label for="editBirthDate" class="form-label">Daty nahaterahana</label>
                                    <input type="date" name="birth_date" class="form-control" id="editBirthDate"
                                           required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="editApv" class="form-label">APV</label>
                                    <input type="text" name="apv" class="form-control" id="editApv" required>
                                </div>
                                <div class="col">
                                    <label for="editAddress" class="form-label">Adiresy</label>
                                    <input type="text" name="address" class="form-control" id="editAddress" required>
                                </div>
                                <div class="col">
                                    <label for="editResponsibility" class="form-label">Andraikitra</label>
                                    <select name="responsibility_id" class="form-select" id="editResponsibility"
                                            required>
                                        <option value="">Safidio</option>
                                        <?php foreach ($responsibilities as $responsibility) : ?>
                                            <option value="<?= $responsibility["id"] ?>"><?= $responsibility["name"] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col">
                                    <label for="editGender" class="form-label">Lahy/Vavy</label>
                                    <select name="gender" class="form-select" id="editGender" required>
                                        <option value="">Safidio</option>
                                        <option value="lehilahy">Lehilahy</option>
                                        <option value="vehivavy">Vehivavy</option>
                                        <option value="hafa">Hafa</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="editPhoto" class="form-label">Sary</label>
                                    <input name="photo" type="file" class="form-control" id="editPhoto"
                                           accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fanoherana
                                </button>
                                <button type="submit" class="btn btn-primary" id="editSubmitBtn">Hanova</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="<?= path("users/delete") ?>" method="POST" id="deleteForm">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel">Mba ho azo antoka</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Azonao antoka ve fa tianao hamafana ity mpampiasa ity? Ity hetsika ity dia tsy azo averina.
                            <input type="hidden" name="id" id="deleteUserId">
                            <input type="hidden" name="photo" id="deletePhotoId">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fanoherana</button>
                            <button type="submit" class="btn btn-danger">Fafao</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="detailModalLabel">Détails de l'utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title" id="userName"></h5>
                                <p class="card-text"><strong>ID:</strong> <span id="userId"></span></p>
                                <p class="card-text"><strong>Fanampin'anarana:</strong> <span id="userLastName"></span>
                                </p>
                                <p class="card-text"><strong>CIN:</strong> <span id="userCin"></span></p>
                                <p class="card-text"><strong>Daty nahaterahana:</strong> <span
                                            id="userBirthDate"></span></p>
                                <p class="card-text"><strong>Adresy:</strong> <span id="userAddress"></span></p>
                                <p class="card-text"><strong>Lahy/Vavy:</strong> <span id="userGender"></span></p>
                                <p class="card-text"><strong>APV:</strong> <span id="userApv"></span></p>
                                <p class="card-text"><strong>QR Code:</strong> <span id="userQrCode"></span></p>
                                <p class="card-text"><strong>Asa:</strong> <span id="userRole"></span></p>
                                <p class="card-text"><strong>Andraikitra:</strong> <span id="userResponsibility"></span>
                                </p>
                                <img src="" id="userPhoto" alt="User Photo" class="img-fluid mt-3"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fanoherana</button>
                    </div>
                </div>
            </div>
        </div>



        <div class="modal fade" id="addSacramentModal" tabindex="-1" aria-labelledby="addSacramentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSacramentModalLabel">Ampidiro ny Sakramenta</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addSacramentForm" method="POST" action="<?= path('/user-sacraments/attach') ?>">
                            <input type="hidden" name="user_id" id="sacramentUserId">
                            <div class="mb-3">
                                <label for="sacramentSelect" class="form-label">Sakramenta</label>
                                <select class="form-select" id="sacramentSelect" name="sacrament_id" required>
                                    <option value="" disabled selected>Safidio ny Sakramenta </option>
                                    <?php foreach ($sacraments as $sacrament): ?>
                                        <option value="<?= $sacrament['id'] ?>"><?= htmlspecialchars($sacrament['name'], ENT_QUOTES) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="sacramentDate" class="form-label">Daty Sacramenta</label>
                                <input type="date" class="form-control" id="sacramentDate" name="sacrament_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="sacramentLocation" class="form-label">Toerana</label>
                                <input type="text" class="form-control" id="sacramentLocation" name="location" required placeholder="Aiza no nitranga ny sakramenta?">
                            </div>
                            <button type="submit" class="btn btn-primary">Ampidiro</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


