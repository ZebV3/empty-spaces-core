<?php
use app\core\Application;
?>

<!doctype html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/beercss@3.13.0/dist/cdn/beer.min.css" rel="stylesheet"/>
        <title><?= $this->title ?></title>
    </head>

    <body>
        <nav class="bottom group connected">

            <a class="border left-round vertical" href="/login">
                <i>login</i>
                <span>Login</span>
            </a>
            <a class="border no-round vertical" href="/">
                <i>home</i>
                <span>Home</span>
            </a>
            <a class="border right-round vertical" href="/register">
                <i>person_add</i>
                <span>Register</span>
            </a>
        </nav>
        <main
            class="responsive center-align">
            <?php if (Application::$application->session->get_flash('success')): ?>
                <div
                    class="alert alert-success"><?= Application::$application->session->get_flash('success') ?>
                </div>
            <?php endif; ?>
            {{content}}
        </main>
        <script type="module" src="https://cdn.jsdelivr.net/npm/beercss@3.13.0/dist/cdn/beer.min.js"></script>
        <script type="module" src="https://cdn.jsdelivr.net/npm/material-dynamic-colors@1.1.2/dist/cdn/material-dynamic-colors.min.js"></script>
    </body>
</html>

