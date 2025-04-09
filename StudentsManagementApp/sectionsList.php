<?php 
include_once "isAuthentificated.php";
include "autoloader.php";
$pageTitle="Liste of sections";
include "fragments/header.php";
$db = ConnexionDb::getInstance();
$sectionObj= new Section($db);
$sections=$sectionObj->getListOfSections();

?>

<h2>Liste des sections</h2>
    <table  id="sectionTable" class="table" style="width:60%">
        <thead>
            <tr>
                <th>id</th>
                <th>designation</th>
                <th>description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($sections as $section): ?>
            <tr>
                <td ><?php echo $section["id"] ?></td>
                <td ><?php echo $section['designation'] ?></td>
                <td><?php echo $section['description'] ?></td>
                <td>
                    <div class="dropdown">
                                <button class="btn btn-link p-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-ellipsis-h" style="color: blue; font-size: 20px;"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="viewSection.php?id=<?= htmlspecialchars($section['id']); ?>">Voir</a></li>
                                    <li><a class="dropdown-item" href="editSection.php?id=<?= htmlspecialchars($section['id']); ?>">Modifier</a></li>
                                    <li><a class="dropdown-item" href="deleteSection.php?id=<?= htmlspecialchars($section['id']); ?>" >Supprimer</a></li>
                                </ul>
                    </div>
                </td>
                
            </tr>
        <?php endforeach ?>
        </tbody>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

        <script>
        $(document).ready(function() {
            $('#sectionTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'pdf'],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json' 
                },
                columnDefs: [
                    { orderable: false, targets: 3 } 
                ]
            });
        });
        </script>
    </table>
    <?php include "fragments/footer.php"; ?>