<?php 
include_once "isAuthentificated.php";
include "autoloader.php";
$pageTitle="Liste of Students";
include "fragments/header.php";
$db = ConnexionDb::getInstance();
$user= new Student($db);
$students=$user->getAllStudents();

$sectionObj = new Section($db);
$sections = $sectionObj->getListOfSections();
?>

<h2>Liste des étudiants</h2>
<div class="d-flex justify-content-between mb-3">
        <div>
            <a href="addStudent.php" class="btn btn-danger">
                <i class="fas fa-plus"></i> Ajouter un étudiant
            </a>
        </div>
        <div class="d-flex align-items-center">
            <select id="sectionFilter" class="form-select me-2" style="width: 200px;">
                <option value="">Toutes les sections</option>
                <?php foreach ($sections as $section): ?>
                    <option value="<?php echo htmlspecialchars($section['designation']); ?>">
                        <?php echo htmlspecialchars($section['designation']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <button id="filterBtn" class="btn btn-primary">
                <i class="fas fa-filter"></i> Filtrer
            </button>
        </div>
    </div>


    <table  id="studentTable" class="table" style="width:60%">
        <thead>
            <tr>
                <th>id</th>
                <th>image</th>
                <th>name</th>
                <th>birthday</th>
                <th>section</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

        <?php foreach ($students as $student): ?>
            <tr>
                <td ><?php echo $student["id"] ?></td>
                <td><img src="<?php echo $student['image']; ?>" alt="Student image" width="50" height="50" style="border-radius: 50%;"></td>
                <td ><?php echo $student['name'] ?></td>
                <td><?php echo $student['birthday'] ?></td>
                <td><?php echo  $student['section']; ?></td>
                <td>
                    <a href="StudentDetails.php?id=<?= htmlspecialchars($student['id']); ?>"><i class="fas fa-info-circle" style="color: blue; font-size: 20px;"></i></a>
                    <a href="editStudent.php?id=<?= htmlspecialchars($student['id']); ?>" class="me-2" title="Edit">
                                <i class="fas fa-pencil" style="color: blue; font-size: 20px;"></i>
                    </a>
                    <a id="deleteStudent" href="deleteStudent.php?id=<?= htmlspecialchars($student['id']); ?>"  title="Delete">
                                <i class="fas fa-trash" style="color: blue; font-size: 20px;"></i>
                    </a>
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
            let table=$('#studentTable').DataTable({
                dom: 'Bfrtip',
                buttons: ['copy', 'excel', 'csv', 'pdf'],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fr-FR.json' 
                },
                columnDefs: [
                    { orderable: false, targets:5 } 
                ]
            });
            $('#filterBtn').on('click', function() {
                let section = $('#sectionFilter').val();
                if (section === '') {
                    table.column(4).search('').draw(); 
                } else {
                    table.column(4).search(section).draw(); 
                }
            });
        });
        </script>
    </table>
    <?php include "fragments/footer.php"; ?>