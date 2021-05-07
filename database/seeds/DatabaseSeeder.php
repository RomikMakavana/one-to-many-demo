<?php

use App\User;
use App\Skill;
use App\Education;
use App\Experience;
use App\Certificate;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $users = [
            [
                "name" => "Joshua C. Dunham",
                "email" => "JoshuaCDunham@teleworm.us",
                "skills" => ["Problem Solving", "Communication", "Accounting", "Negotiation"],
                "educations" => [
                    [
                        "degree" => "Diploma in civil engineeringGradeA",
                        "start_year" => "2006",
                        "end_year" => "2009",
                        "school" => "DELHI INSTITUTE OF ENGINEERING AND STUDIES"
                    ],
                    [
                        "degree" => "MatriculationField Of StudyPCMGradeA",
                        "start_year" => "1996",
                        "end_year" => "1997",
                        "school" => "PMHS"
                    ]
                ],
                "experiences" => [
                    [
                        "title" => "Senior Talent Acquisition Specialist - IT",
                        "employment_type" => "full-time",
                        "company" => "BayLeaf HR Solutions Pvt. ltd",
                        "description" => "Hiring For Sapient Global Market - Gurgaon & Bangalore. Hiring for Microland - Multiple locations.",
                    ],
                    [
                        "title" => "Talent Acquisition Specialist - IT",
                        "employment_type" => "full-time",
                        "company" => "BayLeaf HR Solutions Pvt. ltd",
                        "description" => "End to End Recruitment Client Coordination Supply Chain & Logistics Hiring",
                    ]
                ],
                "certificates" => [
                    [
                        "title" => "Complete Python Bootcamp | Deep Learning Into Python Coding",
                        "organization" => "Udemy",
                        "certificate_id" => "PY-6151"
                    ],
                    [
                        "title" => "Core Java Professional - Level 1",
                        "organization" => "RankSheet Online Services Pvt. Ltd.",
                        "certificate_id" => "JAVA-528f2538"
                    ]
                ]
            ],
            [
                "name" => "Cedrick J. Brooks",
                "email" => "CedrickJBrooks@rhyta.com",
                "skills" => ["Customer Service.", "Python", "PHP", "Laravel"],
                "educations" => [
                    [
                        "degree" => "Mechanical engineering",
                        "start_year" => "2011",
                        "end_year" => "2013",
                        "school" => "Saurashtra University"
                    ],
                    [
                        "degree" => "BCA - Bachelor of Computer ApplicationField Of Study",
                        "start_year" => "1996",
                        "end_year" => "1997",
                        "school" => "Gujarat Technological University, Ahmedbabd"
                    ]
                ],
                "experiences" => [
                    [
                        "title" => "React Native Developer",
                        "employment_type" => "full-time",
                        "company" => "Hyperlink Infosystem",
                        "description" => "",
                    ],
                    [
                        "title" => "Junior React Native Developer",
                        "employment_type" => "full-time",
                        "company" => "Start Solutions Pvt. ltd",
                        "description" => "",
                    ]
                ],
                "certificates" => [
                    [
                        "title" => "PHP Coding",
                        "organization" => "Udemy",
                        "certificate_id" => "PHP-6151"
                    ],
                    [
                        "title" => "Testing JS - Level 1",
                        "organization" => "Academy Online Services Pvt. Ltd.",
                        "certificate_id" => "JS-528f2538"
                    ]
                ]
            ],
            [
                "name" => "Kimberly S. Blair",
                "email" => "KimberlySBlair@teleworm.us",
                "skills" => ["Javascript", "Node Js", "Python", "Software Engineering"],
                "educations" => [
                    [
                        "degree" => "GPP HIGH SCHOOL",
                        "start_year" => "1996",
                        "end_year" => "1997",
                        "school" => "MITHIBAI COLLEGE OF COMMERCE & ECONOMICS"
                    ],
                    [
                        "degree" => "Bachelor's degreeField Of StudyBusiness/Commerce",
                        "start_year" => "2006",
                        "end_year" => "2009",
                        "school" => "Mithibai College of Arts Chauhan Institute of Science and A.J. College of Commerce and Economics"
                    ]
                ],
                "experiences" => [
                    [
                        "title" => "Associate Financial Controller",
                        "employment_type" => "full-time",
                        "company" => "HGS - Hinduja Global Solutions",
                        "description" => "# SAP FICO ECC 6.0, Accounts Receivables & Training & Hire Process.",
                    ],
                    [
                        "title" => "HR Recruiter (IT, NOT IT & Engineering)",
                        "employment_type" => "full-time",
                        "company" => "MANFRONT HR SOLUTION",
                        "description" => "IT Recruitment for - Collabera Technology Baroda.",
                    ]
                ],
                "certificates" => []
            ]
        ];
        foreach ($users as $key => $user) {
            $userDetails = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => '123456'
            ]);

            $educations = array_map(function($val)use($userDetails){ $val['user_id'] = $userDetails['id']; return $val; }, $user['educations']);
            $skills = array_map(function($val)use($userDetails){ return ['user_id' => $userDetails['id'], 'skill' => $val]; }, $user['skills']);
            $experiences = array_map(function($val)use($userDetails){ $val['user_id'] = $userDetails['id']; return $val; }, $user['experiences']);
            $certificates = array_map(function($val)use($userDetails){ $val['user_id'] = $userDetails['id']; return $val; }, $user['certificates']);

            Education::insert($educations);
            Skill::insert($skills);
            Experience::insert($experiences);
            Certificate::insert($certificates);
        }

    }
}
