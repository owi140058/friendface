<!DOCTYPE html>
<html>
    <head>
        <title>Account</title>
        <link rel="stylesheet" href="/friendface/web/style/global.css">
    </head>
    <body>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous"></script>
        <div id="banner">
            FRIEND FACE
        </div>
        <header class="well">
            <div class="loggedin">
                <p>You are logged in as {{app.session.get('name') }}</p>
            </div>
            <nav>
                <ul>
                    <li><a href="/friendface/web/settings">SETTINGS</a></li>
                    <li><a href="/friendface/web/friends">FRIENDS</a></li>
                </ul>
            </nav>
        </header>
        <main class="well">
            {% block content %}
            {% endblock %}
        </main>
    </body>
</html>