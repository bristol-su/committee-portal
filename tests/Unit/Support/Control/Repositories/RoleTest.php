<?php


namespace Tests\Unit\Support\Control\Repositories;


use App\Support\Control\Repositories\Role;
use Illuminate\Support\Collection;
use Tests\TestCase;

class RoleTest extends TestCase
{

    /** @test */
    public function get_by_id_returns_a_role_model_with_the_given_id(){
        $role = [
            'id' => 1
        ];

        $this->mockControl('get', 'position_student_groups/' . $role['id'], $role);

        $roleModel = (new Role($this->controlClient->reveal()))->getById($role['id']);
        foreach($role as $attribute => $value) {
            $this->assertEquals($value, $roleModel->{$attribute});
        }
    }

    /** @test */
    public function all_from_student_control_id_returns_all_roles_belonging_to_a_student(){
        $roles = [
            ['id' => 1],
            ['id' => 2],
            ['id' => 3]
        ];

        $this->mockControl('get', 'students/1/position_student_groups', $roles);

        $roleModel = (new Role($this->controlClient->reveal()))->allFromStudentControlID(1);
        foreach($roles as $role) {
            $model = $roleModel->shift();
            foreach($role as $attribute => $value) {
                $this->assertEquals($value, $model->{$attribute});
            }
        }
    }

    /** @test */
    public function all_from_student_control_id_returns_an_empty_collection_if_no_roles_belong_to_a_student(){
        $this->mockControl('get', 'students/1/position_student_groups', []);

        $roleModel = (new Role($this->controlClient->reveal()))->allFromStudentControlID(1);

        $this->assertInstanceOf(Collection::class, $roleModel);
        $this->assertEquals(0, $roleModel->count());


    }

}
