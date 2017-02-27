<?php

/**
 * Class Location
 * This is a demo Model class.
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Model;

use Mini\Core\Model;

define('DATAFILE', ROOT . "../data/location");

class Location extends Model
{
    /**
     * Gets location from the file
     */
    public function getLocation()
    {
        $dataFile = fopen(DATAFILE, "r");

        if (!$dataFile) {
            return "";
        }

        $location = fgets($dataFile); 
        fclose($dataFile);

        return $location;
    }

    /**
     * Saves location into a file
     */
    public function setLocation($location)
    {
        $dataFile = fopen(DATAFILE, "w");

        if (!$dataFile) {
            return false;
        }

        fwrite($dataFile, $location);

        fclose($dataFile);
    }
}
