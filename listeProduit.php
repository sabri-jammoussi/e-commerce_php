<?php
require_once "config.php";
$cnx = new connexion();
$pdo = $cnx->CNXbase();

try {
    $stmt = $pdo->prepare("SELECT *  FROM produits ");
    $stmt->execute();

    $produits = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur de base de données : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        table {
            table-layout: fixed;
            width: 100%;
        }

        th:nth-child(1),
        td:nth-child(1) {
            width: 20%;
        }

        /* Nom */
        th:nth-child(2),
        td:nth-child(2) {
            width: 20%;
        }

        /* Prénom */
        th:nth-child(3),
        td:nth-child(3) {
            width: 30%;
        }

        /* Email */
        th:nth-child(4),
        td:nth-child(4) {
            width: 15%;
        }

        /* Rôle */
        th:nth-child(5),
        td:nth-child(5) {
            width: 15%;
            text-align: center;
        }

        /* Actions */
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="container mt-5">
        <h2 class="mb-4">Liste des produits</h2>
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Nom</th>
                    <th>description</th>
                    <th>Prix</th>
                    <th>image</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($produits)): ?>
                    <?php foreach ($produits as $produit): ?>
                        <tr>
                            <td><?= htmlspecialchars($produit['nom']) ?></td>
                            <td><?= htmlspecialchars($produit['description']) ?></td>
                            <td><?= htmlspecialchars($produit['prix']) ?></td>
                            <td><img src='get_image.php?id=<?= htmlspecialchars($produit['id']) ?>' alt='Image'
                                    style="width:140px; height:120px;">
                            </td>
                            <td>
                                <button class="btn btn-sm edit-btn" data-id="<?= $produit['id'] ?>"
                                    data-nom="<?= htmlspecialchars($produit['nom']) ?>"
                                    data-prenom="<?= htmlspecialchars($produit['description']) ?>"
                                    data-email="<?= htmlspecialchars($produit['prix']) ?>" data-image="" data-bs-toggle="modal"
                                    data-bs-target="#editModal">
                                    <i class="fas fa-edit" style="color: #ffcc00;"></i> <!-- Custom yellow -->
                                </button>

                                <button class="btn btn-sm delete-btn" data-id="<?= $produit['id'] ?>"
                                    data-nom="<?= htmlspecialchars($produit['nom']) ?>" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal">
                                    <i class="fas fa-trash" style="color: #e74c3c;"></i> <!-- Custom red -->
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center text-danger">Aucun produit trouvé</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Modify User Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Modifier le produit</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="update_produit.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="edit-id">
                        <div class="mb-3">
                            <label for="edit-nom" class="form-label">Nom</label>
                            <input type="text" class="form-control" name="nom" id="edit-nom">
                        </div>
                        <div class="mb-3">
                            <label for="edit-prenom" class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="edit-prenom">
                        </div>
                        <div class="mb-3">
                            <label for="edit-email" class="form-label">Prix</label>
                            <input type="number" class="form-control" name="prix" id="edit-email">
                        </div>
                        <div class="mb-3">
                            <label for="edit-image" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="edit-image">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!--  Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirmer la suppression</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="delete_produit.php" method="POST">
                    <div class="modal-body">
                        <p>Voulez-vous vraiment supprimer <strong id="delete-user-name"></strong> ?</p>
                        <input type="hidden" name="id" id="delete-id">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Confirmer la suppression</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Handle edit button click
            document.querySelectorAll(".edit-btn").forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("edit-id").value = this.dataset.id;
                    document.getElementById("edit-nom").value = this.dataset.nom;
                    document.getElementById("edit-prenom").value = this.dataset.prenom;
                    document.getElementById("edit-email").value = this.dataset.email;
                    document.getElementById("edit-role").value = this.dataset.role;
                });
            });
            document.getElementById("edit-image").addEventListener("change", function(event) {
                console.log("Selected file: ", event.target.files[0]);
            });

            // Handle delete button click
            document.querySelectorAll(".delete-btn").forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("delete-id").value = this.dataset.id;
                    document.getElementById("delete-user-name").textContent = this.dataset.nom;
                });
            });
        });
    </script>
</body>

</html>