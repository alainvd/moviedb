<div>
  <header data-ecl-auto-init="SiteHeaderHarmonised" class="ecl-site-header-harmonised--group1 ecl-site-header-harmonised" data-ecl-has-menu="true">
    <div class="ecl-site-header-harmonised__container ecl-container print:hidden">
      <div class="ecl-site-header-harmonised__top"><a class="ecl-link ecl-link--standalone ecl-site-header-harmonised__logo-link" href="/" aria-label="European Commission"><img alt="European Commission logo" title="European Commission" class="ecl-site-header-harmonised__logo-image" src="/ecl-images/logo/logo--en.svg" /></a>
        <div class="ecl-site-header-harmonised__action">

          @livewire('login')
          
        </div>
      </div>
    </div>
    <nav data-ecl-auto-init="Menu" class="ecl-menu--group1 ecl-menu" aria-expanded="false" data-ecl-menu="true">
      <div class="ecl-menu__overlay" data-ecl-menu-overlay="true"></div>
      <div class="ecl-container ecl-menu__container"><a class="ecl-link ecl-link--standalone ecl-menu__open" href="#" data-ecl-menu-open="true"><svg focusable="false" aria-hidden="true" class="ecl-icon ecl-icon--s">
            <use xlink:href="/ecl-images/icons/sprites/icons.svg#general--hamburger"></use>
          </svg>Menu</a>
        <div class="ecl-menu__site-name">Creative Europe MEDIA Database</div>
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
          </ul>
        </section>
      </div>
    </nav>
  </header>
</div>