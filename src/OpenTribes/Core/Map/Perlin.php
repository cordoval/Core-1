<?php

namespace OpenTribes\Core\Map;

class Perlin{
  private $persistence = .15;
  private $octaves = -1;
  private $random = array();

  public function __construct(){

      for($i = 0;$i<3;$i++){
           $start = $i * 1000;
           $end = ($start+1) * 1000;
           $this->random[$i] = gmp_nextprime(mt_rand($start,$end));
      }
    
     

  }

  public function perlinNoise2d($x, $y){
    $total = 0;
    $p = $this->persistence;
    $n = $this->octaves - 1;
    for ($i = 0; $i < $n; $i++){
      $frequency = pow(2, $i);
      $amplitude = pow($p, $i);
      $total  += $this->interpolatedNoise($x * $frequency, $y * $frequency) * $amplitude;
    }
    return $total;
  }

  private function interpolatedNoise($x, $y){
    $integer_X    = (int)$x;
    $fractional_X = $x - $integer_X;

    $integer_Y    = (int)$y;
    $fractional_Y = $y - $integer_Y;

    $v1 = $this->smoothedNoise($integer_X,     $integer_Y);
    $v2 = $this->smoothedNoise($integer_X + 1, $integer_Y);
    $v3 = $this->smoothedNoise($integer_X,     $integer_Y + 1);
    $v4 = $this->smoothedNoise($integer_X + 1, $integer_Y + 1);

    $i1 = $this->interpolate($v1 , $v2 , $fractional_X);
    $i2 = $this->interpolate($v3 , $v4 , $fractional_X);

    return $this->interpolate($i1 , $i2 , $fractional_Y);
  }

  private function smoothedNoise($x, $y){
    $corners = ( $this->noise($x-1, $y-1)+$this->noise($x+1, $y-1)+$this->noise($x-1, $y+1)+$this->noise($x+1, $y+1) ) / 16;
    $sides   = ( $this->noise($x-1, $y)  +$this->noise($x+1, $y)  +$this->noise($x, $y-1)  +$this->noise($x, $y+1) ) /  8;
    $center  =  $this->noise($x, $y) / 4;
    return $corners + $sides + $center;
  }

 private  function noise($x,$y){
    $x = (int)$x;
    $y = (int)$y;
    $n = $x + $y * 57;
    $n = ($n << 13) ^ $n;
 
    return (1.0 - ($n*($n*$n*$this->random[0]+$this->random[1])+$this->random[3] & 0x7ffffff) / 1073741824.0);
  }

 public function interpolate($a, $b, $x){
     $ft = $x* 3.1415927;
     $f = (1- cos($ft)) * 0.5;
     return $a*(1-$f)+$b*$f;

  }
}