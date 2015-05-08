<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="description" content="Project for Web Basics PHP MVC framework">
        <title>MVC Basics Project</title>
        <link rel="stylesheet" href="/css/bootstrap.min.css">
        <script type="text/javascript" src="/js/jquery.min.js"></script>
    </head>
    <header>
       	<div class="container-fluid">
	   		<div class="navbar-header">
	   			<a href="/" class="navbar-brand">Cool Images Site</a>
	   		</div>
	   		<div class="navbar-collapse collapse" id="navbar">
	   			<ul class="nav navbar-nav">
	   				<li><a href="/Album/Upload">Upload Album</a></li>
		   			<li><a href="/Image/Upload">Upload Image</a></li>
		   			<li><a href="/Images/View">View</a></li>
	   			</ul>
				<div class="nav navbar-nav navbar-right">
				<?php
					if (\Services\Authenticate::get_instance()->is_logged_in()) {
						echo "Welcome, " . $_SESSION['user_name'] . "!";
					} else {
						echo "Welcome, Guest, Would you like to " .
						'<a href="/Account/Register">Register</a>?';
					}
				?>
				</div>
	   			<ul class="nav navbar-nav navbar-right">
	   				<?php
						if (\Services\Authenticate::get_instance()->is_logged_in()) {
							echo '<li><a href="/Account/Logout">Logout</a></li>' .
							'<li><a href="/Account/Profile">Profile</a></li>';
						}
					?>
	   			</ul>
	   		</div>
	   	</div>
    </header>