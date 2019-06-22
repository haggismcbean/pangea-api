<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\User;
use Auth;


class BiomeDescriptionGenerator extends Model
{

    public static function getDescription($biome) {
    	switch ($biome) {
            case "Ocean": 
            	return "the ocean. There's no telling how deep the water is. It stretches away on every side. Above you the sky is grey and low.";
            case "Subpolar Moist Tundra": 
            	return "a subpolar tundra. There seems to be a little more moisture in the air here than most tundras, but it is a sparse landscape with only brush and scrub around you.";
            case "Boreal Dry Scrub": 
            	return "a boreal scrubland. It is dry and harsh and featureless.";
            case "Boreal Moist Forest": 
            	return "a boreal forest. The trees are pressed so tightly together there is not snow on the ground everywhere. Underneath barely anything grows.";
            case "Subtropical Dry Forest": 
            	return "a warm dry forest. The trees are varied, but they are usually thorny and small.";
            case "Warm Temperate Dry Forest": 
            	return "a temperature forest. The trees remind you of oaks and elms. Underneath grows ferns, shrubs, and small flowers";
            case "Subpolar Wet Tundra": 
            	return "a subpolar tundra. There seems to be more moisture in the air here, and more snow.";
            case "Subtropical Moist Forest": 
            	return "a subtropical forest.";
            case "Boreal Desert": 
            	return "a cold harsh landscape. Nothing grows here. There are thin flurries of snow scurrying across the dirt floor that stretches out beyond you.";
            case "Cool Temperate Moist Forest": 
            	return "a cool forest. The trees remind you of oaks and elms. Underneath grows ferns, shrubs, and small flowers";
            case "Warm Temperate Moist Forest": 
            	return "a warm forest. The trees remind you of oaks and elms. Underneath grows ferns, shrubs, and small flowers";
            case "Cool Temperate Wet Forest": 
            	return "a cool forest. The trees remind you of oaks and elms. Underneath grows ferns, shrubs, and small flowers";
            case "Subtropical Wet Forest": 
            	return "a jungle. A mass of trees and vines strech out chaotically as far as you can see.";
            case "Cool Temperate Steppes": 
            	return "the steppes. The rolling hills support not much more vegetation than a few pale grasses and the occasional thorny bush.";
            case "Subtropical Rain Forest": 
            	return "a rainforest. The sound of animals come from everywhere, but you rarely catch a glimpse of one.";
            case "Polar Ice": 
            	return "You find yourself on a polar ice sheet. There are no plants here, only snow and ice.";
            case "Boreal Wet Forest": 
            	return "a boreal forest. The trees are pressed so tightly together there is not snow on the ground everywhere. Underneath barely anything grows.";
            case "Warm Temperate Wet Forest": 
            	return "a temperature forest. The trees remind you of oaks and elms. Underneath grows ferns, shrubs, and small flowers";
            case "Subpolar Dry Tundra": 
            	return "a subpolar tundra. There seems to be little moisture in the air. It is a sparse landscape with only brush and scrub around you.";
            case "Cool Temperate Desert Scrub": 
            	return "a cool desert scrubland. It is dry and harsh and featureless.";
            case "Polar Desert": 
            	return "a polar desert. There are no plants here, only snow and ice.";
            case "Cool Temperate Rain Forest": 
            	return "a rainforest. The sound of animals come from everywhere, but you rarely catch a glimpse of one.";
            case "Warm Temperate Rain Forest": 
            	return "a rainforest. The sound of animals come from everywhere, but you rarely catch a glimpse of one.";
            case "Subpolar Rain Tundra": 
            	return "a subpolar tundra. There seems to be little moisture in the air. It is a sparse landscape with only brush and scrub around you.";
            case "Boreal Rain Forest": 
            	return "a boreal forest. The trees are pressed so tightly together there is not snow on the ground everywhere. Underneath barely anything grows.";
            case "Subtropical Thorn Woodland": 
            	return "a thorny woodland. The small trees have tiny leaves and dark, burned looking bark";
            case "Tropical Dry Forest": 
            	return "a dry tropical forest.";
            case "Tropical Very Dry Forest": 
            	return "a very dry tropical forest.";
            case "Tropical Thorn Woodland": 
            	return "a thorny woodland. The small trees have tiny leaves and dark, burned looking bark";
            case "Subtropical Desert Scrub": 
            	return "a subtropical desert scrubland. It is dry and harsh and featureless.";
            case "Warm Temperate Thorn Scrub": 
            	return "a warm desert scrubland. It is dry and harsh and featureless.";
            case "Tropical Desert Scrub": 
            	return "a tropical desert scrubland. It is dry and harsh and featureless.";
            case "Subtropical Desert": 
            	return "a desert. It is dry and harsh and featureless.";
            case "Tropical Desert": 
            	return "a desert. It is dry and harsh and featureless.";
            case "Tropical Moist Forest": 
            	return "a tropical forest.";
            case "Tropical Wet Forest": 
            	return "a tropical rainforest.";
            case "Tropical Rain Forest": 
            	return "a tropical rainforest.";
            case "Warm Temperate Desert Scrub": 
            	return "a desert scrubland. It is dry and harsh and featureless.";
            case "Warm Temperate Desert": 
            	return "a desert. It is dry and harsh and featureless.";
            case "Cool Temperate Desert":
            	return "a desert. It is dry and harsh and featureless.";
        }
    }
}
