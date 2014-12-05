<?php
global $headertext;
$headertext.="<link rel='stylesheet' href='"
    .htmlspecialchars($addon['dir'],ENT_QUOTES)
    ."alertbar.css' type='text/css' />";