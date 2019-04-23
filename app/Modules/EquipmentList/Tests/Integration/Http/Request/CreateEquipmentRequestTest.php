<?php

namespace App\Modules\EquipmentList\Tests\Integration\Http\Request;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CreateEquipmentRequestTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function an_error_is_not_returned_if_valid_data_is_given()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem()
            ->assertSessionHasNoErrors();
    }


    /** @test */
    public function an_error_is_returned_if_the_name_is_empty()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['name' => ''])
            ->assertSessionHasErrors('name');

    }

    /** @test */
    public function an_error_is_returned_if_the_name_is_not_a_string()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['name' => false])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_description_is_empty()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['description' => ''])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_description_is_not_a_string()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['description' => false])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function an_error_is_returned_if_the_category_is_empty()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['category' => ''])
            ->assertSessionHasErrors('category');

    }

    /** @test */
    public function an_error_is_returned_if_the_category_is_not_a_string()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['category' => false])
            ->assertSessionHasErrors('category');
    }

    /** @test */
    public function an_error_is_returned_if_the_price_is_negative()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['price' => -1])
            ->assertSessionHasErrors('price');
    }

    /** @test */
    public function an_error_is_returned_if_the_price_is_empty()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['price' => ''])
            ->assertSessionHasErrors('price');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_price_is_a_string()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['price' => '44'])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_in_the_future()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['bought_at' => Carbon::now()->addMinute(20)])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_empty()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['bought_at' => ''])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_not_a_date()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['bought_at' => 'thisisnotadate'])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_notes_are_empty()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['notes' => ''])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_notes_are_not_a_string()
    {
        $this->signInAsSuperAdminActingAsGroup()
            ->createEquipmentItem(['notes' => false])
            ->assertSessionHasErrors('notes');
    }

    protected function createEquipmentItem($attributes = [])
    {
        $this->withExceptionHandling();

        return $this->post('/equipmentlist/equipment', $this->validData($attributes));
    }

    protected function validData($attributes)
    {
        return array_merge([
            'name' => 'Some Equipment',
            'description' => 'This is some equipment',
            'category' => 'SmallEquipment',
            'price' => 10,
            'bought_at' => Carbon::now()->toDateString(),
            'notes' => 'These are some notes about the equipment. Maybe where is is stored?'
        ], $attributes);
    }
}