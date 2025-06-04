<?php
require_once 'authentication/admin-class.php';

if(!isset($_SESSION['adminSession'])){
    echo "<script>alert('Please logged in!'); window.location.href='../../';</script>";
    exit;
}

$admin = new ADMIN();

$stmt = $admin->runQuery("SELECT * FROM user WHERE id = :id");
$stmt->execute(array(":id"=>$_SESSION['adminSession']));
$user_data = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
/* Minimal Bootstrap-like styles */
.btn {
  display: inline-block;
  font-weight: 400;
  text-align: center;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  color: #fff;
  background-color:rgb(13, 197, 253);
  border: 1px solid #0d6efd;
  border-radius: 0.375rem;
  text-decoration: none;
}

.btn:hover {
  background-color:rgb(27, 210, 223);
  border-color: #0a58ca;
}

.form-control {
  display: block;
  width: 100%;
  padding: 0.375rem 0.75rem;
  font-size: 1rem;
  line-height: 1.5;
  border: 1px solid #ced4da;
  border-radius: 0.375rem;
}

.container {
  max-width: 960px;
  margin: 0 auto;
  padding: 1rem;
}
</style>

</head>
<body class="bg-light">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <div class="d-flex align-items-center">
                    <span class="text-white me-3">
                        <i class="bi bi-person-circle me-1"></i>
                        <?php echo htmlspecialchars($user_data['email']); ?>
                    </span>
                    <a href="authentication/admin-class.php?admin_signout" class="btn btn-light btn-sm">
                        <i class="bi bi-box-arrow-right me-1"></i>Sign Out
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <div class="container py-4">
        <div class="row mb-4">
            <div class="col">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4">
                        <h2 class="card-title">Welcome, <?php echo htmlspecialchars($user_data['username']); ?>!</h2>
                        <p class="card-text text-muted">
                            You are logged in as <strong><?php echo htmlspecialchars($user_data['email']); ?></strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>