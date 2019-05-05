<?php

namespace App\Modules\BaseModule;

use App\Packages\ControlDB\Models\Group;
use App\Traits\CanSeeGroupTags;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

abstract class ModuleConfiguration
{
    use CanSeeGroupTags;

    public $group;


    public function setGroup($group) {
        $this->group = $group;
    }

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

    abstract public function isMandatoryForGroup(Group $group);

    /**
     * Gets the configuration of this module
     */
    public function getConfiguration()
    {
        $group = $this->getGroup();

        return [
            'header' => $this->header(), // Header key as defined in config. Will alter where the button is displayed on the page
            'button_title' => $this->getButtonTitle(), // Title of the button as displayed on the page
            'user_url' => $this->getUserURL(), // URL to direct the user to when clicking this button
            'reaffiliation_mandatory' => $this->isMandatory(), // Is this module part of reaffiliation?
            'description' => $this->getDescription(),
            'admin_header' => $this->getAdminHeaderKey(),
            'admin_url' => $this->getAdminURL(),
            'complete' => ($group === null ? false : $this->isComplete($group)),
            'alias' => $this->alias()
        ];
    }

    public function header()
    {
        $header = $this->getHeaderKey();
        $group = $this->getGroup();

        if(strpos($header, 'reaffiliation-') !== false) {
            // Chain of Responsibility
            if($group === null ? false : $this->isComplete($group)) {
                return 'reaffiliation-complete';
            } elseif($this->isMandatory()) {
                return 'reaffiliation-mandatory';
            }
            return 'reaffiliation-optional';
        }
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

    /**
     * @return Group
     */
    public function getGroup()
    {
        if($this->actingAsStudent()) {
            return Auth::user()->getCurrentRole()->group;
        }

        if($this->group instanceof Group) {
            return $this->group;
        }

        return null;
    }

    abstract public function isComplete(Group $group);

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

    public function isMandatory()
    {
        return Auth::user()->can($this->alias().'.reaffiliation.isMandatory');
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
