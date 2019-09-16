<?php

namespace Tests\Integration\Http\View\Utilities;

use App\Http\View\Utilities\JavascriptComposer;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\View\View;
use Laracasts\Utilities\JavaScript\Transformers\Transformer;
use Tests\TestCase;

class JavascriptComposerTest extends TestCase
{

    /** @test */
    public function compose_adds_the_correct_variables_to_javascript(){
        config([
            'app.url' => 'appUrl',
            'app.api_url' => 'apiUrl'
        ]);


        $js = $this->prophesize(Transformer::class);
        $js->put([
            'APP_URL' => 'appUrl',
            'API_URL' => 'apiUrl'
        ])->shouldBeCalled();
        $this->instance('JavaScript', $js->reveal());

        $view = $this->prophesize(View::class);
        $composer = new JavascriptComposer();
        $composer->compose($view->reveal());
    }

}
