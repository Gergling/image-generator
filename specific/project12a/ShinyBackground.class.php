<?php

class ShinyBackground extends BasicImage {
	function instantiationHook() {
		// Colours
		$white = $this->getColour(255, 255, 255, 31);
		$white_transparent = $this->getColour(255, 255, 255, 100);
		$black = $this->getColour(0, 0, 0, 31);
		$black_transparent = $this->getColour(0, 0, 0, 127);

		$this->allocateColour('transparent', 255, 255, 255);

		// Start from about halfway down the image
		$y_top = 0;
		$y_middle = AdvancedMaths::interpolate(0, 100, 55, 0, $this->getHeight());
		$y_bottom = $this->getHeight();
		
		// Above the line
		for($y = $y_middle;$y < $y_bottom;$y++) {
			list($obj, $res, $name) = $this->getInterpolatedColour($y_middle, $y_bottom, $y, $black_transparent['obj'], $black['obj']);
			$this->drawLine(0, $y, $this->getWidth(), $y, $name);
		}

		// Below the line
		for($y = $y_middle;$y >= $y_top;$y--) {
			list($obj, $res, $name) = $this->getInterpolatedColour($y_middle, $y_top, $y, $white_transparent['obj'], $white['obj']);
			$this->drawLine(0, $y, $this->getWidth(), $y, $name);
		}

		// Could do another one where the fade happens in both directions, but doesn't go as opaque downwards.
	}

	// Split up components so that inheritance can take place
	// - Set the colours, store them here
	// - Set the dimensions: top, middle, bottom
	// - Draw the upper/lower parts
	// In here we can run them in order, but potentially we need to be able to run the individual components
	// For one thing we want to make a panel with specialised shine and borders, about 120x120.
	// Will need to create white partial overlay symbols for listing and special, potentially...
}

?>