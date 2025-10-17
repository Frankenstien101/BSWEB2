<?php
    $sitesArray = $_POST["sites"];
    // Escape each site value and enclose it in single quotes
    $escapedSites = array_map(function($site) {
        return "'" . addslashes($site) . "'";
    }, $sitesArray);
    // Implode the array into a single string separated by commas
    $sites = implode(",", $escapedSites);
    echo $sites;
?>
