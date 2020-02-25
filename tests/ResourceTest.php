<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ResourceTest extends TestCase
{
    /**
     * A Create resource test.
     *
     * @return void
     */

    public function testsResourcesAreCreatedCorrectly()
    {
        $payload = [
            'name' => 'Lorem',
            'description' => 'Ipsum',
            'group_id' => 1
        ];

        $this->json('POST', '/api/resource', $payload)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'name' => 'Lorem', 'description' => 'Ipsum']);
    }
    /**
     * A Update resource test.
     *
     * @return void
     */
    public function testsResourcesAreUpdatedCorrectly()
    {
        $resources = factory(Resource::class)->create([
            'name' => 'First Article',
            'description' => 'First Body',
            'group_id' => 1
        ]);

        $payload = [
            'name' => 'Lorem',
            'description' => 'Ipsum',
            'group_id' => 2,
        ];

        $response = $this->json('PUT', '/api/resource/' . $resources->id, $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'title' => 'Lorem',
                'body' => 'Ipsum',
                'group_id' => 2
            ]);

    }
    /**
     * A Delete resource test.
     *
     * @return void
     */
    public function testsResourcesAreDeletedCorrectly()
    {
        $resource = factory(Resource::class)->create([
            'name' => 'First Article',
            'description' => 'First Body',
            'group_id' => 1
        ]);

        $this->json('DELETE', '/api/resource/' . $resource->id, [])
            ->assertStatus(204);
    }
    /**
     * A Listed resource test.
     *
     * @return void
     */
    public function testResourcesAreListedCorrectly()
    {
        factory(Resource::class)->create([
            'name' => 'First Article',
            'description' => 'First Body',
            'group_id' => 1
        ]);

        factory(Resource::class)->create([
            'name' => 'Second Article',
            'description' => 'Second Body',
            'group_id' => 2
        ]);

        $response = $this->json('GET', '/api/resource', [])
            ->assertStatus(200)
            ->assertJson([
                [ 'name' => 'First Article', 'description' => 'First Body', 'group_id' => 1 ],
                [ 'name' => 'Second Article', 'description' => 'Second Body', 'group_id' => 2 ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'description','group_id', 'created_at', 'updated_at'],
            ]);
    }
}
