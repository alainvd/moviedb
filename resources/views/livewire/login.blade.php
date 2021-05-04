
<div class="ecl-site-header-harmonised__login-container">
    <a class="ecl-link ecl-link--standalone ecl-site-header-harmonised__login-toggle" href="#" data-ecl-login-toggle="true" aria-controls="login-box-id" aria-expanded="false">
        <svg focusable="false" aria-hidden="true" class="ecl-site-header-harmonised__icon ecl-icon ecl-icon--s">
            <use xlink:href="/ecl-images/icons/sprites/icons.svg#general--logged-in"></use>
        </svg>
        {{ Auth::user() ? Auth::user()->name : 'Log in' }}
        <svg focusable="false" aria-hidden="true" class="ecl-site-header-harmonised__login-arrow ecl-icon ecl-icon--xs">
            <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--corner-arrow"></use>
        </svg>
    </a>
    <div id="login-box-id" class="ecl-site-header-harmonised__login-box" data-ecl-login-box="true">
        <p class="ecl-site-header-harmonised__login-description">Logged in as {{ Auth::user() ? Auth::user()->name : '' }}</p>
        <hr class="ecl-site-header-harmonised__login-separator" />
        <a href="{{ route('cas-logout') }}" class="ecl-link ecl-link--standalone">Log out</a>
    </div>
</div>