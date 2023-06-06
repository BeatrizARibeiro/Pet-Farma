<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Pedido;
use NFePHP\DA\NFe\Danfe;

$pedido = Pedido::getPedido($_GET['numpedido']);

$string = $pedido->nf;

//$imagem = fopen("C:\xampp\htdocs\Pet-Farma\public\img\logopetfarma.png", 'wb');

//$xml = simplexml_load_string( $string,$class_name = "SimpleXMLElement", $options = 0, $ns = "", $is_prefix = false);

$danfe = new Danfe($string);
$pdf = $danfe->render();

/* header('Content-Type: application/pdf');
header('Content-Disposition: inline; filename="Nfe_imprimir_' .$_GET['numpedido']. '"');
header('Content-Transfer-Encoding; binary');
header('Accept-Ranges; bytes');
readfile($pdf);
exit(0); */



header('Content-Type: application/pdf');
header('Content-Transfer-Encoding; binary');
header('Accept-Ranges; bytes');
echo $pdf;

//header('location: pedido_ver.php?numpedido='.$_GET['numpedido'].'&status=notasalva');

//var_dump($pdf);

/* return response($pdf)
->header('Content-Type', 'application/xml'); */