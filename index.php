<?php
// INDEX PRINCIPAL

// Borra espacios libres
//@ob_start('compress_page');

require('libs/header.php');
require('libs/labels.php');

sound_head();
$filename = CONTENT;if (is_file($filename)) {include($filename);} else {echo '<h1>Error</h1>';}
sound_footer();
?>

<?php
if (ob_get_level() > 0) {
    ob_end_flush();
}

function compress_page($buffer)
{
    $search  = array(
        '/\n/',
        '/\>[^\S ]+/s',
        '/[^\S ]+\</s',
        '/(\s)+/s',
        '!/\*[^*]*\*+([^/][^*]*\*+)*/!',
        '#(?://)?<!\[CDATA\[(.*?)(?://)?\]\]>#s'
    );
    $replace = array(
        ' ',
        '>',
        '<',
        '\\1',
        "//&lt;![CDATA[\n" . '\1' . "\n//]]>",
        "//<![CDATA[\n" . '\1' . "\n//]]>"
    );
    return preg_replace($search, $replace, $buffer);
}
?>

