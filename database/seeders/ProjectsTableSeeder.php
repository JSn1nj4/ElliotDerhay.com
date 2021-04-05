<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * List project data to seed database with
     */
    private $project_list = [
        [
            'name' => 'ElliotDerhay.com',
            'link' => 'https://github.com/JSn1nj4/ElliotDerhay.com',
            'demo_link' => 'http://elliotderhay.com',
            'thumbnail' => 'https://elliotderhay-com.s3.amazonaws.com/projects/elliotderhay.com.jpg',
            'short_desc' => 'My personal website project built with Laravel, Tailwind CSS, and some Vue.js',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->project_list)->each(fn ($item, $key) => Project::create($item));
    }
}
