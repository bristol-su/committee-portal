<?php


namespace Tests\Integration\Http\Controllers\Settings;


use BristolSU\Support\ModuleInstance\ModuleInstance;
use BristolSU\Support\ModuleInstance\Settings\ModuleInstanceSettings;
use BristolSU\Support\User\User;
use Tests\TestCase;

class SettingsControllerTest extends TestCase
{


    /** @test */
    public function index_returns_the_correct_view(){
        $response = $this->get('/settings');
        $response->assertViewIs('settings.settings');
    }

}
