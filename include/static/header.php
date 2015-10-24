<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php global $title; echo $title; ?> на Achievement.su</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="header-wrapper">
				<div id="header-logo"></div>
				<nav id="header-menu">
					<ul>
						<li><a href="feed.php"<?php Markup::header_link_backlight('feed'); ?>>Лента</a></li>
						<li><a href="friends.php"<?php Markup::header_link_backlight('friends'); ?>>Друзья</a></li>
						<li><a href="profile.php"<?php Markup::header_link_backlight('profile'); ?>>Diamond00744</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div id="content">
			<div id="content-wrapper">
				<?php require 'sidebar.php'; ?>
				<div id="content-main">
