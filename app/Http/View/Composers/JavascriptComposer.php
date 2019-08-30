<?php


namespace App\Http\View\Composers;


use Illuminate\Contracts\View\View;
use Laracasts\Utilities\JavaScript\JavaScriptFacade;

class JavascriptComposer
{
    public function compose(View $view)
    {
        JavaScriptFacade::put([
            'APP_URL' => config('app.url'),
            'API_URL' => config('app.api_url')
        ]);
    }
}
