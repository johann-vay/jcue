<?php 

$id = $_GET['ficheId'];
$extensions = ['.csv', '.xls', '.xlsx', '.xlsm', '.pdf'];
$fichier = 'fichierImportFiche'.$id;

foreach ($extensions as $extension){
    if (file_exists('..\upload\\'.$fichier.$extension)){
        header('Content-type:force-download');
        header('Content-Disposition: attachment; filename='.$fichier.$extension);
        readfile('..\upload\\'.$fichier.$extension);
    }
}