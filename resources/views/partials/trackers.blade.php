<script type="application/javascript">
	const GA_ID = 'UA-165049241-1';

	// Enable or disable GA tracking
	function ga_track({detail}) {
		let dnt = !detail.allow ? 'DNT=1' : 'DNT=0';

		console.log(detail);

		if (!!detail.time) dnt += ';expires=' + detail.time.toUTCString();

		// only good for when the user interacts with this mess
		document.cookie = dnt
		window[`ga-disable-${GA_ID}`] = !detail.allow;
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
	gtag('config', GA_ID);
</script>
