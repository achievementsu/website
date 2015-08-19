<?php
	function header_link_backlight($link) {
		global $current_page;
		if ($link == $current_page) {
			echo 'class="here"';
		}
	}
?>

﻿<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?php echo $title; ?> - Achievement.su</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div id="header-wrapper">
				<div id="header-logo"></div>
				<nav id="header-menu">
					<ul>
						<li><a href="feed.php" <?php header_link_backlight('feed'); ?>>Лента</a></li>
						<li><a href="friends.php" <?php header_link_backlight('friends'); ?>>Друзья</a></li>
						<li><a href="profile.php" <?php header_link_backlight('profile'); ?>>Профиль</a></li>
					</ul>
				</nav>
			</div>
		</div>
		<div id="content">
			<div id="content-wrapper">
				<?php require 'sidebar.php'; ?>
				<div id="content-main">
