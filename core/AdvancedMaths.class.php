<?php

class AdvancedMaths {
	static function interpolate($oldmin, $oldmax, $oldcurrent, $newmin, $newmax) {
		return (
			(
				($oldcurrent-$oldmin)/($oldmax-$oldmin) // Fraction of progress through original
			) * (
				$newmax - $newmin // Translate into new scale
			)
		) + $newmin; // Shift into new scale
	}
}

?>