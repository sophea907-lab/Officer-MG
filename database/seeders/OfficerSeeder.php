<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Officer;
use App\Models\Position;
use Illuminate\Database\Seeder;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = Department::all();
        $positions = Position::all();

        if ($departments->isEmpty() || $positions->isEmpty()) {
            return;
        }

        $deptIds = $departments->pluck('id')->values()->all();
        $posIds = $positions->pluck('id')->values()->all();

        $officersData = [
            // 1
            [
                'name' => 'Sok Sovann',
                'gender' => 'Male',
                'dob' => '1982-04-12',
                'email' => 'sok.sovann@officers.gov.kh',
                'phone' => '+855 12 884 102',
                'address' => '#45, Preah Norodom Blvd, Sangkat Chey Chumneah, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2012-03-01',
                'salary' => 2800.00,
                'status' => 'Active',
                'dept_idx' => 0,
                'pos_idx' => 0,
            ],
            // 2
            [
                'name' => 'Chan Bopha',
                'gender' => 'Female',
                'dob' => '1985-08-23',
                'email' => 'chan.bopha@officers.gov.kh',
                'phone' => '+855 12 771 904',
                'address' => '#12, St. 214, Sangkat Boeung Raing, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2014-06-15',
                'salary' => 2400.00,
                'status' => 'Active',
                'dept_idx' => 0,
                'pos_idx' => 1,
            ],
            // 3
            [
                'name' => 'Keo Rithy',
                'gender' => 'Male',
                'dob' => '1980-11-05',
                'email' => 'keo.rithy@officers.gov.kh',
                'phone' => '+855 11 324 558',
                'address' => '#88, Samdach Sothearos Blvd, Sangkat Tonle Bassac, Khan Chamkarmon, Phnom Penh',
                'hire_date' => '2011-02-10',
                'salary' => 2200.00,
                'status' => 'Active',
                'dept_idx' => 1,
                'pos_idx' => 2,
            ],
            // 4
            [
                'name' => 'Chea Dara',
                'gender' => 'Male',
                'dob' => '1988-02-19',
                'email' => 'chea.dara@officers.gov.kh',
                'phone' => '+855 16 905 442',
                'address' => '#24, St. 57, Sangkat Boeung Keng Kang I, Khan BKK, Phnom Penh',
                'hire_date' => '2016-09-01',
                'salary' => 1650.00,
                'status' => 'Active',
                'dept_idx' => 1,
                'pos_idx' => 3,
            ],
            // 5
            [
                'name' => 'Heng Khemara',
                'gender' => 'Female',
                'dob' => '1992-05-30',
                'email' => 'heng.khemara@officers.gov.kh',
                'phone' => '+855 92 654 118',
                'address' => '#105, Russian Confederation Blvd, Sangkat Teuk Thla, Khan Sen Sok, Phnom Penh',
                'hire_date' => '2019-01-15',
                'salary' => 1400.00,
                'status' => 'Active',
                'dept_idx' => 1,
                'pos_idx' => 6,
            ],
            // 6
            [
                'name' => 'Meas Pisey',
                'gender' => 'Female',
                'dob' => '1986-09-14',
                'email' => 'meas.pisey@officers.gov.kh',
                'phone' => '+855 78 442 890',
                'address' => '#19, St. 310, Sangkat Olympic, Khan Boeung Keng Kang, Phnom Penh',
                'hire_date' => '2015-04-20',
                'salary' => 2100.00,
                'status' => 'Active',
                'dept_idx' => 2,
                'pos_idx' => 2,
            ],
            // 7
            [
                'name' => 'Seng Socheat',
                'gender' => 'Male',
                'dob' => '1990-12-08',
                'email' => 'seng.socheat@officers.gov.kh',
                'phone' => '+855 99 873 219',
                'address' => '#67, Mao Tse Toung Blvd, Sangkat Toul Svay Prey, Khan BKK, Phnom Penh',
                'hire_date' => '2018-07-01',
                'salary' => 1550.00,
                'status' => 'Active',
                'dept_idx' => 2,
                'pos_idx' => 7,
            ],
            // 8
            [
                'name' => 'Vong Chamroeun',
                'gender' => 'Male',
                'dob' => '1984-07-21',
                'email' => 'vong.chamroeun@officers.gov.kh',
                'phone' => '+855 17 559 342',
                'address' => '#32, St. 271, Sangkat Phsar Doeum Thkov, Khan Chamkarmon, Phnom Penh',
                'hire_date' => '2013-10-10',
                'salary' => 2300.00,
                'status' => 'Active',
                'dept_idx' => 3,
                'pos_idx' => 4,
            ],
            // 9
            [
                'name' => 'Tep Chakriya',
                'gender' => 'Female',
                'dob' => '1993-03-17',
                'email' => 'tep.chakriya@officers.gov.kh',
                'phone' => '+855 85 221 445',
                'address' => '#14, St. 63, Sangkat Phsar Thmey I, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2020-02-01',
                'salary' => 1500.00,
                'status' => 'Active',
                'dept_idx' => 3,
                'pos_idx' => 8,
            ],
            // 10
            [
                'name' => 'Ros Sreymom',
                'gender' => 'Female',
                'dob' => '1991-10-25',
                'email' => 'ros.sreymom@officers.gov.kh',
                'phone' => '+855 10 338 901',
                'address' => '#80, Preah Monivong Blvd, Sangkat Srah Chak, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2017-05-12',
                'salary' => 1350.00,
                'status' => 'Active',
                'dept_idx' => 3,
                'pos_idx' => 5,
            ],
            // 11
            [
                'name' => 'Ouk Visal',
                'gender' => 'Male',
                'dob' => '1987-01-11',
                'email' => 'ouk.visal@officers.gov.kh',
                'phone' => '+855 12 994 002',
                'address' => '#51, Charles de Gaulle Blvd, Sangkat Veal Vong, Khan 7 Makara, Phnom Penh',
                'hire_date' => '2015-11-20',
                'salary' => 2050.00,
                'status' => 'Active',
                'dept_idx' => 4,
                'pos_idx' => 2,
            ],
            // 12
            [
                'name' => 'Pich Rotha',
                'gender' => 'Female',
                'dob' => '1994-06-04',
                'email' => 'pich.rotha@officers.gov.kh',
                'phone' => '+855 93 118 765',
                'address' => '#28, St. 182 (Oknha Tep Phan), Sangkat Depo I, Khan Toul Kork, Phnom Penh',
                'hire_date' => '2021-08-15',
                'salary' => 1250.00,
                'status' => 'Active',
                'dept_idx' => 4,
                'pos_idx' => 5,
            ],
            // 13
            [
                'name' => 'Meng Vibol',
                'gender' => 'Male',
                'dob' => '1979-09-18',
                'email' => 'meng.vibol@officers.gov.kh',
                'phone' => '+855 12 400 812',
                'address' => '#72, Kampuchea Krom Blvd, Sangkat Mittapheap, Khan 7 Makara, Phnom Penh',
                'hire_date' => '2009-04-05',
                'salary' => 2350.00,
                'status' => 'Active',
                'dept_idx' => 5,
                'pos_idx' => 2,
            ],
            // 14
            [
                'name' => 'Nou Thida',
                'gender' => 'Female',
                'dob' => '1989-12-14',
                'email' => 'nou.thida@officers.gov.kh',
                'phone' => '+855 77 662 331',
                'address' => '#09, St. 337, Sangkat Boeung Kak I, Khan Toul Kork, Phnom Penh',
                'hire_date' => '2016-03-22',
                'salary' => 1450.00,
                'status' => 'Active',
                'dept_idx' => 5,
                'pos_idx' => 5,
            ],
            // 15
            [
                'name' => 'Keo Chenda',
                'gender' => 'Female',
                'dob' => '1983-05-22',
                'email' => 'keo.chenda@officers.gov.kh',
                'phone' => '+855 11 889 120',
                'address' => '#93, Samdech Penn Nouth Blvd, Sangkat Boeung Salang, Khan Toul Kork, Phnom Penh',
                'hire_date' => '2013-08-18',
                'salary' => 2250.00,
                'status' => 'Active',
                'dept_idx' => 6,
                'pos_idx' => 9,
            ],
            // 16
            [
                'name' => 'Chhun Makara',
                'gender' => 'Male',
                'dob' => '1995-01-01',
                'email' => 'chhun.makara@officers.gov.kh',
                'phone' => '+855 98 770 125',
                'address' => '#33, National Road 5, Sangkat Chroy Changvar, Khan Chroy Changvar, Phnom Penh',
                'hire_date' => '2022-04-11',
                'salary' => 1100.00,
                'status' => 'Active',
                'dept_idx' => 6,
                'pos_idx' => 11,
            ],
            // 17
            [
                'name' => 'Yim Monika',
                'gender' => 'Female',
                'dob' => '1992-08-16',
                'email' => 'yim.monika@officers.gov.kh',
                'phone' => '+855 89 554 220',
                'address' => '#18, St. 2004, Sangkat Kakab, Khan Por Sen Chey, Phnom Penh',
                'hire_date' => '2018-11-01',
                'salary' => 1400.00,
                'status' => 'Active',
                'dept_idx' => 7,
                'pos_idx' => 10,
            ],
            // 18
            [
                'name' => 'Sin Phearith',
                'gender' => 'Male',
                'dob' => '1988-06-29',
                'email' => 'sin.phearith@officers.gov.kh',
                'phone' => '+855 15 667 890',
                'address' => '#41, Preah Sihanouk Blvd, Sangkat Boeung Keng Kang II, Khan BKK, Phnom Penh',
                'hire_date' => '2017-02-14',
                'salary' => 1600.00,
                'status' => 'Active',
                'dept_idx' => 7,
                'pos_idx' => 3,
            ],
            // 19
            [
                'name' => 'Bun Borey',
                'gender' => 'Male',
                'dob' => '1985-04-03',
                'email' => 'bun.borey@officers.gov.kh',
                'phone' => '+855 12 334 987',
                'address' => '#150, National Road 6A, Sangkat Bak Khaeng, Khan Chroy Changvar, Phnom Penh',
                'hire_date' => '2014-09-01',
                'salary' => 1700.00,
                'status' => 'Active',
                'dept_idx' => 0,
                'pos_idx' => 5,
            ],
            // 20
            [
                'name' => 'Khorn Phally',
                'gender' => 'Female',
                'dob' => '1993-11-19',
                'email' => 'khorn.phally@officers.gov.kh',
                'phone' => '+855 96 332 110',
                'address' => '#62, Veng Sreng Blvd, Sangkat Choam Chao, Khan Por Sen Chey, Phnom Penh',
                'hire_date' => '2020-07-20',
                'salary' => 1200.00,
                'status' => 'Active',
                'dept_idx' => 1,
                'pos_idx' => 11,
            ],
            // 21
            [
                'name' => 'Nhem Somnang',
                'gender' => 'Male',
                'dob' => '1990-07-07',
                'email' => 'nhem.somnang@officers.gov.kh',
                'phone' => '+855 86 441 552',
                'address' => '#05, St. 19, Sangkat Chey Chumneah, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2019-05-15',
                'salary' => 1350.00,
                'status' => 'Active',
                'dept_idx' => 2,
                'pos_idx' => 7,
            ],
            // 22
            [
                'name' => 'Khun Kolab',
                'gender' => 'Female',
                'dob' => '1987-03-24',
                'email' => 'khun.kolab@officers.gov.kh',
                'phone' => '+855 70 889 004',
                'address' => '#77, Preah Sisowath Quay, Sangkat Wat Phnom, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2016-01-10',
                'salary' => 1450.00,
                'status' => 'Active',
                'dept_idx' => 3,
                'pos_idx' => 8,
            ],
            // 23
            [
                'name' => 'Mao Nimol',
                'gender' => 'Female',
                'dob' => '1996-09-12',
                'email' => 'mao.nimol@officers.gov.kh',
                'phone' => '+855 92 110 998',
                'address' => '#84, St. 598, Sangkat Chrang Chamreh I, Khan Russey Keo, Phnom Penh',
                'hire_date' => '2023-01-05',
                'salary' => 950.00,
                'status' => 'Active',
                'dept_idx' => 4,
                'pos_idx' => 11,
            ],
            // 24
            [
                'name' => 'Kong Veasna',
                'gender' => 'Male',
                'dob' => '1981-12-03',
                'email' => 'kong.veasna@officers.gov.kh',
                'phone' => '+855 12 554 332',
                'address' => '#29, St. 289, Sangkat Boeung Kak II, Khan Toul Kork, Phnom Penh',
                'hire_date' => '2012-12-01',
                'salary' => 1900.00,
                'status' => 'Active',
                'dept_idx' => 5,
                'pos_idx' => 3,
            ],
            // 25
            [
                'name' => 'Vann Ratana',
                'gender' => 'Male',
                'dob' => '1994-04-18',
                'email' => 'vann.ratana@officers.gov.kh',
                'phone' => '+855 17 889 221',
                'address' => '#112, Hun Sen Blvd (60m), Sangkat Chak Angre Krom, Khan Meanchey, Phnom Penh',
                'hire_date' => '2021-03-01',
                'salary' => 1300.00,
                'status' => 'Active',
                'dept_idx' => 6,
                'pos_idx' => 5,
            ],
            // 26
            [
                'name' => 'Srun Kunthea',
                'gender' => 'Female',
                'dob' => '1991-05-15',
                'email' => 'srun.kunthea@officers.gov.kh',
                'phone' => '+855 88 776 554',
                'address' => '#40, St. 360, Sangkat Boeung Keng Kang III, Khan BKK, Phnom Penh',
                'hire_date' => '2018-04-10',
                'salary' => 1400.00,
                'status' => 'Active',
                'dept_idx' => 7,
                'pos_idx' => 10,
            ],
            // 27 (Inactive)
            [
                'name' => 'Roeun Sreyneang',
                'gender' => 'Female',
                'dob' => '1995-07-28',
                'email' => 'roeun.sreyneang@officers.gov.kh',
                'phone' => '+855 93 445 119',
                'address' => '#15, St. 136, Sangkat Phsar Kandal I, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2022-09-01',
                'salary' => 1050.00,
                'status' => 'Inactive',
                'dept_idx' => 0,
                'pos_idx' => 11,
            ],
            // 28 (Inactive)
            [
                'name' => 'Pheng Chhay',
                'gender' => 'Male',
                'dob' => '1986-02-17',
                'email' => 'pheng.chhay@officers.gov.kh',
                'phone' => '+855 77 990 114',
                'address' => '#56, St. 432, Sangkat Toul Tompoung II, Khan Chamkarmon, Phnom Penh',
                'hire_date' => '2015-08-15',
                'salary' => 1600.00,
                'status' => 'Inactive',
                'dept_idx' => 1,
                'pos_idx' => 5,
            ],
            // 29 (Inactive)
            [
                'name' => 'Rin Chantrea',
                'gender' => 'Female',
                'dob' => '1990-09-09',
                'email' => 'rin.chantrea@officers.gov.kh',
                'phone' => '+855 12 778 334',
                'address' => '#99, St. 105, Sangkat Boeung Prolit, Khan 7 Makara, Phnom Penh',
                'hire_date' => '2019-10-01',
                'salary' => 1350.00,
                'status' => 'Inactive',
                'dept_idx' => 2,
                'pos_idx' => 6,
            ],
            // 30 (Inactive)
            [
                'name' => 'Ly Malis',
                'gender' => 'Female',
                'dob' => '1993-01-25',
                'email' => 'ly.malis@officers.gov.kh',
                'phone' => '+855 10 994 553',
                'address' => '#21, St. 608, Sangkat Boeung Kak II, Khan Toul Kork, Phnom Penh',
                'hire_date' => '2020-12-01',
                'salary' => 1400.00,
                'status' => 'Inactive',
                'dept_idx' => 3,
                'pos_idx' => 8,
            ],
            // 31 (Resigned)
            [
                'name' => 'Keo Ratanak',
                'gender' => 'Male',
                'dob' => '1984-10-10',
                'email' => 'keo.ratanak@officers.gov.kh',
                'phone' => '+855 11 223 889',
                'address' => '#64, St. 143, Sangkat Veal Vong, Khan 7 Makara, Phnom Penh',
                'hire_date' => '2013-05-20',
                'salary' => 1800.00,
                'status' => 'Resigned',
                'dept_idx' => 4,
                'pos_idx' => 4,
            ],
            // 32 (Resigned)
            [
                'name' => 'Sam Sary',
                'gender' => 'Female',
                'dob' => '1988-08-14',
                'email' => 'sam.sary@officers.gov.kh',
                'phone' => '+855 78 112 443',
                'address' => '#08, St. 240, Sangkat Chaktomuk, Khan Daun Penh, Phnom Penh',
                'hire_date' => '2016-06-01',
                'salary' => 1500.00,
                'status' => 'Resigned',
                'dept_idx' => 5,
                'pos_idx' => 7,
            ],
            // 33 (Resigned)
            [
                'name' => 'Tep Vicheka',
                'gender' => 'Male',
                'dob' => '1992-04-02',
                'email' => 'tep.vicheka@officers.gov.kh',
                'phone' => '+855 85 990 441',
                'address' => '#47, St. 163, Sangkat Olympic, Khan BKK, Phnom Penh',
                'hire_date' => '2019-03-10',
                'salary' => 1350.00,
                'status' => 'Resigned',
                'dept_idx' => 6,
                'pos_idx' => 10,
            ],
            // 34
            [
                'name' => 'Chakriya Sreypov',
                'gender' => 'Female',
                'dob' => '1996-12-20',
                'email' => 'chakriya.sreypov@officers.gov.kh',
                'phone' => '+855 96 889 001',
                'address' => '#102, St. 1986, Sangkat Phnom Penh Thmey, Khan Sen Sok, Phnom Penh',
                'hire_date' => '2023-05-15',
                'salary' => 980.00,
                'status' => 'Active',
                'dept_idx' => 7,
                'pos_idx' => 11,
            ],
            // 35
            [
                'name' => 'Vong Pheakdey',
                'gender' => 'Other',
                'dob' => '1994-09-05',
                'email' => 'vong.pheakdey@officers.gov.kh',
                'phone' => '+855 12 660 771',
                'address' => '#38, St. 315, Sangkat Boeung Kak I, Khan Toul Kork, Phnom Penh',
                'hire_date' => '2021-11-01',
                'salary' => 1420.00,
                'status' => 'Active',
                'dept_idx' => 0,
                'pos_idx' => 5,
            ],
        ];

        foreach ($officersData as $item) {
            $deptId = $deptIds[$item['dept_idx'] % count($deptIds)];
            $posId = $posIds[$item['pos_idx'] % count($posIds)];

            Officer::firstOrCreate(
                ['email' => $item['email']],
                [
                    'officer_name' => $item['name'],
                    'gender' => $item['gender'],
                    'dob' => $item['dob'],
                    'email' => $item['email'],
                    'phone' => $item['phone'],
                    'address' => $item['address'],
                    'hire_date' => $item['hire_date'],
                    'salary' => $item['salary'],
                    'status' => $item['status'],
                    'department_id' => $deptId,
                    'position_id' => $posId,
                ]
            );
        }
    }
}
