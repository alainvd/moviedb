@if (Auth::user()->hasRole('applicant'))
    <div class="w-full mt-8">
        <h3 class="text-lg leading-10 text-left text-gray-900">Instructions</h3>

        <p class="leading-6 text-left text-gray-900 text-md">
            In order to complete your application for funding under the Creative Europe MEDIA strand, the information on the audiovisual works being part of the application needs to be created and added.
        </p>

    @if (Auth::user()->hasRole('applicant'))
        @if (in_array($dossier->action->name, ['FILMOVE', 'DISTSAG']))
            @include('dossiers.instructions.dist')
        @elseif ($dossier->action->name === 'DEVSLATE')
            @include('dossiers.instructions.devslate')
        @elseif ($dossier->action->name === 'DEVMINISLATE')
            @include('dossiers.instructions.devminislate')
        @elseif ($dossier->action->name === 'CODEV')
            @include('dossiers.instructions.codev')
        @elseif ($dossier->action->name === 'DEVVG')
            @include('dossiers.instructions.devvg')
        @elseif ($dossier->action->name === 'TVONLINE')
            @include('dossiers.instructions.tvonline')
        @elseif ($dossier->action->name === 'DISTAUTOG')
            @include('dossiers.instructions.distautog')
        @endif
    @endif
</div>
@endif
