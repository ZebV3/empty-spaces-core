<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link href="https://cdn.jsdelivr.net/npm/beercss@3.13.0/dist/cdn/beer.min.css" rel="stylesheet"/>
        <title><?= $this->title ?></title>
    </head>
    <body>
        <header class="fixed center-align min">
            <div class="margin">
                <nav class="toolbar secondary elevate min">
                    <img src="" alt="">
                    <a class="button transparent circle" title="Home" href="/">
                        <i>home</i>
                    </a>
                    <a class="button transparent circle" title="About" href="/about">
                        <i>info</i>
                    </a>
                    <a class="button transparent circle" title="Contact" href="/contact">
                        <i>call</i>
                    </a>
                    <a class="button transparent circle" href="/login">
                        <i>login</i>
                    </a>
                    <button id="theme-switch" class="transparent circle" title="Change Theme">
                        <i>light_mode</i>
                    </button>
                </nav>
            </div>
        </header>
        <main class="responsive">
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

