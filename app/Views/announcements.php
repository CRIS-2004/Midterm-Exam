<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= esc($title)?>Student Portal</title>


    <!-- Bootsrap -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fonts for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .announcement { border-bottom: 1px solid #ccc; margin-bottom: 15px; padding-bottom: 10px; }
        .title { font-weight: bold; font-size: 1.2em; }
        .date { color: gray; font-size: 0.9em; }
    </style>
</head>
<body>
    <h1>Announcements</h1>

    <?php if (!empty($announcements)): ?>
        <?php foreach ($announcements as $ann): ?>
            <div class="announcement">
                <div class="title"><?= esc($ann['title']) ?></div>
                <div class="date"><?= date('F j, Y, g:i a', strtotime($ann['created_at'])) ?></div>
                <div class="content"><?= esc($ann['content']) ?></div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No announcements found.</p>
    <?php endif; ?>
</body>
</html>
