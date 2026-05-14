<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

$slug = $_GET['slug'] ?? '';
$id   = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($slug) {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE slug = ? AND published = 1");
    $stmt->execute([$slug]);
} else {
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ? AND published = 1");
    $stmt->execute([$id]);
}

$post = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$post) {
    die("文章不存在");
}

$pdo->prepare("UPDATE posts SET views = views + 1 WHERE id = ?")->execute([$post['id']]);
$post['views']++;
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title><?= e($post['title']) ?> - WindBlade 博客</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/assets/css/dark.css">
    <script src="/assets/js/app.js" defer></script>
</head>

<body>

<div class="navbar navbar-glass">
    <div class="nav-left">
        <a href="/index.php">首页</a>
    </div>
    <div class="nav-right">
        <a href="/admin/login.php">管理后台</a>
    </div>
</div>

<div class="layout">

    <div class="glass fade-up">
        <div class="post-header">
            <div class="post-title-main"><?= e($post['title']) ?></div>
            <div class="post-meta">
                发布于 <?= e(substr($post['created_at'], 0, 16)) ?> · <?= (int)$post['views'] ?> 次浏览
            </div>
        </div>

        <?php if (!empty($post['cover'])): ?>
            <img class="post-cover-large fade-up" style="animation-delay:.08s;" src="<?= e($post['cover']) ?>" alt="">
        <?php endif; ?>

        <div class="post-content fade-up" style="animation-delay:.15s;">
            <?= $post['content'] ?>
        </div>

        <a class="back-link fade-up" style="animation-delay:.22s;" href="/index.php">← 返回首页</a>
    </div>

</div>

<footer class="footer">
    © <?= date('Y') ?> WindBlade · 暗黑毛玻璃博客
</footer>

</body>
</html>
