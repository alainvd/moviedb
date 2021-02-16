<div class="w-full mt-8">
    <h3 class="text-lg text-gray-900 text-left leading-10">Instructions</h3>

    <p class="text-md text-gray-900 text-left leading-6">
        In order to complete your application for funding under the Creative Europe MEDIA programme, the information on the audiovisual works being part of the application needs to be created and added.
    </p>

    @if (Auth::user()->hasRole('applicant'))
        @if (in_array($dossier->action->name, ['DISTSEL', 'DISTSAG']))
            @include('dossiers.instructions.dist')
        @elseif ($dossier->action->name === 'DEVSLATE')
            @include('dossiers.instructions.devslate')
        @elseif ($dossier->action->name === 'DEVSLATEMINI')
            @include('dossiers.instructions.devslatemini')
        @elseif ($dossier->action->name === 'DEVCO')
            @include('dossiers.instructions.devco')
        @endif
    @endif
</div>
