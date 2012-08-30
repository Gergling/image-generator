<?php

class Crosshairs extends BasicImage {
	function instantiationHook() {
		// Draw circle
		$this->allocateColour('transparent', 0, 0, 0);
		//imagecolortransparent($this->getHandle(),$this->getColourComponent('transparent', 'res'));
		//imagefill($this->getHandle(),0,0,$this->getColourComponent('transparent', 'res')); 
		$this->allocateTransparent('transparent');
		$this->allocateFill('transparent');

		// Tidy up these functions - wrap them in class.
		// Add appropriate lines for crosshairs graphic.

		$centre_distance = 2;

		$this->allocateColour('red', 255, 0, 0);
		$this->drawLine(0, floor($this->getHeight()/2), floor($this->getWidth()/2)-$centre_distance, floor($this->getHeight()/2), 'red'); // Left
		$this->drawLine($this->getWidth(), floor($this->getHeight()/2), floor($this->getWidth()/2)+$centre_distance, floor($this->getHeight()/2), 'red'); // Right
		$this->drawLine(floor($this->getWidth()/2), 0, floor($this->getWidth()/2), floor($this->getHeight()/2)-$centre_distance, 'red'); // Top
		$this->drawLine(floor($this->getWidth()/2), $this->getHeight(), floor($this->getWidth()/2), floor($this->getHeight()/2)+$centre_distance, 'red'); // Bottom

		$this->drawEllipse(floor($this->getWidth()/2), floor($this->getHeight()/2), $this->getWidth(), $this->getHeight(), 'red');
		//$this->drawEllipse(floor($this->getWidth()/2), floor($this->getHeight()/2), floor($this->getWidth()/2)+3, floor($this->getHeight()/2)+3, 'red');
	}
}

?>