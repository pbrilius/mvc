<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/favicon.ico" type="image/x-icon">
    <title><?= $this->e($title ?? 'Prototype MVC') ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: system-ui, sans-serif; line-height: 1.6; }
        .container { max-width: 1200px; margin: 0 auto; padding: 20px; }
        header { background: #333; color: #fff; padding: 1rem; }
        header a { color: #fff; text-decoration: none; margin-right: 1rem; }
        main { padding: 2rem 0; }
    </style>
</head>
<body>
    <header>
        <div class="container">
            <a href="/">Home</a>
            <a href="/about">About</a>
        </div>
    </header>
    <main>
        <div class="container">
            <?= $content ?>
        </div>
    </main>
</body>
</html>
