<?php


namespace Tests\Integration\Support\Filters;


use App\Support\Filters\FilterInstanceRepository;
use Tests\TestCase;

class FilterInstanceRepositoryTest extends TestCase
{

    /** @test */
    public function it_creates_a_filter_instance(){
        $repository = new FilterInstanceRepository;
        $repository->create([
            'alias' => 'alias1',
            'name' => 'filterName',
            'settings' => ['some' => 'option']
        ]);

        $this->assertDatabaseHas('filter_instances', [
            'alias' => 'alias1',
            'name' => 'filterName',
            'settings' => json_encode(['some' => 'option'])
        ]);
    }

}
