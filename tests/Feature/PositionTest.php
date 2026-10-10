<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PositionTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
    }

    public function test_guest_cannot_access_positions(): void
    {
        $response = $this->get(route('positions.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_view_positions_list(): void
    {
        Position::factory()->create(['position_name' => 'Lead Security Architect']);

        $response = $this->actingAs($this->admin)->get(route('positions.index'));

        $response->assertStatus(200);
        $response->assertSee('Lead Security Architect');
    }

    public function test_admin_can_create_position(): void
    {
        $response = $this->actingAs($this->admin)->post(route('positions.store'), [
            'position_name' => 'Chief Technology Strategist',
            'description' => 'Oversees institutional innovations',
        ]);

        $response->assertRedirect(route('positions.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('positions', [
            'position_name' => 'Chief Technology Strategist',
        ]);
    }

    public function test_position_name_must_be_unique(): void
    {
        Position::factory()->create(['position_name' => 'Director General']);

        $response = $this->actingAs($this->admin)->post(route('positions.store'), [
            'position_name' => 'Director General',
            'description' => 'Duplicate title',
        ]);

        $response->assertSessionHasErrors('position_name');
    }

    public function test_admin_can_update_position(): void
    {
        $position = Position::factory()->create(['position_name' => 'Original Role']);

        $response = $this->actingAs($this->admin)->put(route('positions.update', $position), [
            'position_name' => 'Renamed Senior Role',
            'description' => 'Revised role tasks',
        ]);

        $response->assertRedirect(route('positions.index'));
        $this->assertDatabaseHas('positions', [
            'id' => $position->id,
            'position_name' => 'Renamed Senior Role',
        ]);
    }

    public function test_admin_can_delete_position_without_officers(): void
    {
        $position = Position::factory()->create(['position_name' => 'Unused Role']);

        $response = $this->actingAs($this->admin)->delete(route('positions.destroy', $position));

        $response->assertRedirect(route('positions.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('positions', ['id' => $position->id]);
    }

    public function test_position_deletion_is_prevented_when_officers_are_assigned(): void
    {
        $position = Position::factory()->create(['position_name' => 'Occupied Role']);
        $department = Department::factory()->create();
        Officer::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('positions.destroy', $position));

        $response->assertRedirect(route('positions.index'));
        $response->assertSessionHas('error');
        $this->assertDatabaseHas('positions', ['id' => $position->id]);
    }

    public function test_position_search(): void
    {
        Position::factory()->create(['position_name' => 'Network Engineer']);
        Position::factory()->create(['position_name' => 'Financial Advisor']);

        $response = $this->actingAs($this->admin)->get(route('positions.index', ['search' => 'Network']));

        $response->assertStatus(200);
        $response->assertSee('Network Engineer');
        $response->assertDontSee('Financial Advisor');
    }
}
