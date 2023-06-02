<?php

require __DIR__.'/vendor/autoload.php';

use \App\Entity\Pedido;
use NFePHP\DA\NFe\Danfe;

$pedido = Pedido::getPedido($_GET['numpedido']);

$string = $pedido->nf;

$xml = simplexml_load_string( $string,$class_name = "SimpleXMLElement", $options = 0, $ns = "", $is_prefix = false);

$danfe = new Danfe($xml);
$pdf = $danfe->render();

return response($pdf)
->header('Content-Type', 'application/xml');