<?php

function lienPostuler($offreId){
     $html = '<a class="btn btn-default" href=".?page=postuler&offreId=' . $offreId . '">Postuler</a>';
    return $html;
}