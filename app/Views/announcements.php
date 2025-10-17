<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Announcements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
</body>
</html>
