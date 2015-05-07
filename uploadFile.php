<?php
$upload = $_FILES['userfile'];
// Crucial: Forbid code files
$file_extension = pathinfo( $upload['name'], PATHINFO_EXTENSION );
if( $file_extension != 'jpeg' && $file_extension != 'jpg' && $file_extension != 'png' && $file_extension != 'gif' )
    die("Wrong file extension.");
$filename = 'image-'.md5(microtime(true)).'.'.$file_extension;
$filepath = 'uploads/'.$filename;
$serverpath = $filepath;
move_uploaded_file( $upload['tmp_name'], $filepath );
echo $serverpath;