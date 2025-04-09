<?php 
    include "fragments/header.php" ;
    include_once "isAuthentificated.php" ;
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Students Management System</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="StudentsList.php">Liste des étudiants</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="sectionsList.php">Liste des sections</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
      
    </ul>
    
  </div>
</nav>

<h1> HELLO ,PHP LOVERS ! Welcome to you Adminstration Platform</h1>

<?php include 'fragments/footer.php' ?>