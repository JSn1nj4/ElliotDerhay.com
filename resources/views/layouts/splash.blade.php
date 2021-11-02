@extends('layouts.master', ['bodyClasses' => $bodyClasses ?? ''])

@section('body')
	@yield('content')
@endsection
