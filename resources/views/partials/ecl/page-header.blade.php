<div>
    <div class="ecl-page-header-harmonised">
      <div class="ecl-container">
        <nav data-ecl-auto-init="BreadcrumbHarmonised" class="ecl-page-header-harmonised__breadcrumb ecl-breadcrumb-harmonised" aria-label="You are here:" data-ecl-breadcrumb-harmonised="true">
          <ol class="ecl-breadcrumb-harmonised__container">
            <li class="ecl-breadcrumb-harmonised__segment" data-ecl-breadcrumb-harmonised-item="static" aria-hidden="false"><a href="/homepage" class="ecl-breadcrumb-harmonised__link ecl-link ecl-link--standalone">Home</a><svg focusable="false" aria-hidden="true" role="presentation" class="ecl-breadcrumb-harmonised__icon ecl-icon ecl-icon--2xs ecl-icon--rotate-90">
                <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--corner-arrow"></use>
              </svg></li>
            @foreach ($crumbs as $crumb)
              @if (isset($crumb['url']) && isset($crumb['title']))
              <li class="ecl-breadcrumb-harmonised__segment" data-ecl-breadcrumb-harmonised-item="static" aria-hidden="false"><a href="{{ $crumb['url'] }}" class="ecl-breadcrumb-harmonised__link ecl-link ecl-link--standalone">{{ $crumb['title'] }}</a><svg focusable="false" aria-hidden="true" role="presentation" class="ecl-breadcrumb-harmonised__icon ecl-icon ecl-icon--2xs ecl-icon--rotate-90">
                <use xlink:href="/ecl-images/icons/sprites/icons.svg#ui--corner-arrow"></use>
              </svg></li>
              @elseif (isset($crumb['title']))
              <li class="ecl-breadcrumb-harmonised__segment ecl-breadcrumb-harmonised__current-page" aria-current="page" data-ecl-breadcrumb-harmonised-item="static" aria-hidden="false">{{ $crumb['title'] }}</li>
              @endif
            @endforeach
          </ol>
        </nav>
        <h1 class="ecl-page-header-harmonised__title">{{ $title ?? '' }}</h1>
      </div>
    </div>
  </div>
