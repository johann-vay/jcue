<?php

$ficheId = $_GET['ficheId'];

$archive = updateDesarchive($ficheId);

header('Location:.?page=listeFiches');