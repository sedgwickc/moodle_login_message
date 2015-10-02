<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.
require_once('../../../config.php');
require_login();
$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('frametop');
$PAGE->set_url('/block/login_msg/welcome/firstaccess.php');
$PAGE->set_title('Rewards Info');
$PAGE->set_heading('Rewards Info');
echo $OUTPUT->header();
?>
<html lang="en"> 
<head>
    <meta charset="utf-8">
    <title>Welcome <?php echo $USER->username;?></title>
    <meta name="welcome_popup" content="welcomes user based on time of last login">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/normalize.css" rel="stylesheet" media="all">
    <link href="css/styles.css" rel="stylesheet" media="all">
</head>
<body>
    <header id="header" role="banner">
    	<h1>Welcome Back <?php echo $USER->username;?>!</h1>
    </header>
    <div id="content" class="wrap">
        <main role="main">
            <section>
                <article id="introduction">
                    <p>Thank you for returning so soon!</p>
					<br>
					<p>
					<iframe class="youtube-video" width="560" height="315" src="https://www.youtube.com/embed/uwlfi6UFSTA" frameborder="0" allowfullscreen></iframe>
					</p>
                </article>
            </section>
        </main>
    </div>
    <footer role="contentinfo">
        <small>Copyright &copy; <time datetime="2015">2015</time></small>
		<br>
        <img class="footer-image" src="images/dura_footer.jpg">
    </footer>
</body>
</html>
