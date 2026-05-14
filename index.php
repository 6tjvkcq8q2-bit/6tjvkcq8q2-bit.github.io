<?php
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/functions.php';

$stmt = $pdo->query("SELECT id, title, slug, cover, views, created_at FROM posts WHERE published = 1 ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <title>WindBlade 博客</title>
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

    <div class="glass hero fade-up">
        <div class="hero-title">WindBlade 博客</div>
        <div class="hero-sub">极简 · 暗黑 · 毛玻璃 · 高级质感</div>
    </div>

    <div class="glass fade-up">
        <h2>最新文章</h2>

        <?php if (empty($posts)): ?>
            <p style="color:var(--text-muted);font-size:14px;">暂无文章。</p>
        <?php else: ?>
            <div class="post-grid">
                <?php foreach ($posts as $p): ?>
                    <a class="post-card glass fade-up" href="/post.php?slug=<?= e($p['slug']) ?>">
                        <?php if (!empty($p['cover'])): ?>
                            <img class="post-cover" src="<?= e($p['cover']) ?>" alt="">
                        <?php endif; ?>

                        <div class="post-info">
                            <div class="post-title"><?= e($p['title']) ?></div>
                            <div class="post-meta">
                                <?= e(substr($p['created_at'], 0, 16)) ?> · <?= (int)$p['views'] ?> 次浏览
                            </div>
                        </div>
                    </a>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

</div>

<footer class="footer">
    © <?= date('Y') ?> WindBlade · 暗黑毛玻璃博客
</footer>

</body>
</html>
