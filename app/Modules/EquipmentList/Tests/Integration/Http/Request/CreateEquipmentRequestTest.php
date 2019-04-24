<?php

namespace App\Modules\EquipmentList\Tests\Integration\Http\Request;

use App\Modules\EquipmentList\Http\Requests\CreateEquipmentRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateEquipmentRequestTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function an_error_is_not_returned_if_valid_data_is_given()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem()
            ->assertSessionHasNoErrors();
    }


    /** @test */
    public function an_error_is_returned_if_the_name_is_empty()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['name' => ''])
            ->assertSessionHasErrors('name');

    }

    /** @test */
    public function an_error_is_returned_if_the_name_is_not_a_string()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['name' => false])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_description_is_empty()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['description' => ''])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_description_is_not_a_string()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['description' => false])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function an_error_is_returned_if_the_category_is_empty()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['category' => ''])
            ->assertSessionHasErrors('category');

    }

    /** @test */
    public function an_error_is_returned_if_the_category_is_not_a_string()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['category' => false])
            ->assertSessionHasErrors('category');
    }

    /** @test */
    public function an_error_is_returned_if_the_price_is_negative()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['price' => -1])
            ->assertSessionHasErrors('price');
    }

    /** @test */
    public function an_error_is_returned_if_the_price_is_empty()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['price' => ''])
            ->assertSessionHasErrors('price');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_price_is_a_string()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['price' => '44'])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_in_the_future()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['bought_at' => Carbon::now()->addMinute(20)])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_empty()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['bought_at' => ''])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_not_a_date()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['bought_at' => 'thisisnotadate'])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_notes_are_empty()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['notes' => ''])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_notes_are_not_a_string()
    {
        $this->signInAsSuperAdminActingAsStudent()
            ->createEquipmentItem(['notes' => false])
            ->assertSessionHasErrors('notes');
    }

    /** @test */
    public function a_user_without_the_create_equipment_permission_cannot_create_an_equipment_item()
    {
        $this->beStudent();
        $this->createEquipmentItem( )
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_with_the_create_equipment_permission_can_create_an_equipment_item()
    {
        $user = $this->beStudent()
            ->givePermissionTo('equipmentlist.create-equipment')
            ->givePermissionTo('equipmentlist.module.isActive');
        dd($this->createEquipmentItem());
        $this->assertNotEquals(403, $this->createEquipmentItem()->status());
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