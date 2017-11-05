<?php
//linear-gradient(45deg, #a00adb 0%,#00e58d 100%);
class ColorManager
{
  public function getRandomHexColor () {
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);

    return $this->rgbToHex($red, $green, $blue);
  }

  private function rgbToHex ($red, $green, $blue) {
    $red = $this->checkIsSingleDigit(dechex($red));
    $green = $this->checkIsSingleDigit(dechex($green));
    $blue = $this->checkIsSingleDigit(dechex($blue));
    return "#${red}${green}${blue}";
  }

  private function checkIsSingleDigit ($value) {
    if(strlen($value) === 1) {
      return $value . $value;
    } else {
      return $value;
    }
  }

}
