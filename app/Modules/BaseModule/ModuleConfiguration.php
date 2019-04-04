<?php

namespace App\Modules\BaseModule;

use App\Packages\ControlDB\Models\Group;
use Illuminate\Support\Facades\Auth;

abstract class ModuleConfiguration
{

    /**
     * @return bool
     */
    protected function actingAsStudent()
    {
        try {
            if (Auth::user()->getCurrentRole() === null) {
                return false;
            }
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    /**
     * Gets the configuration of this module
     */
    public function getConfiguration()
    {

        return [
            'header' => ($this->isComplete()?'reaffiliation-complete':$this->getHeaderKey()), // Header key as defined in config. Will alter where the button is displayed on the page
            'button_title' => $this->getButtonTitle(), // Title of the button as displayed on the page
            'user_url' => $this->getUserURL(), // URL to direct the user to when clicking this button
            'reaffiliation_mandatory' => $this->isMandatoryForReaffiliation(), // Is this module part of reaffiliation?
            'description' => $this->getDescription(),
            'admin_header' => $this->getAdminHeaderKey(),
            'admin_url' => $this->getAdminURL(),
            'complete' => $this->isComplete(),
            'alias' => $this->alias()
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

    abstract public function alias();

    /**
     * Get the header key for a module button on the admin side
     *
     * @return mixed
     */
    abstract public function getAdminHeaderKey();

    /**
     * Get the text to show on a button
     *
     * @return string
     */
    abstract public function getButtonTitle();

    /**
     * Get the description of a module
     *
     * @return string
     */
    abstract public function getDescription();

    /**
     * Get the URL of the user page
     *
     * This will be put through the laravel url() function
     *
     * @return string
     */
    abstract public function getUserURL();

    /**
     * Get the admin URL of the user page
     *
     * This will be put through the laravel url() function
     *
     * @return string
     */
    abstract public function getAdminURL();

    abstract public function isComplete();

    /**
     * Defines if the module is mandatory for reaffiliation or not
     */
    public function isMandatoryForReaffiliation()
    {
        if (property_exists($this, 'mandatoryForReaffiliation')) {
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
        if (method_exists($this, 'reaffiliationStatus')) {
            return $this->reaffiliationStatus();
        }
        return 'default';
    }


}
