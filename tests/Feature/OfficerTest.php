<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OfficerTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    private Department $deptA;

    private Department $deptB;

    private Position $posA;

    private Position $posB;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create();
        $this->deptA = Department::factory()->create(['department_name' => 'Dept Alpha']);
        $this->deptB = Department::factory()->create(['department_name' => 'Dept Beta']);
        $this->posA = Position::factory()->create(['position_name' => 'Role Alpha']);
        $this->posB = Position::factory()->create(['position_name' => 'Role Beta']);
    }

    public function test_guest_cannot_access_officers(): void
    {
        $response = $this->get(route('officers.index'));
        $response->assertRedirect(route('login'));
    }

    public function test_admin_can_view_officers_list(): void
    {
        Officer::factory()->create([
            'officer_name' => 'Sok Sovann',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('officers.index'));

        $response->assertStatus(200);
        $response->assertSee('Sok Sovann');
        $response->assertSee('Dept Alpha');
        $response->assertSee('Role Alpha');
    }

    public function test_admin_can_view_single_officer_details(): void
    {
        $officer = Officer::factory()->create([
            'officer_name' => 'Chan Bopha',
            'email' => 'chan.bopha@test.gov.kh',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('officers.show', $officer));

        $response->assertStatus(200);
        $response->assertSee('Chan Bopha');
        $response->assertSee('chan.bopha@test.gov.kh');
        $response->assertSee('Dept Alpha');
    }

    public function test_admin_can_create_officer_with_valid_data(): void
    {
        $data = [
            'officer_name' => 'Keo Rithy',
            'gender' => 'Male',
            'dob' => '1990-05-15',
            'email' => 'keo.rithy@test.gov.kh',
            'phone' => '+855 12 345 678',
            'address' => '#12, Preah Norodom Blvd, Phnom Penh',
            'hire_date' => '2020-01-10',
            'salary' => 1500.50,
            'status' => 'Active',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ];

        $response = $this->actingAs($this->admin)->post(route('officers.store'), $data);

        $response->assertRedirect(route('officers.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('officers', [
            'email' => 'keo.rithy@test.gov.kh',
            'officer_name' => 'Keo Rithy',
            'department_id' => $this->deptA->id,
        ]);
    }

    public function test_officer_creation_requires_unique_email(): void
    {
        Officer::factory()->create(['email' => 'existing@officer.gov.kh']);

        $response = $this->actingAs($this->admin)->post(route('officers.store'), [
            'officer_name' => 'Duplicate Officer',
            'gender' => 'Male',
            'dob' => '1990-01-01',
            'email' => 'existing@officer.gov.kh',
            'phone' => '+855 12 345 678',
            'address' => 'Some address',
            'hire_date' => '2021-01-01',
            'salary' => 1000,
            'status' => 'Active',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_admin_can_update_officer(): void
    {
        $officer = Officer::factory()->create([
            'officer_name' => 'Original Name',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);

        $response = $this->actingAs($this->admin)->put(route('officers.update', $officer), [
            'officer_name' => 'Updated Officer Name',
            'gender' => 'Female',
            'dob' => '1992-03-20',
            'email' => $officer->email, // keeping same email is allowed
            'phone' => '+855 99 888 777',
            'address' => 'Updated Street 214, Phnom Penh',
            'hire_date' => '2021-05-01',
            'salary' => 1850.00,
            'status' => 'Inactive',
            'department_id' => $this->deptB->id,
            'position_id' => $this->posB->id,
        ]);

        $response->assertRedirect(route('officers.index'));
        $this->assertDatabaseHas('officers', [
            'id' => $officer->id,
            'officer_name' => 'Updated Officer Name',
            'status' => 'Inactive',
            'department_id' => $this->deptB->id,
        ]);
    }

    public function test_admin_can_delete_officer(): void
    {
        $officer = Officer::factory()->create([
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);

        $response = $this->actingAs($this->admin)->delete(route('officers.destroy', $officer));

        $response->assertRedirect(route('officers.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseMissing('officers', ['id' => $officer->id]);
    }

    public function test_officer_search_by_name(): void
    {
        Officer::factory()->create([
            'officer_name' => 'Heng Khemara',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);
        Officer::factory()->create([
            'officer_name' => 'Seng Socheat',
            'department_id' => $this->deptB->id,
            'position_id' => $this->posB->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('officers.index', ['search' => 'Khemara']));

        $response->assertStatus(200);
        $response->assertSee('Heng Khemara');
        $response->assertDontSee('Seng Socheat');
    }

    public function test_officer_filtering_by_department(): void
    {
        Officer::factory()->create([
            'officer_name' => 'Officer In Dept A',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);
        Officer::factory()->create([
            'officer_name' => 'Officer In Dept B',
            'department_id' => $this->deptB->id,
            'position_id' => $this->posB->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('officers.index', [
            'department_id' => $this->deptA->id,
        ]));

        $response->assertStatus(200);
        $response->assertSee('Officer In Dept A');
        $response->assertDontSee('Officer In Dept B');
    }

    public function test_officer_filtering_by_status(): void
    {
        Officer::factory()->create([
            'officer_name' => 'Active Officer',
            'status' => 'Active',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);
        Officer::factory()->create([
            'officer_name' => 'Resigned Officer',
            'status' => 'Resigned',
            'department_id' => $this->deptA->id,
            'position_id' => $this->posA->id,
        ]);

        $response = $this->actingAs($this->admin)->get(route('officers.index', [
            'status' => 'Resigned',
        ]));

        $response->assertStatus(200);
        $response->assertSee('Resigned Officer');
        $response->assertDontSee('Active Officer');
    }
}
