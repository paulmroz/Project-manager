<?php

namespace Tests\Feature;

use App\Project;
use Tests\Setup\ProjectFactory;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectTaskTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_project_can_have_tasks()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $this->post($project->path() . '/tasks', ['body' => 'Lorem ipsum']);

        $this->get($project->path())->assertSee('Lorem ipsum');
    }

    /** @test */
    public function a_task_can_be_updated()
    {
        $this->withoutExceptionHandling();

        $project = app(ProjectFactory::class)->ownedBy($this->signIn())->withTasks(1)->create();

        $this->signIn();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $task = $project->addTask('Test task');

        $this->patch($project->path() . '/tasks/'. $project->tasks[0]->id,[
            'body' => 'changed',
            'completed' => true
        ]);

        $this->assertDatabaseHas('tasks',[
            'body' => 'changed',
            'completed' => true
        ]);

    }

    /** @test */
    public function a_task_requires_a_body()
    {
        $this->signIn();

        $project = factory(Project::class)->create(['owner_id' => auth()->id()]);

        $attributes = factory('App\Task')->raw(['body' => '']);

        $this->post($project->path().'/tasks', $attributes)->assertSessionHasErrors('body');
    }

    /** @test */
    public function guest_cannot_add_tasks_to_projects()
    {
        $project = factory('App\Project')->create();

        $this->post($project->path(). '/tasks')->assertRedirect('login');
    }

    /** @test */
    public function only_the_owner_of_a_project_may_add_tasks()
    {
        $this->signIn();

        $project = factory('App\Project')->create();

        $this->post($project->path() . '/tasks', ['body' => 'Lorem ipsum'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'Lorem ipsum']);
    }

    /** @test */
    public function only_the_owner_of_a_project_may_update_task()
    {

        $this->signIn();

        $project = factory('App\Project')->create();

        $task = $project->addTask('Task test');

        $this->patch($project->path() . '/tasks/' . $task->id, ['body' => 'changed'])
            ->assertStatus(403);

        $this->assertDatabaseMissing('tasks', ['body' => 'changed']);
    }

}
