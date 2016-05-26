<?php

$ficheId = $_GET['ficheId'];
$file = 'ficheSEP'.$ficheId.'.xlsx';
if (file_exists('..\export\\'.$file)){
        header('Content-type:force-download');
        header('Content-Disposition: attachment; filename='.$file);
        readfile('..\export\\'.$file);
        
}