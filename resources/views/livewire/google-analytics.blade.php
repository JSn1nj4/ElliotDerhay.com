<?php

use \Livewire\Volt\Component;
use function Livewire\Volt\{state};

new class extends Component {
	public readonly string $googleAnalyticsId;

	public function mount()
	{
		$this->googleAnalyticsId = 'G-N77DW1F89N';
	}
}

?>
<div>
	@production
		<script async src="https://www.googletagmanager.com/gtag/js?id={{ $googleAnalyticsId }}"></script>
		<script type="application/javascript">
			// Enable or disable GA tracking
			function googleAnalyticsTrack({allow, time}) {
				let dnt = !allow ? 'DNT=1' : 'DNT=0'

				if (!!time) dnt += ';expires=' + time.toUTCString()

				// only good for when the user interacts with this mess
				document.cookie = dnt
				window['ga-disable-{{ $googleAnalyticsId }}'] = !allow
			}

			document.addEventListener('allow_tracking', googleAnalyticsTrack)

			if (
				// make sure the DNT cookie hasn't already been set
				document.cookie.indexOf('DNT=') === -1
				// make sure the navigator DNT setting hasn't already been set
				&& navigator.doNotTrack !== '1'
			) {
				googleAnalyticsTrack({allow: false})
			}

			// tracking configuration
			window.dataLayer = window.dataLayer || []

			function gtag() {
				dataLayer.push(arguments)
			}

			gtag('js', new Date())

			gtag('config', '{{ $googleAnalyticsId }}')
		</script>
		@else
			<!-- Google Analytics component mounted -->
			@endproduction
</div>
