<?php
//inclut automatiquement tous les packages de composer
require_once __DIR__.'/vendor/autoload.php';

use Whatsma\ZodiacSign;

$calculator = new ZodiacSign\Calculator();

try {
  $zodiacSign = $calculator->calculate(15,3);
  //echo $zodiacSign . "\n";
} catch (ZodiacSign\InvalidDayException $e) {
  echo "ERROR: Invalid Day";
} catch (ZodiacSign\InvalidMonthException $e) {
  echo "ERROR: Invalid Month";
}
// 1ere methode
$traductionFr = array(
	
	'capricorn'=> 'capricorne',
	'aquarius'=> 'verseau',
	'pisces'=> 'poisson',
	'aries' => 'bélier',
	'taurus'=> 'taureau',
	'gemini'=> 'gémeaux',
	'cancer'=> 'cancer',
	'leo'=> 'lion',
	'virgo'=> 'vierge',
	'libra'=> 'balance',
	'scorpio'=> 'scorpion',
	'sagittarius'=> 'sagittaire',

	);
echo $traductionFr[$zodiacSign]; 

/*2e facon
switch($zodiacSign){
	case'capricorn':
		$zodiacFr = 'capricorne';
		break;
	case'aquarius':
		$zodiacFr = 'verseau';
		break;
	case'pisces':
		$zodiacFr = 'poisson';
		break;
}*/