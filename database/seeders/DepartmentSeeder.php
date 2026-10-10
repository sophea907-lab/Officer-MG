<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            [
                'department_name' => 'Department of Administration & General Affairs',
                'description' => 'Coordinates executive documentation, office facilities, protocols, and internal administrative support.',
            ],
            [
                'department_name' => 'Department of Human Resources & Personnel',
                'description' => 'Manages talent recruitment, officer appraisals, civil service welfare, promotions, and payroll records.',
            ],
            [
                'department_name' => 'Department of Finance & Accounting',
                'description' => 'Oversees budget planning, disbursement control, financial audits, expenditure reporting, and fiscal governance.',
            ],
            [
                'department_name' => 'Department of Information Technology & Digital Systems',
                'description' => 'Maintains enterprise servers, software architecture, network cybersecurity, and administrative databases.',
            ],
            [
                'department_name' => 'Department of Planning & Public Policy',
                'description' => 'Develops strategic milestones, research policies, institutional performance reviews, and yearly roadmaps.',
            ],
            [
                'department_name' => 'Department of Inspection & Internal Audit',
                'description' => 'Ensures accountability, transparency, anti-corruption compliance, and adherence to state regulations.',
            ],
            [
                'department_name' => 'Department of Legal Affairs & Compliance',
                'description' => 'Provides regulatory advisory, drafts ministerial decrees, handles contracts, and manages institutional litigation.',
            ],
            [
                'department_name' => 'Department of Public Relations & International Cooperation',
                'description' => 'Handles official press statements, media communications, bilateral partnerships, and global delegations.',
            ],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(
                ['department_name' => $dept['department_name']],
                $dept
            );
        }
    }
}
