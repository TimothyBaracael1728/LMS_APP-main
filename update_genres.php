<?php
    require_once('classes/database.php');
    $con = new database();
    session_start();
    $sweetAlertConfig = "";

    if (empty($_POST['id'])){
        header('location:index.php');
        exit();
    }else{
    $id = $_POST['id'];
    $data = $con->viewGenresID($id); 
    }

    if(isset($_POST['update_genres'])) {
    $id = $_POST['id'];    
    $genreName = $_POST['genre_name'];

     $genre_update = $con->updateGenre($id, $genreName);
    
    if ($genre_update) {
        $sweetAlertConfig = "
          <script>
            Swal.fire({
              icon: 'success',
              title: 'Update Successful',
              text: 'Genre has been updated successfully!',
              confirmButtonText: 'OK'
            }).then((result) => {
              if (result.isConfirmed) {
                window.location.href = 'admin_homepage.php';
              }
            });
          </script>"; 
      }
  }
?>
    


<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.css">
  <link rel="stylesheet" href="./package/dist/sweetalert2.min.css"> 
  <title>Genres</title>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="admin_homepage.php">Library Management System (Admin)</a>
      <a class="btn btn-outline-light ms-auto active" href="add_authors.php">Add Authors</a>
      <a class="btn btn-outline-light ms-2" href="add_genres.php">Add Genres</a> 
      <a class="btn btn-outline-light ms-2" href="add_books.html">Add Books</a>
      <a class="btn btn-outline-light ms-2" href="logout.php">Logout</a>
      <div class="dropdown ms-2">
        <button class="btn btn-outline-light dropdown-toggle" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          <i class="bi bi-person-circle"></i> <!-- Bootstrap icon -->
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
          <li>
              <a class="dropdown-item" href="profile.html">
                  <i class="bi bi-person-circle me-2"></i> See Profile Information
              </a>
            </li>
          <li>
            <button class="dropdown-item" onclick="updatePersonalInfo()">
              <i class="bi bi-pencil-square me-2"></i> Update Personal Information
            </button>
          </li>
          <li>
            <button class="dropdown-item" onclick="updatePassword()">
              <i class="bi bi-key me-2"></i> Update Password
            </button>
          </li>
          <li>
            <button class="dropdown-item text-danger" onclick="logout()">
              <i class="bi bi-box-arrow-right me-2"></i> Logout
            </button>
          </li>
        </ul>
      </div>
    </div>
  </nav>
<div class="container my-5 border border-2 rounded-3 shadow p-4 bg-light">


  <h4 class="mt-5">Update Existing Genres</h4>
  <form method="post" action="" novalidate>
    <input type="hidden" name="id" value="<?php echo $data['genre_id']?>">
    <div class="mb-3">
      <label for="genresName" class="form-label">Genre Name</label>
      <input type="text" name="genre_name" value="<?php echo $data['genre_name']?>"  class="form-control" id="genresName" required>
    </div>
    <button type="submit" name="update_genres" class="btn btn-primary">Update Genres</button>
  </form>
</div>
<script src="./bootstrap-5.3.3-dist/js/bootstrap.js"></script>
<script src="./package/dist/sweetalert2.min.js"></script>
<?php echo $sweetAlertConfig; ?>
</body>
</html>