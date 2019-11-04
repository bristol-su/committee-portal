<?php

namespace Tests\Unit\Http\View\Utilities;

use App\Http\View\Utilities\JavascriptComposer;
use Illuminate\Contracts\View\View;
use Laracasts\Utilities\JavaScript\Transformers\Transformer;
use Tests\TestCase;

class JavascriptComposerTest extends TestCase
{

    /** @test */
    public function compose_passes_the_correct_data_to_the_javascript_facade(){
        $javascript  = $this->prophesize(Transformer::class);
        $javascript->put([
            'APP_URL' => 'https://example.com',
            'API_URL' => 'https://example.com/api'
        ])->shouldBeCalled();
        $this->instance('JavaScript', $javascript->reveal());

        $this->app['config']->set('app.url', 'https://example.com');
        $this->app['config']->set('app.api_url', 'https://example.com/api');

        $composer = new JavascriptComposer();
        $composer->compose($this->prophesize(View::class)->reveal());
    }

}
