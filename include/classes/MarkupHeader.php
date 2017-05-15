<?php namespace AchievementSu; ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title><?php global $title; echo $title; ?> на Achievement.su</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="wrapper">
        <div id="header">
            <div id="header-wrapper">
                <div id="header-logo"></div>
                <?php Markup::getHeaderMenu(); ?>
            </div>
        </div>
        <div id="content">
            <div id="content-wrapper">
                <?php
                global $showSidebar;
                if ($showSidebar == true) {
                    require 'MarkupSidebar.php';
                    echo '<div id="content-main" class="content-main-sidebar">';
                } else {
                    echo '<div id="content-main" class="content-main-wide">';
                }
                ?>
