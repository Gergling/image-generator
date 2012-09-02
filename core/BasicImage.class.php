<?php

require_once("Colour.class.php");

class BasicImage {
	var $img = null, $truecolour = null, $width = 0, $height = 0;
	var $colour_components = array();
	var $colours = array();
	function __construct($width, $height, $truecolour = false) {
		$this->truecolour = $truecolour;
		$this->width = $width;
		$this->height = $height;
		if ($truecolour) {
			$this->img = imagecreatetruecolor($width, $height);
			imagealphablending($this->getHandle(), false );
			imagesavealpha($this->getHandle(), true);
		} else {
			$this->img = imagecreate($width, $height);
		}
		$this->instantiationHook();
	}
	function instantiationHook() {}
	function allocateColour($component_name, $red, $green, $blue, $alpha = 0) {
		$obj = new Colour($red, $green, $blue, $alpha);
		$res = $obj->allocate($this->img);
		$this->colour_components[$component_name] = array('obj' => $obj, $obj, 'res' => $res, $res, 'name' => $component_name, $component_name);
		return $this->colour_components[$component_name];
	}
	function allocateTransparent($colour_component) {return imagecolortransparent($this->getHandle(),$this->getColourComponent($colour_component, 'res'));}
	function allocateFill($colour_component) {return imagefill($this->getHandle(),0,0,$this->getColourComponent($colour_component, 'res'));}

	function write($filename, $quality = 0) {
		return imagepng( $this->img, $filename , $quality);
	}

	function drawEllipse($cx, $cy, $width, $height, $colour_component) {return imageellipse($this->img, $cx , $cy , $width, $height , $this->getColourComponent($colour_component, 'res'));}
	function drawLine($x1, $y1, $x2, $y2, $colour_component) {return imageline ($this->getHandle(), $x1 , $y1 , $x2 , $y2 , $this->getColourComponent($colour_component, 'res'));}


	function getHandle() {return $this->img;}
	function getWidth() {return $this->width;}
	function getHeight() {return $this->height;}
	function getColourComponent($name, $component) {return $this->colour_components[$name][$component];}
	function getColour($red, $green, $blue, $alpha = 0) {
		if (isset($this->colours[$red][$green][$blue][$alpha])) {
			return $this->colours[$red][$green][$blue][$alpha];
		} else {
			$colour_code = "{$red}-{$green}-{$blue}-{$alpha}";
			$this->colours[$red][$green][$blue][$alpha] = &$this->allocateColour($colour_code, $red, $green, $blue, $alpha);
			return $this->getColour($red, $green, $blue, $alpha);
		}
	}
	function getColourComponents() {return $this->colour_components;}

	function getInterpolatedColour($min, $max, $current, Colour $from, Colour $to) {
		//echo "!: Alpha: ".AdvancedMaths::interpolate($min, $max, $current, $from->getAlpha(), $to->getAlpha())."\n";
		return $this->getColour(
			AdvancedMaths::interpolate($min, $max, $current, $from->getRed(), $to->getRed()),
			AdvancedMaths::interpolate($min, $max, $current, $from->getGreen(), $to->getGreen()),
			AdvancedMaths::interpolate($min, $max, $current, $from->getBlue(), $to->getBlue()),
			AdvancedMaths::interpolate($min, $max, $current, $from->getAlpha(), $to->getAlpha())
		);
	}


	function __destruct() {
		foreach($this->colour_components as $component) {
			imagecolordeallocate($this->img, $component['res']);
		}
		imagedestroy($this->img);
	}
}

?>