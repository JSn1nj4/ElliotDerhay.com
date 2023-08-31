@php $ga_id = 'G-N77DW1F89N'; @endphp
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $ga_id }}"></script>
<script type="application/javascript">
	// Enable or disable GA tracking
	function ga_track({detail}) {
		let dnt = !detail.allow ? 'DNT=1' : 'DNT=0';

		if (!!detail.time) dnt += ';expires=' + detail.time.toUTCString();

		// only good for when the user interacts with this mess
		document.cookie = dnt
		window['ga-disable-{{ $ga_id }}'] = !detail.allow;
	}

	if (
		// make sure the DNT cookie hasn't already been set
		document.cookie.indexOf('DNT=') === -1
		// make sure the navigator DNT setting hasn't already been set
		&& navigator.doNotTrack !== '1'
	) {
		ga_track({ detail: { allow: false }})
	}

	// tracking configuration
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', '{{ $ga_id }}');
</script>
