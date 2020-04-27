@extends('layouts.page', ['bodyClasses' => 'status-page'])

@section('content')
  <div class="container mx-auto px-4 py-6">
    <div class="flex pb-4">
      <div class="status-code w-1/3 md:pr-4 leading-none">
        {{ $errorCode }}
      </div>

      <div class="status-description w-2/3">
        <h1 class="status-title">
          {{ $errorTitle }}
        </h1>

        <div class="status-body">
          @yield('status-body')
        </div>

        <div class="status-footer">
          @yield('status-footer')
        </div>
      </div>
    </div>
  </div>
@endsection
