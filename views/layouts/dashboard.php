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
        <main class="responsive">
            <nav class="center-align">
                <button class="secondary" data-ui="#nav-drawer">
                    <i>menu</i>
                </button>
                <img class="circle" src="">
                <div class="max">Empty Spaces</div>
                <button class="transparent" id="theme-switch" title="Change Theme">
                    <i>light_mode</i>
                </button>
                <?php if (!Application::is_guest()): ?>
                    <a href="/logout">
                        <button class="tertiary" title="Logout">
                            <i>logout</i>
                        </button>
                    </a>
                <?php endif; ?>
            </nav>
            <dialog class="left" id="nav-drawer">
                <header>
                    <nav>
                        <img class="circle large" src="/favicon.png">
                        <h6 class="max">Empty Spaces</h6>
                        <button class="transparent circle large" data-ui="#nav-drawer">
                            <i>close</i>
                        </button>
                    </nav>
                </header>
                <div class="space"></div>
                <ul class="list">
                    <li class="wave round">
                        <a href="/dashboard">
                            <i>home</i>
                            <span class="max">Dashboard</span>
                        </a>

                    </li>
                    <li class="wave round">
                        <i>inbox</i>
                        <span>Inbox</span>
                        <b>24</b>
                    </li>
                    <li class="wave round">
                        <i>settings</i>
                        <span>Settings</span>
                    </li>
                    <?php if (!Application::is_guest()): ?>
                        <li class="wave round tertiary">
                            <a href="/logout">
                                <i>logout</i>
                                <span>Logout</span>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </dialog>
            <div class="large-space"></div>
            <?php if (Application::$application->session->get_flash('success')): ?>
                <div
                    class="alert alert-success"><?= Application::$application->session->get_flash('success') ?>
                </div>
            <?php endif; ?>
            {{content}}
        </main>
        <script>
            const themeSwitch = document.getElementById('theme-switch');
themeSwitch.addEventListener('click', function () {
document.body.classList.toggle('light');
document.body.classList.toggle('dark');
});
        </script>
        <script type="module" src="https://cdn.jsdelivr.net/npm/beercss@3.13.0/dist/cdn/beer.min.js"></script>
        <script type="module" src="https://cdn.jsdelivr.net/npm/material-dynamic-colors@1.1.2/dist/cdn/material-dynamic-colors.min.js"></script>
    </body>
</html>

