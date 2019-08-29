<?php


namespace Tests\Unit\Support\Control\Models;


use App\Support\Control\Models\Model;
use Tests\TestCase;

class ModelTest extends TestCase
{

    /** @test */
    public function it_returns_an_attribute_if_called_as_a_property(){
        $model = new Model(['attr' => 'val']);
        $this->assertEquals('val', $model->attr);
    }

    /** @test */
    public function it_returns_null_if_attribute_not_found(){
        $model = new Model(['attr' => 'val']);
        $this->assertNull($model->anotherAttr);
    }

    /** @test */
    public function it_returns_all_attributes_as_an_array(){
        $parameters = [
            'foo' => 'bar',
            'baz' => 'qui'
        ];
        $model = new Model($parameters);
        $this->assertEquals($parameters, $model->toArray());
    }
}
