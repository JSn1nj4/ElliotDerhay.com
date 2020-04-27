@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('head-extras')
  @yield('head-extras')
@endsection

@section('body')

  @php
    $menuItems = [];
    $optionalMenuItems = [
      'projects',
      'updates',
    ];

    foreach($optionalMenuItems as $item) {
      if(config("app.enable-" . $item)) $menuItems[] = $item;
    }

    if(count($menuItems) >= 1) array_unshift($menuItems, 'home');
  @endphp

  @include('layouts.header', $menuItems)

  <main class="bg-gray-800 layer-shadow pt-4 pb-6">
    @yield('content')
  </main>

  @include('layouts.footer')

  {{-- Footer JS files --}}
  <script src="{{ mix('/js/manifest.js') }}"></script>
  <script src="{{ mix('/js/vendor.js') }}"></script>
  <script src="{{ mix('/js/app.js') }}"></script>

@endsection

@section('footer-extras')
  @yield('footer-extras')
@endsection
