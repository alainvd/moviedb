<?php

namespace Database\Seeders;

use App\Title;
use Illuminate\Database\Seeder;

class TitleSeeder extends Seeder
{

    public $titles = [
        [
            'name' => 'Director/Project Leader',
            'code' => 'DIRECTOR'
        ],
        [
            'name' => 'Author/(Script)writer/Creator',
            'code' => 'AUTHOR'
        ],
        [
            'name' => 'Script-editor',
            'code' => 'SCRIPTEDITOR'
        ],
        [
            'name' => 'Composer',
            'code' => 'COMPOSER'
        ],
        [
            'name' => 'Production Designer',
            'code' => 'PRODDESIGNER'
        ],
        [
            'name' => 'Director of Photography',
            'code' => 'DIRPHOTOGRAPHY'
        ],
        [
            'name' => 'Editor',
            'code' => 'EDITOR'
        ],
        [
            'name' => 'Sound',
            'code' => 'SOUND'
        ],
        [
            'name' => 'Storyboard Artist',
            'code' => 'STORYARTIST'
        ],
        [
            'name' => 'Graphic artist',
            'code' => 'GRAPHICARTIST'
        ],
        [
            'name' => 'Character Designer',
            'code' => 'CHARDESIGNER'
        ],
        [
            'name' => 'Animation Supervisor',
            'code' => 'ANIMATIONSUP'
        ],
        [
            'name' => 'Art(istic) Director',
            'code' => 'ARTDIRECTOR'
        ],
        [
            'name' => 'Technical Director',
            'code' => 'TECHDIRECTOR'
        ],
        [
            'name' => 'Head of Development',
            'code' => 'HEADDEV'
        ],
        [
            'name' => 'Producer',
            'code' => 'PRODUCER'
        ],
        [
            'name' => 'Creative Director',
            'code' => 'CREATIVEDIR'
        ],
        [
            'name' => 'Game Designer',
            'code' => 'GAMEDESIGNER'
        ],
        [
            'name' => 'Lead Programmer',
            'code' => 'LEADPROGRAMMER'
        ],
        [
            'name' => 'Cast/Voice Talent',
            'code' => 'CASTTALENT'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->titles as $title) {
            Title::create([
                'name' => $title['name'],
                'code' => $title['code'],
            ]);
        }
    }
}
