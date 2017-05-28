<?php
/*
 * This file is part of Achievement.su website
 * LICENSE: GNU Affero General Public License, version 3 (AGPLv3)
 * Copyright (C) 2015 - 2017  Achievement.su
 *
 * Achievement.su is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published
 * by the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Contact me: diamond@00744.ru
 */

namespace AchievementSu;
?>
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
