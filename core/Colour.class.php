<?php

class Colour {
	var $red = 0, $green = 0, $blue = 0, $alpha = 0;
	function __construct($red, $green, $blue, $alpha=0) {
		$this->red = $red;
		$this->green = $green;
		$this->blue = $blue;
		$this->alpha = $alpha;
	}
	function getRed() {return $this->red;}
	function getGreen() {return $this->green;}
	function getBlue() {return $this->blue;}
	function getAlpha() {return $this->alpha;}
	function allocate($img) {
		return imagecolorallocatealpha($img, $this->red , $this->green , $this->blue , $this->alpha );
	}
	static function interpolate($min, $max, $current, Colour $from, Colour $to) {
		return new Colour(
			AdvancedMaths::interpolate($min, $max, $current, $from->getRed(), $to->getRed()),
			AdvancedMaths::interpolate($min, $max, $current, $from->getGreen(), $to->getGreen()),
			AdvancedMaths::interpolate($min, $max, $current, $from->getBlue(), $to->getBlue()),
			AdvancedMaths::interpolate($min, $max, $current, $from->getAlpha(), $to->getAlpha())
		);
	}
}