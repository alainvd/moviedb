<div>
  <header data-ecl-auto-init="SiteHeaderHarmonised" class="ecl-site-header-harmonised--group1 ecl-site-header-harmonised" data-ecl-has-menu="true">
    <div class="ecl-site-header-harmonised__container ecl-container print:hidden">
      <div class="ecl-site-header-harmonised__top"><a class="ecl-link ecl-link--standalone ecl-site-header-harmonised__logo-link" href="/" aria-label="European Commission"><img alt="European Commission logo" title="European Commission" class="ecl-site-header-harmonised__logo-image" src="/ecl-images/logo/logo--en.svg" /></a>
        <div class="ecl-site-header-harmonised__action">
          <div class="ecl-site-header-harmonised__login-container"><a class="ecl-link ecl-link--standalone ecl-site-header-harmonised__login-toggle" href="/example" data-ecl-login-toggle="true" aria-controls="login-box-id" aria-expanded="false"><svg focusable="false" aria-hidden="true" class="ecl-site-header-harmonised__icon ecl-icon ecl-icon--s">
                <use xlink:href="/ecl-images/icons/sprites/icons.svg#general--logged-in"></use>
              </svg>{{ Auth::user() ? Auth::user()->name : 'Log in' }}<svg focusable="false" aria-hidden="true" class="ecl-site-header-harmonised__login-arrow ecl-icon ecl-icon--xs">
                <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--corner-arrow"></use>
              </svg></a>
            <div id="login-box-id" class="ecl-site-header-harmonised__login-box" data-ecl-login-box="true">
              <p class="ecl-site-header-harmonised__login-description">Logged in as {{ Auth::user() ? Auth::user()->name : '' }}</p>
              <hr class="ecl-site-header-harmonised__login-separator" /><a href="{{ route('cas-logout') }}" class="ecl-link ecl-link--standalone">Log out</a>
            </div>
          </div>
          <div class="ecl-site-header-harmonised__search-container"><a class="ecl-link ecl-link--standalone ecl-site-header-harmonised__search-toggle" href="/example" data-ecl-search-toggle="true" aria-controls="search-form-id" aria-expanded="false"><svg focusable="false" aria-hidden="true" class="ecl-icon ecl-icon--s">
                <use xlink:href="/ecl-images/icons/sprites/icons.svg#general--search"></use>
              </svg>Search</a>
            <form id="search-form-id" data-ecl-search-form="true" class="ecl-site-header-harmonised__search ecl-search-form" role="search">
              <div class="ecl-form-group"><label class="ecl-search-form__label ecl-form-label" for="search-input-id">Search</label><input type="search" id="search-input-id" class="ecl-search-form__text-input ecl-text-input" /></div><button aria-label="Search" type="submit" class="ecl-search-form__button ecl-button ecl-button--search"><span class="ecl-button__container"><span class="ecl-button__label" data-ecl-label="true">Search</span><svg focusable="false" aria-hidden="true" data-ecl-icon="true" class="ecl-button__icon ecl-button__icon--after ecl-icon ecl-icon--xs">
                    <use xlink:href="/ecl-images/icons/sprites/icons.svg#general--search"></use>
                  </svg></span></button>
            </form>
          </div>
        </div>
      </div>
    </div>
    <nav data-ecl-auto-init="Menu" class="ecl-menu--group1 ecl-menu" aria-expanded="false" data-ecl-menu="true">
      <div class="ecl-menu__overlay" data-ecl-menu-overlay="true"></div>
      <div class="ecl-container ecl-menu__container"><a class="ecl-link ecl-link--standalone ecl-menu__open" href="/example" data-ecl-menu-open="true"><svg focusable="false" aria-hidden="true" class="ecl-icon ecl-icon--s">
            <use xlink:href="/ecl-images/icons/sprites/icons.svg#general--hamburger"></use>
          </svg>Menu</a>
        <div class="ecl-menu__site-name">Creative Europe MEDIA database</div>
        <section class="ecl-menu__inner" data-ecl-menu-inner="true">
          <header class="ecl-menu__inner-header"><button data-ecl-menu-close="true" type="submit" class="ecl-menu__close ecl-button ecl-button--text"><span class="ecl-menu__close-container ecl-button__container"><svg focusable="false" aria-hidden="true" data-ecl-icon="true" class="ecl-button__icon ecl-button__icon--before ecl-icon ecl-icon--s">
                  <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--close-filled"></use>
                </svg><span class="ecl-button__label" data-ecl-label="true">Close</span></span></button>
            <div class="ecl-menu__title">Menu</div><button data-ecl-menu-back="true" type="submit" class="ecl-menu__back ecl-button ecl-button--text"><span class="ecl-button__container"><svg focusable="false" aria-hidden="true" data-ecl-icon="true" class="ecl-button__icon ecl-button__icon--before ecl-icon ecl-icon--s ecl-icon--rotate-270">
                  <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--corner-arrow"></use>
                </svg><span class="ecl-button__label" data-ecl-label="true">Back</span></span></button>
          </header>
          <ul class="ecl-menu__list">
            <li class="ecl-menu__item" data-ecl-menu-item="true"><a href="{{ route('dossiers.index') }}" class="ecl-menu__link" data-ecl-menu-link="true">My Dossiers</a></li>
            <!--<li class="ecl-menu__item" data-ecl-menu-item="true"><a href="/dossiers/1/activities/2/fiches/dist" class="ecl-menu__link" data-ecl-menu-link="true">Create Movie</a></li>-->
          </ul>
        </section>
      </div>
    </nav>
    <div id="language-list-overlay" hidden="" class="ecl-language-list ecl-language-list--overlay print:hidden" aria-labelledby="ecl-language-list__title" role="dialog" data-ecl-language-list-overlay="true">
      <div class="ecl-language-list__container ecl-container">
        <div class="ecl-row">
          <div class="ecl-language-list__close ecl-col-12 ecl-col-lg-8 ecl-offset-lg-2"><button data-ecl-language-list-close="true" type="submit" class="ecl-language-list__close-button ecl-button ecl-button--ghost"><span class="ecl-button__container"><span class="ecl-button__label" data-ecl-label="true">Close</span><svg focusable="false" aria-hidden="true" data-ecl-icon="true" class="ecl-button__icon ecl-button__icon--after ecl-icon ecl-icon--s">
                  <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--close"></use>
                </svg></span></button></div>
          <div class="ecl-language-list__title ecl-col-12 ecl-col-lg-8 ecl-offset-lg-2" id="ecl-language-list__title">Select your language</div>
        </div>
        <div class="ecl-row ecl-language-list__eu">
          <div class="ecl-language-list__category ecl-col-12 ecl-col-lg-8 ecl-offset-lg-2">EU official languages</div>
          <div class="ecl-language-list__column ecl-col-12 ecl-col-lg-4 ecl-offset-lg-2">
            <ul class="ecl-language-list__list">
              <li class="ecl-language-list__item "><a lang="bg" hrefLang="bg" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">български</a></li>
              <li class="ecl-language-list__item "><a lang="es" hrefLang="es" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">español</a></li>
              <li class="ecl-language-list__item "><a lang="cs" hrefLang="cs" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">čeština</a></li>
              <li class="ecl-language-list__item "><a lang="da" hrefLang="da" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">dansk</a></li>
              <li class="ecl-language-list__item "><a lang="de" hrefLang="de" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">Deutsch</a></li>
              <li class="ecl-language-list__item "><a lang="et" hrefLang="et" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">eesti</a></li>
              <li class="ecl-language-list__item "><a lang="el" hrefLang="el" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">ελληνικά</a></li>
              <li class="ecl-language-list__item ecl-language-list__item--is-active"><a lang="en" hrefLang="en" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone ecl-link--icon ecl-link--icon-after"><span class="ecl-link__label">English</span>&nbsp;<svg focusable="false" aria-hidden="true" class="ecl-link__icon ecl-icon ecl-icon--xs">
                    <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--check"></use>
                  </svg></a></li>
              <li class="ecl-language-list__item "><a lang="fr" hrefLang="fr" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">français</a></li>
              <li class="ecl-language-list__item "><a lang="ga" hrefLang="ga" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">Gaeilge</a></li>
              <li class="ecl-language-list__item "><a lang="hr" hrefLang="hr" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">hrvatski</a></li>
              <li class="ecl-language-list__item "><a lang="it" hrefLang="it" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">italiano</a></li>
            </ul>
          </div>
          <div class="ecl-language-list__column ecl-col-12 ecl-col-lg-4">
            <ul class="ecl-language-list__list">
              <li class="ecl-language-list__item "><a lang="lv" hrefLang="lv" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">latviešu</a></li>
              <li class="ecl-language-list__item "><a lang="lt" hrefLang="lt" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">lietuvių</a></li>
              <li class="ecl-language-list__item "><a lang="hu" hrefLang="hu" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">magyar</a></li>
              <li class="ecl-language-list__item "><a lang="mt" hrefLang="mt" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">Malti</a></li>
              <li class="ecl-language-list__item "><a lang="nl" hrefLang="nl" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">Nederlands</a></li>
              <li class="ecl-language-list__item "><a lang="pl" hrefLang="pl" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">polski</a></li>
              <li class="ecl-language-list__item "><a lang="pt" hrefLang="pt" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">português</a></li>
              <li class="ecl-language-list__item "><a lang="ro" hrefLang="ro" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">română</a></li>
              <li class="ecl-language-list__item "><a lang="sk" hrefLang="sk" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">slovenčina</a></li>
              <li class="ecl-language-list__item "><a lang="sl" hrefLang="sl" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">slovenščina</a></li>
              <li class="ecl-language-list__item "><a lang="fi" hrefLang="fi" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">suomi</a></li>
              <li class="ecl-language-list__item "><a lang="sv" hrefLang="sv" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">svenska</a></li>
            </ul>
          </div>
        </div>
        <div class="ecl-row ecl-language-list__non-eu">
          <div class="ecl-language-list__category ecl-col-12 ecl-col-lg-8 ecl-offset-lg-2">Non-EU languages</div>
          <div class="ecl-language-list__column ecl-col-12 ecl-col-lg-4 ecl-offset-lg-2">
            <ul class="ecl-language-list__list">
              <li class="ecl-language-list__item "><a lang="zh" hrefLang="zh" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">中文</a></li>
              <li class="ecl-language-list__item "><a lang="tr" hrefLang="tr" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">Türk</a></li>
              <li class="ecl-language-list__item "><a lang="ru" hrefLang="ru" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">pусский</a></li>
            </ul>
          </div>
          <div class="ecl-language-list__column ecl-col-12 ecl-col-lg-4">
            <ul class="ecl-language-list__list">
              <li class="ecl-language-list__item "><a lang="ca" hrefLang="ca" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">Català</a></li>
              <li class="ecl-language-list__item "><a lang="ar" hrefLang="ar" rel="alternate" href="/example" class="ecl-language-list__link ecl-link ecl-link--standalone">عَرَبِيّ</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </header>
</div>