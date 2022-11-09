<?php
header('content-type: text/css');
ob_start('ob_gzhandler');
header('Cache-Control: max-age=31536000, must-revalidate');
// etc.
?>
<?php
$couleur_texte='#fc4022';
?>
body {
color:<?php echo $couleur_texte; ?>;
}
#page {
color:<?php echo $couleur_texte; ?>;
}
