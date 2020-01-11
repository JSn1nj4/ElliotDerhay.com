@php
  $headerClasses          = 'flex items-center justify-between flex-wrap';
  $logoWrapperClasses     = 'flex items-center flex-shrink-0';
  $logoClasses            = '';
  $logoTextClasses        = 'text-xl';
  $fullHeader             = true;

  if(count($menuItems) < 1) {
    $headerClasses      = 'text-center';
    $logoWrapperClasses = '';
    $logoClasses        = 'inline-block';
    $logoTextClasses    = '';
    $fullHeader         = false;
  }
@endphp

<header id="header" class="container-flexible-large m-auto">
  <nav class="{{ $headerClasses }} bg-gray-900 relative">

    <div class="{{ $logoWrapperClasses }} text-white">
      <a href="/" class="{{ $logoClasses }} text-white p-2">
        <img src="https://www.gravatar.com/avatar/8754c5b823c1f0b00e989447a0345a33" width="60" height="60" alt="ElliotDerhay.com logo" title="Elliot Derhay" class="inline border-solid border-2 border-white rounded-full align-middle">
        <span class="{{ $logoTextClasses }} sm:text-3xl tracking-tighter py-px2 pl-2 align-middle">
          Elliot Derhay
        </span>
      </a>
    </div>

    @if ($fullHeader)

      <div class="block md:hidden mr-5">
        <label for="menu-toggle" class="flex items-center text-sea-green-500 hover:text-white">
          <svg class="fill-current h-8 w-8" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
        </label>
      </div>

      <input type="checkbox" id="menu-toggle" name="menu-toggle" class="hidden absolute top-0 left-0 -z-50">

      <div class="w-full block absolute md:relative flex-grow md:flex md:items-center md:w-auto text-center md:text-right text-xl mobile-menu">
        <div class="text-md md:flex-grow">

          @foreach ($menuItems as $key => $value)
            @php
              $extraClasses = '';
              $titleText = '';
              $itemText = $value;

              if($value === 'home') {
                $extraClasses = 'fas fa-home ';
                $titleText = 'title=Home';
                $itemText = '';
              }
            @endphp

            <a href="{{ route($value, [], false) }}"
              class="{{ $extraClasses }}block md:inline-block px-4 py-6 uppercase{{ Route::currentRouteName() === $value ? ' active' : '' }}"
              {{ $titleText }}>
              {{ $itemText }}
            </a>
          @endforeach

        </div>
      </div>
    @endif

  </nav>
</header>
