<?php
/**
 * Extended formatter.
 *
 * @author serj
 */
class Formatter extends CFormatter {

	public function formatFloat($value) {
		$number = round(
			$value,
			$this->numberFormat['decimals'],
			PHP_ROUND_HALF_UP
		);
		return empty($number) ? 0 : $number;
	}

}
