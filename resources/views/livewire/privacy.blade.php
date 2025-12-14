<?php

use Livewire\Volt\Component;

new class extends Component {
	//
}; ?>

<x-slot:title>Privacy Policy - ElliotDerhay.com</x-slot:title>
<x-slot:meta-description>
	This privacy policy applies to this Website and its collection of information. This policy does not cover how
	third-party websites linked to from this Website use personally-identifiable information.
</x-slot:meta-description>
<root>
	<x-row :flex="false">
		<x-column class="block w-full">
			<h1 class="content-title text-4xl">Privacy Policy</h1>

			<p class="font-bold mb-4">Last updated August 18, 2020</p>

			<h2 class="content-title text-3xl pt-6">What this policy covers</h2>
			<p class="mb-4">This privacy policy applies to this Website (<a href="/">https://elliotderhay.com</a>) and its
				collection of information. This policy does not cover how third-party websites linked to from this Website use
				personally-identifiable information. If this Website contains links to any third-party websites, please see the
				privacy policies provided by those websites to learn how they store and/or process personally-identifiable
				information.</p>

			<h2 class="content-title text-3xl pt-6">Third Party Tools &amp; Services</h2>
			<p class="mb-4">This Website does not directly process any personal information, but it does use the below listed
				tools and/or services. They're used only for learning and website improvement purposes.</p>

			<ul class="mb-4 list-inside list-disc">
				<li><a href="https://marketingplatform.google.com/about/analytics/" target="_blank">Google Analytics</a> (<a
						href="https://marketingplatform.google.com/about/analytics/terms/us/" target="_blank">Privacy Policy</a>)
				</li>
			</ul>

			<h2 class="content-title text-3xl pt-6">Cookies</h2>
			<p class="mb-4">Currently, the only way this Website uses cookies directly is to allow or disallow Website visitor
				tracking via the third party services listed above. These services may set their own cookies to propertly
				function. Please see their respective privacy policies to determine whether you're comfortable with how they use
				cookies.</p>
		</x-column>
	</x-row>
</root>
