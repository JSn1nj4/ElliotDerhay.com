<x-mail::message>
# Weekly Report

Everything going on at [{{ config('app.name') }}]({{ route('home') }})

<x-mail::panel>
## Last Login
{{ $lastLogin }}

## Last Login Failure
{{ $lastFailure }}

## Post Published
{{ $postsPublished }}
</x-mail::panel>

<x-mail::button :url="route('home')" color='success'>
	Visit Site
</x-mail::button>

<x-mail::button :url="route('filament.admin.pages.dashboard')">
	Log In
</x-mail::button>
</x-mail::message>
