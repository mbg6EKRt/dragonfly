<?php

	/**
	 * Original data taken from:
	 * ftp://ftp.unicode.org/Public/MAPPINGS/ISO8859/8859-13.TXT
	 * @param string $string
	 * @return string
	 */
	function charset_decode_iso_8859_13($string)
	{
		$mapping = array(
					"\x80" => "\xC2\x80",
					"\x81" => "\xC2\x81",
					"\x82" => "\xC2\x82",
					"\x83" => "\xC2\x83",
					"\x84" => "\xC2\x84",
					"\x85" => "\xC2\x85",
					"\x86" => "\xC2\x86",
					"\x87" => "\xC2\x87",
					"\x88" => "\xC2\x88",
					"\x89" => "\xC2\x89",
					"\x8A" => "\xC2\x8A",
					"\x8B" => "\xC2\x8B",
					"\x8C" => "\xC2\x8C",
					"\x8D" => "\xC2\x8D",
					"\x8E" => "\xC2\x8E",
					"\x8F" => "\xC2\x8F",
					"\x90" => "\xC2\x90",
					"\x91" => "\xC2\x91",
					"\x92" => "\xC2\x92",
					"\x93" => "\xC2\x93",
					"\x94" => "\xC2\x94",
					"\x95" => "\xC2\x95",
					"\x96" => "\xC2\x96",
					"\x97" => "\xC2\x97",
					"\x98" => "\xC2\x98",
					"\x99" => "\xC2\x99",
					"\x9A" => "\xC2\x9A",
					"\x9B" => "\xC2\x9B",
					"\x9C" => "\xC2\x9C",
					"\x9D" => "\xC2\x9D",
					"\x9E" => "\xC2\x9E",
					"\x9F" => "\xC2\x9F",
					"\xA0" => "\xC2\xA0",
					"\xA1" => "\xE2\x80\x9D",
					"\xA2" => "\xC2\xA2",
					"\xA3" => "\xC2\xA3",
					"\xA4" => "\xC2\xA4",
					"\xA5" => "\xE2\x80\x9E",
					"\xA6" => "\xC2\xA6",
					"\xA7" => "\xC2\xA7",
					"\xA8" => "\xC3\x98",
					"\xA9" => "\xC2\xA9",
					"\xAA" => "\xC5\x96",
					"\xAB" => "\xC2\xAB",
					"\xAC" => "\xC2\xAC",
					"\xAD" => "\xC2\xAD",
					"\xAE" => "\xC2\xAE",
					"\xAF" => "\xC3\x86",
					"\xB0" => "\xC2\xB0",
					"\xB1" => "\xC2\xB1",
					"\xB2" => "\xC2\xB2",
					"\xB3" => "\xC2\xB3",
					"\xB4" => "\xE2\x80\x9C",
					"\xB5" => "\xC2\xB5",
					"\xB6" => "\xC2\xB6",
					"\xB7" => "\xC2\xB7",
					"\xB8" => "\xC3\xB8",
					"\xB9" => "\xC2\xB9",
					"\xBA" => "\xC5\x97",
					"\xBB" => "\xC2\xBB",
					"\xBC" => "\xC2\xBC",
					"\xBD" => "\xC2\xBD",
					"\xBE" => "\xC2\xBE",
					"\xBF" => "\xC3\xA6",
					"\xC0" => "\xC4\x84",
					"\xC1" => "\xC4\xAE",
					"\xC2" => "\xC4\x80",
					"\xC3" => "\xC4\x86",
					"\xC4" => "\xC3\x84",
					"\xC5" => "\xC3\x85",
					"\xC6" => "\xC4\x98",
					"\xC7" => "\xC4\x92",
					"\xC8" => "\xC4\x8C",
					"\xC9" => "\xC3\x89",
					"\xCA" => "\xC5\xB9",
					"\xCB" => "\xC4\x96",
					"\xCC" => "\xC4\xA2",
					"\xCD" => "\xC4\xB6",
					"\xCE" => "\xC4\xAA",
					"\xCF" => "\xC4\xBB",
					"\xD0" => "\xC5\xA0",
					"\xD1" => "\xC5\x83",
					"\xD2" => "\xC5\x85",
					"\xD3" => "\xC3\x93",
					"\xD4" => "\xC5\x8C",
					"\xD5" => "\xC3\x95",
					"\xD6" => "\xC3\x96",
					"\xD7" => "\xC3\x97",
					"\xD8" => "\xC5\xB2",
					"\xD9" => "\xC5\x81",
					"\xDA" => "\xC5\x9A",
					"\xDB" => "\xC5\xAA",
					"\xDC" => "\xC3\x9C",
					"\xDD" => "\xC5\xBB",
					"\xDE" => "\xC5\xBD",
					"\xDF" => "\xC3\x9F",
					"\xE0" => "\xC4\x85",
					"\xE1" => "\xC4\xAF",
					"\xE2" => "\xC4\x81",
					"\xE3" => "\xC4\x87",
					"\xE4" => "\xC3\xA4",
					"\xE5" => "\xC3\xA5",
					"\xE6" => "\xC4\x99",
					"\xE7" => "\xC4\x93",
					"\xE8" => "\xC4\x8D",
					"\xE9" => "\xC3\xA9",
					"\xEA" => "\xC5\xBA",
					"\xEB" => "\xC4\x97",
					"\xEC" => "\xC4\xA3",
					"\xED" => "\xC4\xB7",
					"\xEE" => "\xC4\xAB",
					"\xEF" => "\xC4\xBC",
					"\xF0" => "\xC5\xA1",
					"\xF1" => "\xC5\x84",
					"\xF2" => "\xC5\x86",
					"\xF3" => "\xC3\xB3",
					"\xF4" => "\xC5\x8D",
					"\xF5" => "\xC3\xB5",
					"\xF6" => "\xC3\xB6",
					"\xF7" => "\xC3\xB7",
					"\xF8" => "\xC5\xB3",
					"\xF9" => "\xC5\x82",
					"\xFA" => "\xC5\x9B",
					"\xFB" => "\xC5\xAB",
					"\xFC" => "\xC3\xBC",
					"\xFD" => "\xC5\xBC",
					"\xFE" => "\xC5\xBE",
					"\xFF" => "\xE2\x80\x99");
		
		$outStr = '';
    	for ($i = 0, $len = strlen($string); $i < $len; $i++)
    	{
    		$outStr .= (array_key_exists($string{$i}, $mapping))?$mapping[$string{$i}]:$string{$i};
		}
		
		return $outStr;
	}

?>