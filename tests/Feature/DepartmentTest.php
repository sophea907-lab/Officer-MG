<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DepartmentTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    public function test_guest_cannot_access_departments(): void
    {
        $response = $this->get(route('departments.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_view_department_list(): void
    {
        Department::factory()->create(['department_name' => 'Ministry of Information']);

        $response = $this->actingAs($this->admin)->get(route('departments.index'));

        $response->assertStatus(200);
        $response->assertSee('Ministry of Information');
    }

    public function test_admin_can_create_department(): void
    {
        $response = $this->actingAs($this->admin)->post(route('departments.store'), [
            'department_name' => 'Department of Digital Security',
            'description' => 'Cybersecurity division',
        ]);

        $response->assertRedirect(route('departments.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('departments', [
            'department_name' => 'Department of Digital Security',
        ]);
    }

    public function test_department_name_must_be_unique(): void
    {
        Department::factory()->create(['department_name' => 'Department of Finance']);

        $response = $this->actingAs($this->admin)->post(route('departments.store'), [
            'department_name' => 'Department of Finance',
            'description' => 'Duplicate attempt',
        ]);

        $response->assertSessionHasErrors('department_name');
    }

    public function test_admin_can_update_department(): void
    {
        $department = Department::factory()->create(['department_name' => 'Original Dept']);

        $response = $this->actingAs($this->admin)->put(route('departments.update', $department), [
            'department_name' => 'Updated Dept Name',
            'description' => 'Updated description content',
        ]);

        $response->assertRedirect(route('departments.index'));
        $this->assertDatabaseHas('departments', [
            'id' => $department->id,
            'department_name' => 'Updated Dept Name',
        ]);
    }

    public function test_admin_can_delete_department_without_officers(): void
    {
        $department = Department::factory()->create(['department_name' => 'Empty Dept']);

        $response = $this->actingAs($this->admin)->delete(route('departments.destroy', $department));

        $response->assertRedirect(route('departments.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('departments', ['id' => $department->id]);
    }

    public function test_department_deletion_is_prevented_when_officers_are_assigned(): void
    {
        $department = Department::factory()->create(['department_name' => 'Active Dept']);
        $position = Position::factory()->create();
        Officer::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('departments.destroy', $department));

        $response->assertRedirect(route('departments.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('departments', ['id' => $department->id]);
    }

    public function test_department_search(): void
    {
        Department::factory()->create(['department_name' => 'Logistics Team']);
        Department::factory()->create(['department_name' => 'Healthcare Unit']);

        $response = $this->actingAs($this->admin)->get(route('departments.index', ['search' => 'Logistics']));

        $response->assertStatus(200);
        $response->assertSee('Logistics Team');
        $response->assertDontSee('Healthcare Unit');
    }
}
