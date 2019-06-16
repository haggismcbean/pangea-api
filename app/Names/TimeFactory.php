<?php

namespace App\Names;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TimeFactory extends Model
{

    public static function getDaylightMessage($time)
    {
    	$minutesPast = date("i");

    	// pre-dawn
    	if ($time === 11) {
        	$messages = [
        		"You can see a lightening in the sky in the east"
        	];
        	return TimeFactory::getRandomMessage($messages);
    	}

    	// morning
        if ($time === 12) {
        	if ($minutesPast < 15) {
	        	// dawn
	        	$messages = [
	        		"The sun is rising"
	        	];
	        	return TimeFactory::getRandomMessage($messages);
        	}

        	// late morning
        	$messages = [
        		"The sun has risen"
        	];
        	return TimeFactory::getRandomMessage($messages);
        }

        // day
        if ($time === 13) {
        	if ($minutesPast < 15) {
	        	$messages = [
	        		"The sun is nearest its highest point"
	        	];
	        	return TimeFactory::getRandomMessage($messages);
        	}

        	if ($minutesPast > 29 && $minutesPast < 45) {
	        	//midday
        		$messages = [
	        		"The sun is at its highest point in the sky"
	        	];
        	}

        	//afternoon
        	$messages = [
        		"It is mid afternoon"
        	];
        	return TimeFactory::getRandomMessage($messages);
        }

        // evening
        if ($time === 14) {
        	if ($minutesPast < 30) {
	        	//evening
	        	$messages = [
	        		"The sky is darkening",
	        		"The light is fading",
	        		// note - i can't have sunsets unless i check the weather too!
	        		// "The sky is a glorious gradient of red and blue",
	        		// "The sky fades from blue to purple to red",
	        		// "The sky is pink"
	        	];
	        	return TimeFactory::getRandomMessage($messages);
        	}

        	//sunset
        	$messages = [
        		"The sun is setting"
        	];
        	return TimeFactory::getRandomMessage($messages);
        }

        // night
        if ($time > 14 || $time < 11) {
        	$messages = [
        		"It is night time"
        	];
        	return TimeFactory::getRandomMessage($messages);
        }
    }

    private static function getRandomMessage($messages) {
    	$length = count($messages) - 1;
    	$randomIndex = rand(0, $length);
    	return $messages[$randomIndex];
    }
}
