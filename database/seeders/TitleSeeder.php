<?php

namespace Database\Seeders;

use App\Title;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{

    public $titles = [
        'Director/Project Leader',
        'Author/(Script)writer/Creator',
        'Script-editor',
        'Composer',
        'Production Designer',
        'Director of Photgraphy',
        'Editor',
        'Sound',
        'Storyboard Artist',
        'Graphic artist',
        'Character Designer',
        'Animation Supervisor',
        'Art(istic) Director',
        'Technical Director',
        'Head of Development',
        'Producer',
        'Creative Director',
        'Game Designer',
        'Lead Programmer',
        'Cast/Voice Talent',
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->titles as $title) {
            Title::create(['name' => $title]);
        }
    }
}
