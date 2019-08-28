<?php


namespace App\Support\Control\Repositories;


use App\Packages\ControlDB\Models\CommitteeRole;
use App\Packages\ControlDB\Models\Student;
use App\Support\Control\Contracts\Client\Client as ControlClient;
use App\Support\Control\Contracts\Repositories\Role as RoleContract;
use Illuminate\Support\Collection;

class Role implements RoleContract
{

    /**
     * @var ControlClient
     */
    private $client;

    public function __construct(ControlClient $client)
    {
        $this->client = $client;
    }
    public function getById($id)
    {
        $role = $this->client->request('get', 'position_student_groups/' . $id);
        return new \App\Support\Control\Models\Role($role);
    }

    public function allFromStudentControlID($id): Collection
    {
        $roles = $this->client->request('get', 'students/' . $id . '/position_student_groups');
        $modelRoles = new Collection;
        foreach($roles as $role) {
            $modelRoles->push(new \App\Support\Control\Models\Role($role));
        }
        return $modelRoles;
    }


}
