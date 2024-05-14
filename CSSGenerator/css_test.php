<?php
//BACKGROUND
header("Content-type: sprite/png");
$image = imagecreatetruecolor(400, 200);
imagesavealpha($image, true);
$color = imagecolorallocatealpha($image, 0, 0, 0, 0);
imagefill($image, 0, 0, $color);

//PNG1
$imagePLUME = imagecreatefrompng('sprite/PLUME.png');
imagecopyresampled($image, $imagePLUME, 0, 0, 0, 0, 100, 100, 739, 1080);

//PNG2
$imageGIGI = imagecreatefrompng('sprite/GIGI.png');
imagecopyresampled($image, $imageGIGI, 100, 0, 0, 0, 100, 100, 1000, 671);

//PNG3
$imagePILAF = imagecreatefrompng('sprite/PILAF.png');
imagecopyresampled($image, $imagePILAF, 200, 0, 0, 0, 100, 100, 745, 1073);

//PNG4
$imageOOLONG = imagecreatefrompng('sprite/OOLONG.png');
imagecopyresampled($image, $imageOOLONG, 300, 0, 0, 0, 100, 100, 876, 1600);

//PRINT BACKGROUND
imagepng($image, "sprite.png");
imagedestroy($image);
?>