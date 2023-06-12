<?php
    require __DIR__.'../vendor/autoload.php';

    //importando as classes

    use App\Entity\Endereco;
    use App\Entity\Item_Pedido;
    use App\Entity\Pedido;
    use App\Entity\Usuario;
    use App\Session\Login;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;


    $mail = new PHPMailer(true);
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';


    $mensagem = '';

    //verifica sessao
    $sessao = Login::getUsuarioLogado();
    

    $pedido = Pedido::getPedido($_GET['numpedido']);

    $pedido->status_pedido = "Pago";

    $pedido->codend = $_GET['codend'];

    $pedidoCodus = $pedido->codus;

    $usuario = Usuario::getUsuarioPorCodus($pedidoCodus);
    $codus = $usuario->codus;

    $nomeUsuario = $usuario->nome;

    $primeiroNome = explode(' ', $nomeUsuario)[0];


    //nfe
    $dados = Pedido::getProdutoporPedido($_GET['numpedido']);
    $cli = Usuario::getUsuarioPorCodus($pedido->codus);

    $end = Endereco::getEndereco($_GET['codend']);

    $serverPort = $_SERVER['SERVER_PORT'];
    $directoryName = basename(__DIR__);

    // Verifica se a porta é diferente da porta padrão do XAMPP (80 para HTTP, 443 para HTTPS)
    if ($serverPort != 80 && $serverPort != 443) {
        $serverPort = ':' . $serverPort;
    } else {
        $serverPort = ''; // Deixa vazio se for a porta padrão
    }

    $linkMeusPedidos = "http://localhost$serverPort/$directoryName/pedido_listar.php?codus=$codus";

    $mensagemEmail = '
          <html>
            <head>
              <style>
                * {
                  padding: 0;
                  margin: 0;
                  box-sizing: border-box;
                }
                /* Estilos opcionais para personalizar o e-mail */
                body {
                  font-family: Arial, sans-serif;
                  -webkit-fonts-smoothing: antialiased;
                }

                .container {
                  width: 100%;
                  text-align: center;
                  margin-left: 64px;

                }

                .background {
                  background-image: url(\'https://i.imgur.com/G39RtYV.png\');
                  background-size: cover;
                  background-position: center;
                  position: relative;

                }

                .overlay {
                  background-color: rgba(0, 0, 0, 0.8); /* Ajuste a opacidade aqui */
                  position: absolute;
                  top: 0;
                  left: 0;
                  right: 0;
                  bottom: 0;
                  padding: 64px;
                }

                .center {
                  text-align: center;
                }

                .title {
                  font-size: 64px;
                  font-weight: bold;
                  color: #137373;
                }

                .subtitle {
                  font-size: 32px;
                  font-weight: bold;
                  margin-top: 20px;
                  color: #137373;
                }

                .message {
                  color: white;
                  margin-top: 32px;
                  font-size: 18px;
                  line-height: 32px;
                }

                .image-container {
                  margin-top: 40px;
                }

                .image {
                  display: block;
                  margin: 0 auto;
                  width: 164px;
                  height: auto;
                }

                .link {
                  cursor: pointer;
                  text-decoration: none;
                }

                a,
                button {
                  cursor: pointer;
                }

                button {
                  transition: all 0.3s;
                  border: none;
                  font-weight: bold;
                  background-color: #137373;
                  color: white;
                  font-size: 16px;
                  padding: 18px 48px;
                  border-radius: 10px;
                  margin: 32px 0;
                }

                button:hover {
                  filter: brightness(1.1);
                }
              </style>
            </head>
            <body>
              <table align="center" border="0" cellpadding="0" cellspacing="0" width="80%">
                <tr>
                  <td align="center" valign="top">
                    <div class="container background">
                      <div class="overlay">
                        <div class="center title">Pet Farma</div>
                        <div class="center image-container">
                          <a href="#">
                            <img
                              src="https://i.imgur.com/4aQEnev.png"
                              alt="Logo Pet-Farma"
                              class="image"
                            />
                          </a>
                        </div>
                        <div class="center subtitle">Pedido finalizado com sucesso!</div>
                        <div class="message">
                        <p>
                            Olá, <strong>' . $primeiroNome . '!</strong><br />
                            Gostaríamos de informar que seu pedido de número #'. $pedido->numpedido . ' foi realizado com sucesso.
                        </p>
                        <p>
                            Para saber mais, acesse a página <strong><a href="'.$linkMeusPedidos.'">Meus pedidos</a></strong>
                        </p>
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              </table>
            </body>
          </html>
        ';

        try {
          // Configuração do servidor SMTP
          $mail->isSMTP();
          $mail->isHTML(true);
          $mail->Host = 'smtp.gmail.com';
          $mail->SMTPAuth = true;
          //Credenciais expostas podem gerar alerta no Github
          $mail->Username = 'petfarma.dev@gmail.com';
          $mail->Password = 'wrxmvjrbsvotmdnv';
          $mail->SMTPSecure = 'tls';
          $mail->Port = 587;

          $mail->setFrom('petfarma.dev@gmail.com', 'Pet Farma');
          $mail->addAddress($usuario->email, $usuario->nome);
          $mail->Subject = 'Confirmação de pedido';
          $mail->Body = $mensagemEmail;
          
          $mail->send();
          $alerta = '<div class="erro" style="margin:15px; text-align:center;">E-mail enviado com sucesso!</div>';

        } catch (Exception $e) {
            $alerta = '<div class="erro" style="margin:15px; text-align:center;">Erro ao enviar e-mail: ' . $mail->ErrorInfo.'</div>';
        }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>
        <NFe xmlns="http://www.portalfiscal.inf.br/nfe">
        <infNFe versao="4.00" Id="NFe35230634785515000166550010000000021180157180">
            <ide>
                <cUF>35</cUF>
                <cNF>18015718</cNF>
                <natOp>Venda de mercadorias</natOp>
                <mod>55</mod>
                <serie>1</serie>
                <nNF>2</nNF>
                <dhEmi>'.date('Y/m/d').'</dhEmi>
                <dhSaiEnt>'.date('Y/m/d').'</dhSaiEnt>
                <tpNF>1</tpNF>
                <idDest>1</idDest>
                <cMunFG>3547809</cMunFG>
                <tpImp>1</tpImp>
                <tpEmis>1</tpEmis>
                <cDV>0</cDV>
                <tpAmb>2</tpAmb>
                <finNFe>1</finNFe>
                <indFinal>1</indFinal>
                <indPres>2</indPres>
                <indIntermed>0</indIntermed>
                <procEmi>0</procEmi>
                <verProc>NFe.io v2.0</verProc>
            </ide>
            <emit>
                <CNPJ>34785515000166</CNPJ>
                <xNome>Pet-Farma</xNome>
                <enderEmit>
                    <xLgr>Rua Marracas</xLgr>
                    <nro>46</nro>
                    <xBairro>Vila Pinheiro</xBairro>
                    <cMun>3547809</cMun>
                    <xMun>Santo Andre</xMun>
                    <UF>SP</UF>
                    <CEP>14940001</CEP>
                    <cPais>1058</cPais>
                    <xPais>Brasil</xPais>
                    <fone>(15)66666-6666</fone>
                </enderEmit>
                <IE>398496865003</IE>
                <CRT>3</CRT>
            </emit>
            <dest>
                <CPF>'.str_replace('-', '',str_replace('.', '',$cli->cpf)).'</CPF>
                <xNome>'.$cli->nome.'</xNome>
                <enderDest>
                    <xLgr>'.$end->rua.'</xLgr>
                    <nro>'.$end->numero.'</nro>
                    <xBairro>'.$end->bairro.'</xBairro>
                    <cMun>3550308</cMun>
                    <xMun>'.$end->cidade.'</xMun>
                    <UF>'.$end->uf.'</UF>
                    <CEP>'.str_replace('-', '', $end->cep).'</CEP>
                    <cPais>1058</cPais>
                    <xPais>Brasil</xPais>
                </enderDest>
                <indIEDest>'.$cli->codus.'</indIEDest>
            </dest>';

            $num = 1;
            foreach($dados as $d){
                $xml .= '<det nItem="'.$num.'">
                        <prod>
                            <cProd>'.$d->codprod.'</cProd>
                            <cEAN>SEM GTIN</cEAN>
                            <xProd>'.$d->nome_prod.'</xProd>
                            <NCM>47079000</NCM>
                            <CFOP>5102</CFOP>
                            <uCom>UN</uCom>
                            <qCom>'.$d->qtde.'.</qCom>
                            <vUnCom>'.$d->preco.'</vUnCom>
                            <vProd>'.$d->preco * $d->qtde.'</vProd>
                            <cEANTrib>SEM GTIN</cEANTrib>
                            <uTrib>UN</uTrib>
                            <qTrib>0.0000</qTrib>
                            <vUnTrib>'.$d->preco.'</vUnTrib>
                            <indTot>1</indTot>
                        </prod>
                        <imposto>
                            <vTotTrib>0.00</vTotTrib>
                            <ICMS>
                            <ICMS20>
                                <orig>0</orig>
                                <CST>20</CST>
                                <modBC>3</modBC>
                                <pRedBC>0.0000</pRedBC>
                                <vBC>0.00</vBC>
                                <pICMS>0.00</pICMS>
                                <vICMS>0.00</vICMS>
                            </ICMS20>
                            </ICMS>
                            <PIS>
                            <PISNT>
                                <CST>06</CST>
                            </PISNT>
                            </PIS>
                            <COFINS>
                            <COFINSNT>
                                <CST>06</CST>
                            </COFINSNT>
                            </COFINS>
                        </imposto>
                    </det>';

                    $num++;
            }


            $xml .= '
            <total>
                <ICMSTot>
                    <vBC>0.0</vBC>
                    <vICMS>0.00</vICMS>
                    <vICMSDeson>0.00</vICMSDeson>
                    <vFCPUFDest>0.00</vFCPUFDest>
                    <vICMSUFDest>0.00</vICMSUFDest>
                    <vICMSUFRemet>0.00</vICMSUFRemet>
                    <vFCP>0.00</vFCP>
                    <vBCST>0.00</vBCST>
                    <vST>0.00</vST>
                    <vFCPST>0.00</vFCPST>
                    <vFCPSTRet>0.00</vFCPSTRet>
                    <vProd>0.00</vProd>
                    <vFrete>0.00</vFrete>
                    <vSeg>0.00</vSeg>
                    <vDesc>0.00</vDesc>
                    <vII>0.00</vII>
                    <vIPI>0.00</vIPI>
                    <vIPIDevol>0.00</vIPIDevol>
                    <vPIS>0.00</vPIS>
                    <vCOFINS>0.00</vCOFINS>
                    <vOutro>0.00</vOutro>
                    <vNF>0.00</vNF>
                    <vTotTrib>0.00</vTotTrib>
                </ICMSTot>
            </total>
            <transp>
                <modFrete>0</modFrete>
                <transporta>
                    <CNPJ>99171171000191</CNPJ>
                    <xNome>Transportadora Maravilha</xNome>
                    <IE>171999999119</IE>
                    <xEnder>Rua Central 100 - Fundos - Distrito Industrial</xEnder>
                    <xMun>SAO PAULO</xMun>
                    <UF>SP</UF>
                </transporta>
                <veicTransp>
                    <placa>BXI1717</placa>
                    <UF>SP</UF>
                    <RNTC>123456789</RNTC>
                </veicTransp>
                <reboque>
                    <placa>BXI1818</placa>
                    <UF>SP</UF>
                    <RNTC>123456789</RNTC>
                </reboque>
            </transp>
            <infRespTec>
                <CNPJ>18792479000101</CNPJ>
                <xContato>Suporte</xContato>
                <email>hackers@nfe.io</email>
                <fone>1140638091</fone>
            </infRespTec>
        </infNFe>
        <Signature xmlns="http://www.w3.org/2000/09/xmldsig#">
            <SignedInfo>
                <CanonicalizationMethod Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
                <SignatureMethod Algorithm="http://www.w3.org/2000/09/xmldsig#rsa-sha1" />
                <Reference URI="#NFe35230634785515000166550010000000021180157180">
                    <Transforms>
                    <Transform Algorithm="http://www.w3.org/2000/09/xmldsig#enveloped-signature" />
                    <Transform Algorithm="http://www.w3.org/TR/2001/REC-xml-c14n-20010315" />
                    </Transforms>
                    <DigestMethod Algorithm="http://www.w3.org/2000/09/xmldsig#sha1" />
                    <DigestValue>8rn2UrgFN2XBmHo57lmedjV5Fkw=</DigestValue>
                </Reference>
            </SignedInfo>
            <SignatureValue>iT2szWwR81N0b7zJVr0N1GVou23W3fQQFjT4LRrgcKLgwfKtWTzJUuEwSDk4yucOz8UsvD2iDwm93XIrH0QxoCdoNIhQJ478kjhFOCzguOhYKXKaNONbyN5NhhP80VddpOYGQes3RMV9QA2boNBrkw0joHDzeek88WXvVskZizhRLFKlqF7jlJcdnuYQ3P1d6BRWp71NVNLznwSxE4ofeIPMfT9aDRTW3DIP/UI0DGJr4fSZfEod7WUG+oWUa1RIDU+MgeHastkGLGp/BDwd2BjIhYnxZx4rsyArAkvBisGJufTz8C1Sn9b8nfk2mo7rj6il77aNhxSzTGhdtv1KhQ==</SignatureValue>
            <KeyInfo>
                <X509Data>
                    <X509Certificate>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</X509Certificate>
                </X509Data>
            </KeyInfo>
        </Signature>
        </NFe>';

        $pedido->nf = $xml;

        $pedido->finalizar();


    include __DIR__.'/public/includes/header.php';
    include __DIR__.'/public/includes/meus_pedidos.php';
    include __DIR__.'/public/includes/footer.php';
?>