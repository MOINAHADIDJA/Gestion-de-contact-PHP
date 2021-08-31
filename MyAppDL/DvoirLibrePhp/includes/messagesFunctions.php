<?php




/**
 * Construit un message d'erreur
 */
function errorMsg($text, $type = 2)
{
    if ($type == 1) {
        return '<p class="text-danger">' . $text . '</p>';
    }
    return '<div class="alert alert-danger col-md-6" role="alert">' . $text . '</div>';
}

/**
 * Construit un message de succès
 */
function okMsg($text, $type = 2)
{
    if ($type == 1) {
        return '<p class="text-success">' . $text . '</p>';
    }

    return '<div class="alert alert-success col-md-6" role="alert">' . $text . '</div>';
}


