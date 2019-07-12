<?php


namespace Tests\Integration\Rules;


use App\Rules\CompletionEvent;
use App\Support\Module\Module\ModuleRepository;
use phpDocumentor\Reflection\DocBlock\Tags\Link;
use Tests\TestCase;

class CompletionEventTest extends TestCase
{
public function eventConfig($eventName)
{
    return [
        'name' => 'Event Name',
        'description' => 'Event Description',
        'event' => $eventName
    ];
}

    /** @test */
    public function it_returns_true_if_the_alias_is_given_and_the_completion_event_exists(){
        config(['fileupload.completion' => [$this->eventConfig('completionevent1'), $this->eventConfig('completionevent2')]]);
        $rule = new CompletionEvent('fileupload');

        $this->assertTrue($rule->passes('', 'completionevent1'));
    }

    /** @test */
    public function it_returns_false_if_the_alias_is_given_and_the_completion_event_does_not_exist(){
        config(['fileupload.completion' => [$this->eventConfig('completionevent1'), $this->eventConfig('completionevent2')]]);
        $rule = new CompletionEvent('fileupload');

        $this->assertFalse($rule->passes('', 'completionevent3'));
    }

    /** @test */
    public function it_returns_true_if_the_alias_is_not_given_and_the_completion_event_exists(){
        config(['fileupload.completion' => [$this->eventConfig('completionevent1'), $this->eventConfig('completionevent2')]]);
        $rule = new CompletionEvent(null);

        $this->assertTrue($rule->passes('', 'completionevent1'));
    }

    /** @test */
    public function it_returns_false_if_the_alias_is_not_given_and_the_completion_event_does_not_exist(){
        config(['fileupload.completion' => [$this->eventConfig('completionevent1'), $this->eventConfig('completionevent2')]]);
        $rule = new CompletionEvent(null);

        $this->assertFalse($rule->passes('', 'completionevent3'));
    }

    /** @test */
    public function it_returns_false_if_the_module_is_not_found(){
        $rule = new CompletionEvent('somemodulethatdoesnotexist');

        $this->assertFalse($rule->passes('', 'completionevent3'));
    }

}