<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $positions = [
            [
                'position_name' => 'Director General',
                'description' => 'Highest administrative officer responsible for executive decisions, strategic governance, and ministry liaison.',
            ],
            [
                'position_name' => 'Deputy Director General',
                'description' => 'Assists executive leadership in overseeing operational wings, departmental deliverables, and institutional initiatives.',
            ],
            [
                'position_name' => 'Head of Department',
                'description' => 'Supervises departmental affairs, approves operational expenditures, and reviews team performance metrics.',
            ],
            [
                'position_name' => 'Deputy Head of Department',
                'description' => 'Coordinates divisional workflows, supports team leads, and acts on behalf of the department head during absence.',
            ],
            [
                'position_name' => 'Chief Systems Engineer',
                'description' => 'Leads IT infrastructure, software modernization, network topology design, and cloud server administration.',
            ],
            [
                'position_name' => 'Senior Administrative Officer',
                'description' => 'Coordinates inter-departmental documentation, logistics, VIP meetings, and official administrative records.',
            ],
            [
                'position_name' => 'Human Resources Specialist',
                'description' => 'Handles personnel recruitment, officer records, leave approvals, medical insurance, and training programs.',
            ],
            [
                'position_name' => 'Senior Financial Analyst',
                'description' => 'Audits balance sheets, prepares fiscal budgets, monitors departmental expenses, and drafts revenue reports.',
            ],
            [
                'position_name' => 'Database Administrator',
                'description' => 'Ensures high availability, security auditing, daily backups, and optimization of relational MySQL databases.',
            ],
            [
                'position_name' => 'Legal Affairs Counsel',
                'description' => 'Advises on statutory compliance, reviews bilateral agreements, and drafts public policy legal declarations.',
            ],
            [
                'position_name' => 'Public Relations Officer',
                'description' => 'Coordinates media briefings, manages public broadcasts, and drafts official press announcements.',
            ],
            [
                'position_name' => 'Junior Administrative Assistant',
                'description' => 'Assists with correspondence, physical filings, receptionist duties, schedule bookings, and documentation.',
            ],
        ];

        foreach ($positions as $pos) {
            Position::firstOrCreate(
                ['position_name' => $pos['position_name']],
                $pos
            );
        }
    }
}
