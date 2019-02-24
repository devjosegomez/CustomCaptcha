<?php
    function randomText($length) {
    $pattern = "123456789abcdefghijkmnopqrstuvwxyzABCDEFGHJKLMNPQRSTUVWXYZ";
    for($i = 0; $i < $length; $i++) {
      $key .= $pattern{rand(0,57)};
    }
    return $key;
    }

    session_start();
    $_SESSION['tmptxt'] = randomText(7);
    $height = 110;
    $width = 260;
    $angulo=rand(-13,13);
    $fuente = './fuentes/secret.otf';

    $numeroDeFondo=rand (1, 4);
    $imagenFondo="./fondos/fondo_".$numeroDeFondo.".jpg";
    // Se crea un manejador para una imagen.
	$captcha=imagecreatefromjpeg ($imagenFondo);
    //lineas
    $colLinea = imagecolorallocate($captcha, 173, 229, 234);//blue light
    $colLinea2 = imagecolorallocate($captcha, 0, 255, 5); //green
    $colLinea3 = imagecolorallocate($captcha, 12, 13, 18);//black-gray
    $colLinea4 = imagecolorallocate($captcha, 120, 0, 5); //red
    $colText = imagecolorallocate($captcha, 12, 13, 18);//
    imagefill($captcha, 0, 0, 0);
    imageline($captcha, 0, rand(0,$height), $width, rand(0,$height), $colLinea);
    imageline($captcha, 0, rand(0,$height), $width, rand(0,$height), $colLinea2);
    imageline($captcha, 0, rand(0,$height), $width, rand(0,$height), $colLinea3);
    imageline($captcha, 0, rand(0,$height), $width, rand(0,$height), $colLinea4);
    //puntos
    $pixel_color = imagecolorallocate($image, 245,245,220);
    for($i=0;$i<1000;$i++) {
    imagesetpixel($captcha,rand()%260,rand()%110,$pixel_color);
    }

    //filtro
    imagefilter($captcha, IMG_FILTER_GRAYSCALE);

    imagettftext($captcha, 27, $angulo, 50, 60, $colText, $fuente, $_SESSION['tmptxt']);
    //imagestring($captcha, 25, 16, 7, $_SESSION['tmptxt'], $colText);
    header("Content-type: image/jpeg");
    imagegif($captcha);
    imagedestroy($captcha);
?>