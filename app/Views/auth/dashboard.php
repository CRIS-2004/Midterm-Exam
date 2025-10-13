<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?? 'Dashboard - WebSystem' ?></title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: linear-gradient(135deg, #0f2027, #203a43, #2c5364);
      font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
      color: #fff;
    }

    .navbar {
      background: rgba(0, 0, 0, 0.6) !important;
      backdrop-filter: blur(10px);
      border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    }

    .navbar-brand {
      color: #00d4ff !important;
      font-weight: bold;
      text-shadow: 0 0 6px rgba(0, 212, 255, 0.8);
    }

    .navbar-text {
      font-weight: 500;
    }

    .card {
      background: rgba(255, 255, 255, 0.05);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 16px;
      backdrop-filter: blur(12px);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.6);
      transition: transform 0.3s ease;
      color: #fff;
    }

    .card:hover {
      transform: translateY(-6px);
    }

    .card-title {
      color: #00d4ff;
      font-weight: bold;
      text-shadow: 0 0 6px rgba(0, 212, 255, 0.6);
    }

    .card.bg-primary {
      background: linear-gradient(90deg, #00c6ff, #0072ff) !important;
      border: none;
      border-radius: 16px;
      box-shadow: 0 0 16px rgba(0, 212, 255, 0.7);
    }

    .btn-danger {
      border-radius: 12px;
      font-weight: bold;
      box-shadow: 0 0 10px rgba(255, 77, 77, 0.7);
      transition: all 0.3s ease;
    }

    .btn-danger:hover {
      background-color: #ff4d4d;
      transform: scale(1.05);
      box-shadow: 0 0 18px rgba(255, 77, 77, 0.9);
    }

    .alert {
      border-radius: 12px;
    }
  </style>
</head>

<body>
  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="<?= base_url('dashboard') ?>">WebSystem- Parcon Enterprises</a>
      <div class="navbar-nav ms-auto">
        <!-- Display logged-in user's name -->
        <span class="navbar-text text-white me-3">
          <?= ucfirst($user['role']) ?>-
          <?= esc(ucfirst($user['name'])) ?> 
        </span>

        <a href="<?= base_url('logout') ?>" class="btn btn-danger"('Logout?')">Logout</a>
      </div>
    </div>
  </nav>

  <!-- Main Content -->
  <div class="container mt-4">
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success">
        <?= session()->getFlashdata('success') ?>
      </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger">
        <?= session()->getFlashdata('error') ?>
      </div>
    <?php endif; ?>

    <!-- Welcome -->
    <div class="row mb-4">
      <div class="col-12">
        <div class="card bg-primary text-white">
          <div class="card-body text-left">
            <h2>Welcome, <?= ucfirst($user['role']).' '.esc(ucfirst($user['name'])) ?>!</h2>
          </div>
        </div>
      </div>
    </div>
<!-- Role-Based Section -->
<?php $role = $user['role']; ?>

<?php if($role === 'admin'): ?>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Admin Panel</h5>
                    <p>Manage Users and Settings</p>
                </div>
            </div>
        </div>
    </div>
  <?php elseif($role === 'teacher'): ?>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Teacher Panel</h5>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
<?php elseif($role === 'student'): ?>
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card bg-warning text-dark">
                <div class="card-body">
                    <h5>Teacher Panel</h5>
                    <p></p>
                </div>
            </div>
        </div>
    </div>
  <?php endif; ?>

 
   
  </div>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
