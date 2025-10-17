<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Student Portal</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Custom styling for announcements page */
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .announcement-container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        
        .announcement-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 20px;
            padding: 25px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .announcement-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
        }
        
        .announcement-title {
            color: #667eea;
            font-weight: bold;
            font-size: 1.5rem;
            margin-bottom: 15px;
        }
        
        .announcement-content {
            color: #555;
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 15px;
        }
        
        .announcement-date {
            color: #999;
            font-size: 0.9rem;
            font-style: italic;
        }
        
        .page-header {
            background: white;
            border-radius: 15px;
            padding: 30px;
            margin-bottom: 30px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state {
            background: white;
            border-radius: 15px;
            padding: 60px 30px;
            text-align: center;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }
        
        .empty-state i {
            font-size: 4rem;
            color: #ccc;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
 <div class="container mt-5">
    <h2>Announcements</h2>
    <?php if (!empty($announcements)) : ?>
        <ul class="list-group mt-3">
            <?php foreach ($announcements as $announcement) : ?>
                <li class="list-group-item">
                    <h5><?= esc($announcement['title']); ?></h5>
                    <p><?= esc($announcement['content']); ?></p>
                    <small>Posted on: <?= esc($announcement['created_at']); ?></small>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No announcements yet.</p>
    <?php endif; ?>
</div>

    <!-- Bootstrap 5 JS Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>