<?php

function lienOffre($offreId) {
    $html = '<a href=".?page=offre&offreId=' . $offreId . '"><i class="fa fa-eye"></i></a>';
    return $html;
}