<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Model\Location;

class HomeController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        // Instance new Model (Location)
        $Location = new Location();

        $currentLocation = $Location->getLocation();

        // load views
        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }

    /**
     * ACTION: setlocation
     * This method handles what happens when you move to http://yourproject/setlocation
     * IMPORTANT: This is not a normal page, it's an ACTION. This is where the "set location" form on /index
     * directs the user after the form submit. This method handles all the POST data from the form and then redirects
     * the user back to index via the last line: header(...)
     * This is an example of how to handle a POST request.
     */
    public function setlocation()
    {
        // if we have POST data to create a new song entry
        if (isset($_POST["location"])) {
            // Instance new Model (Location)
            $Location = new Location();

            $loc = strip_tags(trim($_POST["location"]));

            // do setLocation() in model/model.php
            $Location->setLocation($loc);
        }

        // where to go after song has been added
        header('location: ' . URL);
    }

    public function getlocation()
    {
        // Instance new Model (Location)
        $Location = new Location();

        echo $Location->getLocation();
    }

    public function clearlocation()
    {
        // Instance new Model (Location)
        $Location = new Location();

        $Location->setLocation('');

        // where to go after song has been added
        header('location: ' . URL);
    }
}
