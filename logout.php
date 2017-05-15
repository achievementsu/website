<?php

namespace AchievementSu;

setcookie('id', '', time()-3600);
setcookie('password', '', time()-3600);
header('Location: index.php');
