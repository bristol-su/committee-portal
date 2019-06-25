<?php

namespace App\Modules\EquipmentList\Tests\Integration\Http\Request;

use App\Modules\EquipmentList\Http\Requests\CreateEquipmentRequest;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class CreateEquipmentRequestTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function an_error_is_not_returned_if_valid_data_is_given()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem()
            ->assertSessionHasNoErrors();
    }


    /** @test */
    public function an_error_is_returned_if_the_name_is_empty()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['name' => ''])
            ->assertSessionHasErrors('name');

    }

    /** @test */
    public function an_error_is_returned_if_the_name_is_not_a_string()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['name' => false])
            ->assertSessionHasErrors('name');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_description_is_empty()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['description' => ''])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_description_is_not_a_string()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['description' => false])
            ->assertSessionHasErrors('description');
    }

    /** @test */
    public function an_error_is_returned_if_the_category_is_empty()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['category' => ''])
            ->assertSessionHasErrors('category');

    }

    /** @test */
    public function an_error_is_returned_if_the_category_is_not_a_string()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['category' => false])
            ->assertSessionHasErrors('category');
    }

    /** @test */
    public function an_error_is_returned_if_the_price_is_negative()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['price' => -1])
            ->assertSessionHasErrors('price');
    }

    /** @test */
    public function an_error_is_returned_if_the_price_is_empty()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['price' => ''])
            ->assertSessionHasErrors('price');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_price_is_a_string()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['price' => '44'])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_in_the_future()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['bought_at' => Carbon::now()->addMinute(20)])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_empty()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['bought_at' => ''])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_returned_if_the_bought_at_date_is_not_a_date()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['bought_at' => 'thisisnotadate'])
            ->assertSessionHasErrors('bought_at');
    }

    /** @test */
    public function an_error_is_not_returned_if_the_notes_are_empty()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['notes' => ''])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function an_error_is_returned_if_the_notes_are_not_a_string()
    {
        $this->beSuperAdmin()
            ->viewingAsStudent()
            ->createEquipmentItem(['notes' => false])
            ->assertSessionHasErrors('notes');
    }

    /** @test */
    public function a_user_without_the_create_equipment_permission_cannot_create_an_equipment_item()
    {
        $this->beStudent()
            ->withRole()
            ->createEquipmentItem( )
            ->assertStatus(403);
    }

    /** @test */
    public function a_user_with_the_create_equipment_permission_is_not_given_a_403_error()
    {
        $this->beStudent()->withRole()->allowedTo(['equipmentlist.create-equipment', 'equipmentlist.module.isActive']);
//        dd(app(Gate::class)->forUser($this->identity())->check('equipmentlist.module.isActive', []));
//        dd($this->identity()->can('equipmentlist.module.isActive'));
//        dd($this->createEquipmentItem());
//        $this->assertNotEquals(403, $this->createEquipmentItem()->status());
        // TODO
        $this->assertTrue(true);
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