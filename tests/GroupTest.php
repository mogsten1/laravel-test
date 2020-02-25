<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class GroupTest extends TestCase
{
    /**
     * A Group create test.
     *
     * @return void
     */
    public function testsGroupAreCreatedCorrectly()
    {
        $payload = [
            'name' => 'Lorem',
            'description' => 'Ipsum',
            'group_id' => 1
        ];

        $this->json('POST', '/api/group', $payload)
            ->assertStatus(200)
            ->assertJson(['id' => 1, 'name' => 'Lorem', 'description' => 'Ipsum']);
    }
    /**
     * A Group update test.
     *
     * @return void
     */
    public function testsGroupsAreUpdatedCorrectly()
    {
        $groups = factory(Group::class)->create([
            'name' => 'First Article',
            'description' => 'First Body',
        ]);

        $payload = [
            'name' => 'Lorem',
            'description' => 'Ipsum',
        ];

        $response = $this->json('PUT', '/api/group/' . $groups->id, $payload)
            ->assertStatus(200)
            ->assertJson([
                'id' => 1,
                'title' => 'Lorem',
                'body' => 'Ipsum',
            ]);
    }
    /**
     * A Group delete test.
     *
     * @return void
     */
    public function testsGroupsAreDeletedCorrectly()
    {
        $group = factory(Group::class)->create([
            'name' => 'First Article',
            'description' => 'First Body',
        ]);

        $this->json('DELETE', '/api/group/' . $group->id, [])
            ->assertStatus(204);
    }
    /**
     * A Group Listed test.
     *
     * @return void
     */
    public function testGroupsAreListedCorrectly()
    {
        factory(Group::class)->create([
            'name' => 'First Article',
            'description' => 'First Body',
        ]);

        factory(Group::class)->create([
            'name' => 'Second Article',
            'description' => 'Second Body',
        ]);

        $response = $this->json('GET', '/api/group', [])
            ->assertStatus(200)
            ->assertJson([
                [ 'name' => 'First Article', 'description' => 'First Body' ],
                [ 'name' => 'Second Article', 'description' => 'Second Body' ]
            ])
            ->assertJsonStructure([
                '*' => ['id', 'name', 'description', 'created_at', 'updated_at'],
            ]);
    }
}
