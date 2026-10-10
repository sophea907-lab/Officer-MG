<?php

namespace Tests\Feature;

use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RelationshipTest extends TestCase
{
    use RefreshDatabase;

    public function test_department_has_many_officers(): void
    {
        $department = Department::factory()->create();
        $position = Position::factory()->create();

        $officer1 = Officer::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);
        $officer2 = Officer::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);

        $this->assertCount(2, $department->officers);
        $this->assertTrue($department->officers->contains($officer1));
        $this->assertTrue($department->officers->contains($officer2));
    }

    public function test_position_has_many_officers(): void
    {
        $department = Department::factory()->create();
        $position = Position::factory()->create();

        $officer = Officer::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);

        $this->assertCount(1, $position->officers);
        $this->assertTrue($position->officers->contains($officer));
    }

    public function test_officer_belongs_to_department_and_position(): void
    {
        $department = Department::factory()->create(['department_name' => 'Ministry of Foreign Affairs']);
        $position = Position::factory()->create(['position_name' => 'Undersecretary of State']);

        $officer = Officer::factory()->create([
            'department_id' => $department->id,
            'position_id' => $position->id,
        ]);

        $this->assertInstanceOf(Department::class, $officer->department);
        $this->assertEquals('Ministry of Foreign Affairs', $officer->department->department_name);

        $this->assertInstanceOf(Position::class, $officer->position);
        $this->assertEquals('Undersecretary of State', $officer->position->position_name);
    }
}
