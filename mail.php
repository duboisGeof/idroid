<?php

$headers  = "MIME-Version: 1.0\r\n";
$headers .= 'FROM: "geoffrey-dubois.fr" <dubois.gdc@gmail.com>'."\n";
$headers .= 'Content-Type: text/html; charset="utf-8"' ."\n";
$headers .= 'Content-Transfer-Encoding: 8bit';

$message='
<html>
    <body>
        <div align="center">
            j\'ai envoy� ce mail avec php
        </div>
    </body>
</html>
';

mail("dubois.geof@gmail.com", "Salut", $message, $headers);