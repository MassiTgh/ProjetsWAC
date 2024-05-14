<?php
$options = getopt("ri:s" , ["recursive" , "output-image:" , "output-style"]);

//Option r
$rec = isset($options["r"]) || isset($options["recursive"]);

//Option i
if(isset($options["i"]))
{
    $name = $options["i"];
}
elseif(isset($options["output-image"]))
{
    $name = $options["output-image"];
}
else 
{
    $name = "sprite";
}

//Option s
if(isset($options["s"]))
{

}
elseif(isset($options["output-style"]))
{

}
else
{
    $stylename = "style";
}

//Get Arg
for($i=1 ; $i < $argc ; $i++)
{
    $path = $argv[$i];
}

//Recursive
$imagepng = [];
function rec_scan($path)
{
    global $rec;
    global $imagepng;
    $dir = opendir($path);

    while (false !== ($file = readdir($dir))) {
        if ($file == '.' || $file == '..') {
            continue;
        }

        if (is_dir($path . '/' . $file) && $rec) {
            rec_scan($path . '/' . $file);
        } elseif (preg_match('/\.png$/i', $file)) {
            $imagepng[] = $path . '/' . $file;
        }
    }
}
rec_scan($path);
//print_r($imagepng);

//Set/Get Value
$totalL = 0;
$Hmax = 0;
$array = [];
foreach ($imagepng as $value) {
    $img = imagecreatefrompng($value);
    $largeur = imagesx($img);
    $hauteur = imagesy($img);
    $Hmax = max($Hmax, $hauteur);
    $totalL = $largeur + $totalL;
    $array[] = ["image" => $img, "largeur" => $largeur, "hauteur" => $hauteur];
}

//Create Sprite
$background = imagecreatetruecolor($totalL, $Hmax);

//Copy Value on Image
$x = 0;
foreach ($array as $value) {
    imagecopy($background, $value["image"], $x, 0, 0, 0, $value["largeur"], $value["hauteur"]);
    $opacite = imagecolorallocate($background, 0, 0, 127);
    imagecolortransparent($background, $opacite);
    $x = $x + $value["largeur"];
}

//Print Sprite
imagepng($background, "$name.png");
imagedestroy($background);
echo "Sprite crée avec succées\n";