<?php


namespace Tests\Integration\Http\Controllers\Settings;


use Tests\TestCase;

class ModuleControllerTest extends TestCase
{

    /** @test */
    public function it_returns_all_modules_as_an_array(){
        $this->beSuperAdmin();

        $response = $this->get('/admin/settings/modules');
    }

}