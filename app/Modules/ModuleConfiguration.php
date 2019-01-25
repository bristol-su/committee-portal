<?php

namespace App\Modules;

abstract class ModuleConfiguration
{

    /**
     * Gets the configuration of this module
     */
    public function getConfiguration()
    {

        return [
            'header' => $this->getHeaderKey(), // Header key as defined in config. Will alter where the button is displayed on the page
            'button_title' => $this->getButtonTitle(), // Title of the button as displayed on the page
            'user_url' => $this->getUserURL(), // URL to direct the user to when clicking this button
            'visible' => $this->getVisibility(), // Should this module be visible to the user
            'active' => $this->isActive(), // Should this module be active or greyed out?
            'reaffiliation_mandatory' => $this->isMandatoryForReaffiliation(), // Is this module part of reaffiliation?
            'reaffiliation_status' => $this->getReaffiliationStatus() // What status is this module? Use config keys

        ];
    }

    /**
     * Get the header key for a module button
     *
     * This should refer to a header in the 'portal' configuration file
     *
     * @return string
     */
    abstract public function getHeaderKey();

    /**
     * Get the text to show on a button
     *
     * @return string
     */
    abstract public function getButtonTitle();

    /**
     * Get the URL of the user page
     *
     * This will be put through the laravel url() function
     *
     * @return string
     */
    abstract public function getUserURL();

    /**
     * Should the module be drawn as a button on the portal dashboard?
     *
     * @return bool
     */
    abstract public function getVisibility();

    /**
     * Check if the module should be active (i.e. not greyed out)
     * @return bool
     */
    abstract public function isActive();

    /**
     * Defines if the module is mandatory for reaffiliation or not
     */
    public function isMandatoryForReaffiliation()
    {
        if(property_exists($this, 'mandatoryForReaffiliation'))
        {
            return $this->mandatoryForReaffiliation;
        }

        return false;
    }

    /**
     * Get the reaffiliation status. If this is a module for reaffiliation, make sure
     * you define a reaffiliationStatus method, accessable by this class.
     *
     * @return string
     *
     * @throws \Exception
     */
    public function getReaffiliationStatus()
    {
        if(method_exists($this, 'reaffiliationStatus'))
        {
            return $this->reaffiliationStatus();
        }
        return 'default';
    }


}
