<?php

declare(strict_types=1);

$basePath = dirname(__DIR__);
$autoload = $basePath.'/vendor/autoload.php';

if (!file_exists($autoload)) {
    $uri = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';

    $threads = [
        [
            'slug' => 'welcome-to-forumos',
            'title' => 'Welcome to ForumOS',
            'author' => 'system',
            'excerpt' => 'This standalone preview is shown when dependencies are not installed.',
            'body' => 'ForumOS can run in full Laravel mode after dependency installation. Meanwhile, this preview prevents a not-found dead end and shows the intended UI direction.',
            'tags' => ['announcement', 'getting-started'],
        ],
        [
            'slug' => 'ai-moderation-overview',
            'title' => 'AI moderation overview',
            'author' => 'moderator',
            'excerpt' => 'Toxicity scoring, suggestions, and summarization are wired in service classes.',
            'body' => 'In full mode, AI services call provider APIs configured in .env. Keep API keys server-side and use strict rate limits for abuse prevention.',
            'tags' => ['ai', 'security'],
        ],
    ];

    $selected = null;
    $notFound = false;
    foreach ($threads as $thread) {
        if ($uri === '/thread/'.$thread['slug']) {
            $selected = $thread;
            break;
        }
    }

    if ($uri !== '/' && !$selected) {
        $notFound = true;
        http_response_code(404);
    }

    $title = $selected ? $selected['title'].' · ForumOS Preview' : 'ForumOS Preview';
    header('Content-Type: text/html; charset=utf-8');
    ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?= htmlspecialchars($title, ENT_QUOTES) ?></title>
    <style>
        :root { color-scheme: dark light; }
        body { font-family: Inter, -apple-system, BlinkMacSystemFont, Segoe UI, sans-serif; margin:0; background:radial-gradient(circle at top right,#312e81 0,#0f172a 45%,#020617 100%); color:#e2e8f0; min-height:100vh; }
        .wrap { max-width: 1080px; margin: 0 auto; padding: 2rem 1rem 2rem; }
        .glass { background:rgba(15,23,42,.55); border:1px solid rgba(148,163,184,.3); border-radius:20px; backdrop-filter: blur(14px); box-shadow:0 12px 35px rgba(15,23,42,.4); }
        .header { display:flex; justify-content:space-between; align-items:center; gap:1rem; margin-bottom:1rem; }
        .brand { font-weight:700; font-size:1.2rem; text-decoration:none; color:#f8fafc; }
        .pill { font-size:.8rem; padding:.3rem .55rem; border-radius:999px; background:#1d4ed8; color:white; text-decoration:none; }
        .hero { margin-bottom:1rem; padding:.9rem 1rem; }
        .grid { display:grid; grid-template-columns: 2fr 1fr; gap:1rem; align-items:start; }
        .card { padding:1rem 1.1rem; margin-bottom:.8rem; text-decoration:none; color:inherit; display:block; }
        .command-list { list-style:none; padding:0; margin:.55rem 0 0; }
        .command-list li { margin:.42rem 0; padding:.42rem .55rem; border-radius:10px; background:rgba(15,23,42,.75); border:1px solid rgba(148,163,184,.18); display:flex; gap:.5rem; align-items:flex-start; }
        .cmd-no { color:#93c5fd; width:1.1rem; font-weight:700; }
        .cmd-text { font-family: ui-monospace,SFMono-Regular,Menlo,Monaco,Consolas,Liberation Mono,monospace; color:#e2e8f0; font-size:.95rem; }
        .meta { opacity:.82; font-size:.96rem; margin:.3rem 0; line-height:1.35; }
        .tag { display:inline-block; margin-right:.4rem; margin-top:.5rem; padding:.2rem .5rem; border-radius:999px; background:rgba(51,65,85,.8); font-size:.76rem; }
        code { background:#0f172a; border-radius:7px; padding:.2rem .35rem; }
        ol { margin:0; padding-left:1.2rem; }
        li { margin:.45rem 0; }
        .footer { opacity:.75; font-size:.82rem; margin-top:.35rem; }
        .aside-note { font-size:.95rem; }
        @media (max-width: 900px){ .grid{ grid-template-columns:1fr; } }
    </style>
</head>
<body>
<div class="wrap">
    <header class="header">
        <a class="brand" href="/">ForumOS</a>
        <span class="pill">Fallback UI</span>
    </header>

    <section class="glass hero">
        <strong>Preview mode active.</strong>
        <span class="meta">This renders only when dependencies are missing, so the project remains browsable instead of failing with “not found”.</span>
    </section>

    <div class="grid">
        <main>
            <?php if ($notFound): ?>
                <article class="glass card">
                    <h1>Thread not found</h1>
                    <p class="meta">The requested preview thread does not exist.</p>
                    <p><a href="/" style="color:#93c5fd">← Back to threads</a></p>
                </article>
            <?php elseif ($selected): ?>
                <article class="glass card">
                    <h1><?= htmlspecialchars($selected['title'], ENT_QUOTES) ?></h1>
                    <p class="meta">By <?= htmlspecialchars($selected['author'], ENT_QUOTES) ?></p>
                    <p><?= htmlspecialchars($selected['body'], ENT_QUOTES) ?></p>
                    <?php foreach ($selected['tags'] as $tag): ?><span class="tag">#<?= htmlspecialchars($tag, ENT_QUOTES) ?></span><?php endforeach; ?>
                    <p class="meta" style="margin-top:1rem;"><a href="/" style="color:#93c5fd">← Back to threads</a></p>
                </article>
            <?php else: ?>
                <?php foreach ($threads as $thread): ?>
                    <a class="glass card" href="/thread/<?= rawurlencode($thread['slug']) ?>">
                        <h2 style="margin:.2rem 0;"><?= htmlspecialchars($thread['title'], ENT_QUOTES) ?></h2>
                        <p class="meta">By <?= htmlspecialchars($thread['author'], ENT_QUOTES) ?></p>
                        <p><?= htmlspecialchars($thread['excerpt'], ENT_QUOTES) ?></p>
                    </a>
                <?php endforeach; ?>
            <?php endif; ?>
        </main>

        <aside class="glass card">
            <h3 style="margin-top:0;">Enable Full Laravel Mode</h3>
            <p class="meta">Run the following commands in order:</p>
            <ul class="command-list">
                <li><span class="cmd-no">1.</span><span class="cmd-text">composer install</span></li>
                <li><span class="cmd-no">2.</span><span class="cmd-text">cp .env.example .env</span></li>
                <li><span class="cmd-no">3.</span><span class="cmd-text">php artisan key:generate</span></li>
                <li><span class="cmd-no">4.</span><span class="cmd-text">php artisan migrate --seed</span></li>
                <li><span class="cmd-no">5.</span><span class="cmd-text">php -S 127.0.0.1:8000 -t public</span></li>
            </ul>
            <p class="meta aside-note" style="margin-top:1rem;">This fallback avoids “not found” and gives a usable preview until dependencies are available.</p>
        </aside>
    </div>
    <p class="footer">ForumOS preview • install dependencies for full Laravel + Livewire + Reverb functionality.</p>
</div>
</body>
</html>
<?php
    exit;
}

require $autoload;

$app = require_once $basePath.'/bootstrap/app.php';

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);
