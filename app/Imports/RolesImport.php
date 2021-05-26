<?php

namespace App\Imports;

use App\Models\Title;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class RolesImport implements ToModel, WithHeadingRow
{

    public function rolesCodeMap($role_code)
    {
        switch ($role_code) {
            case 'AC1':
                return 'ACTOR1';
            case 'AC2':
                return 'ACTOR2';
            case 'AC3':
                return 'ACTOR3';

            case 'AD1':
            case 'AD2':
            case 'AD3':
            case 'AD4':
            case 'AD5':
                return 'PRODDESIGNER';

            case 'CO1':
            case 'CO2':
            case 'CO3':
            case 'CO4':
            case 'CO5':
                return 'COMPOSER';

            case 'CP1':
            case 'CP2':
            case 'CP3':
            case 'CP4':
            case 'CP5':
                return 'COPRODUCER';

            case 'DI1':
            case 'DI2':
            case 'DI3':
            case 'DI4':
            case 'DI5':
                return 'DIRECTOR';

            case 'DP1':
            case 'DP2':
            case 'DP3':
            case 'DP4':
            case 'DP5':
                return 'DIRPHOTOGRAPHY';

            case 'ED1':
            case 'ED2':
            case 'ED3':
            case 'ED4':
            case 'ED5':
                return 'EDITOR';

            // Not in data set
            // case 'SA1':
            //     return 'SA';

            case 'SC1':
            case 'SC2':
            case 'SC3':
            case 'SC4':
            case 'SC5':
                return 'AUTHOR';

            case 'SD1':
            case 'SD2':
            case 'SD3':
            case 'SD4':
            case 'SD5':
                return 'SOUND';

            case 'PR':
                return 'COPRODUCER';

            case 'AUT_SCRI_CRE_CREA':
                return 'AUTHOR';

            case 'DIR_PROLEA_CREA':
                return 'DIRECTOR';    
    
            case 'ROLCOM':
                return 'COMPOSER';
    
            case 'ROLDPH':
                return 'DIRPHOTOGRAPHY';
    
            case 'ROLGPA':
                return 'GRAPHICARTIST';

            // Not in data set
            // case 'ROLOTH':
            //     return 'ROLOTH';

            // Not in data set
            // case 'ROLPCA':
            //     return 'ROLPCA';

            case 'ROLSED':
                return 'SCRIPTEDITOR';

        }
        echo "Error: no match for role code '".$role_code."'";
    }

    public static function rolesNameMap($role_name)
    {

        switch($role_name) {
            case 'Actor 1':
                return 'ACTOR1';
            case 'Actor 2':
                return 'ACTOR2';
            case 'Actor 3':
                return 'ACTOR3';

            case 'Production Designer':
            case 'Production Designer 2':
            case 'Production Designer 3':
            case 'Production Designer 4':
            case 'Production Designer 5':
                return 'PRODDESIGNER';

            case 'Composer':
            case 'Composer 2':
            case 'Composer 3':
            case 'Composer 4':
            case 'Composer 5':
                return 'COMPOSER';

            case 'Co-producer 1':
            case 'Co-producer 2':
            case 'Co-producer 3':
            case 'Co-producer 4':
            case 'Co-producer 5':
                return 'COPRODUCER';

            case 'Director':
            case 'Director 2':
            case 'Director 3':
            case 'Director 4':
            case 'Director 5':
                return 'DIRECTOR';

            case 'Director of Photography':
            case 'Director of Photography 2':
            case 'Director of Photography 3':
            case 'Director of Photography 4':
            case 'Director of Photography 5':
                return 'DIRPHOTOGRAPHY';

            case 'Editor':
            case 'Editor 2':
            case 'Editor 3':
            case 'Editor 4':
            case 'Editor 5':
                return 'EDITOR';

            // Not in data set
            // case 'Sales Agent':
            //     return 'SA';

            case 'ScriptWriter':
            case 'ScriptWriter 2':
            case 'ScriptWriter 3':
            case 'ScriptWriter 4':
            case 'ScriptWriter 5':
                return 'AUTHOR';

            case 'Sound':
            case 'Sound 2':
            case 'Sound 3':
            case 'Sound 4':
            case 'Sound 5':
                return 'SOUND';

            case 'Producer':
                return 'PRODUCER';
                
            case 'Author/Script-writer/Creator':
                return 'AUTHOR';

            case 'Director/Project Leader':
                return 'DIRECTOR';

            case 'Composer':
                return 'COMPOSER';

            case 'Director of Photography':
                return 'DIRPHOTOGRAPHY';

            case 'Graphic Artist':
                return 'GRAPHICARTIST';

            // Not in data set
            // case 'Other':
            //     return 'ROLOTH';

            // Not in data set
            // case 'Principal Cast':
            //     return 'ROLPCA';

            case 'Script Editor':
                return 'SCRIPTEDITOR';
        }
        echo "Error: no match for role name '".$role_name."'";
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Title([
            'name' => $row['film_role_name'],
            'code' => $this->rolesCodeMap($row['film_role_code'])
        ]);
    }

}
