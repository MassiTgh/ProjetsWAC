<?php
function recupimage()
{
$imagepng = glob("sprite/*.png");
echo implode("\n" , $imagepng) . "\n";
//}
  if(empty($imagepng))
  {
    return "Aucun fichier png trouvé";
  }
    //Count  
    for($i = 0; $i < count($imagepng) ; $i++)
    {
      //Set/Get Value
      $totalL = 0;
      $Hmax = 0;
      $array = [];
      foreach($imagepng as $value)
      {
        $img = imagecreatefrompng($value);
        $largeur = imagesx($img);
        $hauteur = imagesy($img);
        $Hmax = max($Hmax , $hauteur);
        $totalL = $largeur + $totalL;
        $array[] = ["image" => $img , "largeur" => $largeur , "hauteur" => $hauteur];
      }
    
      //Create Sprite
      $background = imagecreatetruecolor($totalL, $Hmax);

      //Copy Value on Image
      $x = 0;
      foreach($array as $value)
      {
        imagecopy($background, $value ["image"], $x, 0, 0, 0, $value ["largeur"], $value ["hauteur"]);
        $opacite = imagecolorallocate($background, 0, 0, 127);
        imagecolortransparent($background, $opacite);
        $x = $x + $value["largeur"];
      }

    //Print Sprite
    imagepng($background, "sprite.png");
    imagedestroy($background);
  }
}
recupimage();
?>