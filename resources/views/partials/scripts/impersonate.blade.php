@if(App::environment()!=='production')
<div class="print:hidden"><a href="{{ route('impersonate', ['id' => 1]) }}">Act as applicant</a> | <a href="{{ route('impersonate', ['id' => 2]) }}">Act as editor</a> | <a href="{{ route('impersonate_stop') }}">Reset</a></div>
@endif