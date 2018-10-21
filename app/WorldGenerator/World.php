<?php

namespace App\WorldGenerator;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Auth;


class World extends Model
{
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->getBiomes();
        $this->getHeights();
        $this->getRainfall();
        $this->getTemperature();
        $this->getHasRiver();
    }

    private function getBiomes() {
        $pixels = array();

        $resource = imagecreatefrompng("resources/world_images/pangea_biome.png");
        $width = imagesx($resource);
        $height = imagesy($resource);

        for($x = 0; $x < $width; $x++) {
            for($y = 0; $y < $height; $y++) {
                // pixel color at (x, y)
                $pixel = new class{};
                $rgb = imagecolorat($resource, $x, $y);

                $pixel->color = $this->getHexColor($rgb);
                $pixel->biome = $this->getBiomeFromColor($pixel->color);

                $pixel->x = $x;
                $pixel->y = $y;
                array_push($pixels, $pixel);
            }
        }

        $this->pixels = $pixels;
    }

    private function getBiomeFromColor($color) {
        switch($color) {
            case "#175e91":
                return "Ocean";
            case "#608080":
                return "Subpolar Moist Tundra";
            case "#80a080":
                return "Boreal Dry Scrub";
            case "#60a080":
                return "Boreal Moist Forest";
            case "#80f080":
                return "Subtropical Dry Forest";
            case "#80e080":
                return "Warm Temperate Dry Forest";
            case "#408080":
                return "Subpolar Wet Tundra";
            case "#60f080":
                return "Subtropical Moist Forest";
            case "#a0a080":
                return "Boreal Desert";
            case "#60c080":
                return "Cool Temperate Moist Forest";
            case "#60e080":
                return "Warm Temperate Moist Forest";
            case "#40c090":
                return "Cool Temperate Wet Forest";
            case "#40f090":
                return "Subtropical Wet Forest";
            case "#80c080":
                return "Cool Temperate Steppes";
            case "#20f0b0":
                return "Subtropical Rain Forest";
            case "#ffffff":
                return "Polar Ice";
            case "#40a090":
                return "Boreal Wet Forest";
            case "#40e090":
                return "Warm Temperate Wet Forest";
            case "#808080":
                return "Subpolar Dry Tundra";
            case "#a0c080":
                return "Cool Temperate Desert Scrub";
            case "#c0c0c0":
                return "Polar Desert";
            case "#20c0c0":
                return "Cool Temperate Rain Forest";
            case "#20e0c0":
                return "Warm Temperate Rain Forest";
            case "#2080c0":
                return "Subpolar Rain Tundra";
            case "#20a0c0":
                return "Boreal Rain Forest";
            case "#b0f080":
                return "Subtropical Thorn Woodland";
            case "#80ff80":
                return "Tropical Dry Forest";
            case "#a0ff80":
                return "Tropical Very Dry Forest";
            case "#c0ff80":
                return "Tropical Thorn Woodland";
            case "#d0f080":
                return "Subtropical Desert Scrub";
            case "#a0e080":
                return "Warm Temperate Thorn Scrub";
            case "#e0ff80":
                return "Tropical Desert Scrub";
            case "#f0f080":
                return "Subtropical Desert";
            case "#ffff80":
                return "Tropical Desert";
            case "#60ff80":
                return "Tropical Moist Forest";
            case "#40ff90":
                return "Tropical Wet Forest";
            case "#20ffa0":
                return "Tropical Rain Forest";
            case "#c0e080":
                return "Warm Temperate Desert Scrub";
            case "#e0e080":
                return "Warm Temperate Desert";
            case "#c0c080":
                return "Cool Temperate Desert";
        }
    }

    private function getHeights() {
        $resource = imagecreatefrompng("resources//world_images/pangea_grayscale.png");
        $width = imagesx($resource);
        $height = imagesy($resource);

        for($x = 0; $x < $width; $x++) {
            for($y = 0; $y < $height; $y++) {
                // pixel color at (x, y)
                $rgb = imagecolorat($resource, $x, $y);
                $pixel = $this->pixels[($x * $width) + $y];

                $pixel->height = $rgb;
            }
        }
    }

    private function getRainfall() {
        $resource = imagecreatefrompng("resources//world_images/pangea_precipitation.png");
        $width = imagesx($resource);
        $height = imagesy($resource);

        for($x = 0; $x < $width; $x++) {
            for($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($resource, $x, $y);
                $pixel = $this->pixels[($x * $width) + $y];

                $rainfallHex = $this->getHexColor($rgb);
                $pixel->rainfall = $this->getRainfallFromColor($rainfallHex);
            }
        }
    }

    private function getRainfallFromColor($color) {
        switch($color) {
            case "#002020":
                return 0;
            case "#004040":
                return 1;
            case "#006060":
                return 2;
            case "#008080":
                return 3;
            case "#00a0a0":
                return 4;
            case "#00c0c0":
                return 5;
            case "#00e0e0":
                return 6;
            case "#00ffff":
                return 7;
        }
    }

    private function getTemperature() {
        $resource = imagecreatefrompng("resources//world_images/pangea_temperature.png");
        $width = imagesx($resource);
        $height = imagesy($resource);

        for($x = 0; $x < $width; $x++) {
            for($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($resource, $x, $y);
                $pixel = $this->pixels[($x * $width) + $y];

                $hexColor = $this->getHexColor($rgb);

                $pixel->temperature = $this->getTemperatureFromColor($hexColor);
            }
        }
    }

    private function getTemperatureFromColor($color) {
        switch($color) {
            case "#0000ff":
                return 0;
            case "#2a00d5":
                return 1;
            case "#5500aa":
                return 2;
            case "#800080":
                return 3;
            case "#aa0055":
                return 4;
            case "#d5002a":
                return 5;
            case "#ff0000":
                return 6;
        }
    }

    private function getHasRiver() {
        $resource = imagecreatefrompng("resources//world_images/pangea_rivers.png");
        $width = imagesx($resource);
        $height = imagesy($resource);

        $riverColors = [];

        for($x = 0; $x < $width; $x++) {
            for($y = 0; $y < $height; $y++) {
                $rgb = imagecolorat($resource, $x, $y);
                $pixel = $this->pixels[($x * $width) + $y];

                $hexColor = $this->getHexColor($rgb);

                $pixel->hasRiver = $this->getHasRiverFromColor($hexColor);
            }
        }
    }

    private function getHasRiverFromColor($color) {
        if ($color == "#000080") {
            return true;
        }

        return false;
    }

    // Utility Functions

    private function getHexColor($rgb) {
        //https://stackoverflow.com/questions/31222703/php-imagecolorat-to-rgb-or-hex#31222811
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;

        //https://stackoverflow.com/questions/32962624/convert-rgb-to-hex-color-values-in-php#32977705
        return sprintf("#%02x%02x%02x", $r, $g, $b);
    }

    private function getColorDifference($rgbA, $rgbB) {
        $rA = ($rgbA >> 16);
        $gA = ($rgbA >> 8);
        $bA = $rgbA;

        $rB = ($rgbB >> 16);
        $gB = ($rgbB >> 8);
        $bB = $rgbB;

        $differenceRed = abs($rA - $rB);
        $differenceGreen = abs($bA - $bB);
        $differenceBlue = abs($bA - $bB);

        return $differenceRed + $differenceGreen + $differenceBlue;
    }
}