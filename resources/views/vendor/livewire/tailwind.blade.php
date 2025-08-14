@php
	if (! isset($scrollTo)) {
			$scrollTo = 'body';
	}

	$scrollIntoViewJsSnippet = ($scrollTo !== false)
			? <<<JS
				 (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView({ behavior: 'smooth' })
			JS
			: '';

$selectableColors = implode(' ', [
	'bg-white',
	'dark:bg-black',

	'text-caribbean-green-700',
	'dark:text-caribbean-green-300',

	'border-caribbean-green-700',
	'dark:border-caribbean-green-300',

	'hover:text-caribbean-green-500',
	'dark:hover:text-caribbean-green-400',

	'ring-caribbean-green-300',
	'dark:ring-caribbean-green-700',

	'focus:border-caribbean-green-300',
	'dark:focus:border-caribbean-green-700',

	'active:text-caribbean-green-700',
	'dark:active:text-caribbean-green-300',
]);

$selectedColors = implode(' ', [
	'bg-caribbean-green-500',
	'dark:bg-caribbean-green-400',

	'text-white',
	'dark:text-black',

	'border-caribbean-green-500',
	'dark:border-caribbean-green-400',
]);

$disabledColors = implode(' ', [
	'bg-white',
	'dark:bg-black',

	'text-caribbean-green-300',
	'dark:text-caribbean-green-700',

	'border-caribbean-green-300',
	'dark:border-caribbean-green-700',
]);
@endphp

<div>
	@if ($paginator->hasPages())
		<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
			<div class="flex justify-between flex-1 sm:hidden">
				<span>
					@if ($paginator->onFirstPage())
						<span
							class="relative inline-flex items-center px-4 py-2 text-sm font-medium border cursor-default leading-5 rounded-md {{ $disabledColors }}">
                    {!! __('pagination.previous') !!}
						</span>
					@else
						<button type="button" wire:click.debounce="previousPage('{{ $paginator->getPageName() }}')"
										x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
										dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
										class="relative inline-flex items-center px-4 py-2 text-sm font-medium border leading-5 rounded-md focus:outline-hidden focus:ring-3 transition ease-in-out duration-150 {{ $selectableColors }}">
                            {!! __('pagination.previous') !!}
                        </button>
					@endif
				</span>

				<span>
					@if ($paginator->hasMorePages())
						<button type="button" wire:click.debounce="nextPage('{{ $paginator->getPageName() }}')"
										x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
										dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
										class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium border leading-5 rounded-md focus:outline-hidden focus:ring-3 transition ease-in-out duration-150 {{ $selectableColors }}">
							{!! __('pagination.next') !!}
						</button>
					@else
						<span
							class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium border cursor-default leading-5 rounded-md {{ $disabledColors }}">
								{!! __('pagination.next') !!}
						</span>
					@endif
				</span>
			</div>

			<div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
				<div>
					<p class="text-sm text-slate-700 dark:text-gray-500 leading-5">
						<span>{!! __('Showing') !!}</span>
						<span class="font-medium">{{ $paginator->firstItem() }}</span>
						<span>{!! __('to') !!}</span>
						<span class="font-medium">{{ $paginator->lastItem() }}</span>
						<span>{!! __('of') !!}</span>
						<span class="font-medium">{{ $paginator->total() }}</span>
						<span>{!! __('results') !!}</span>
					</p>
				</div>

				<div>
					<span class="relative z-0 inline-flex shadow-xs rounded-md">
						<span>
							{{-- Previous Page Link --}}
							@if ($paginator->onFirstPage())
								<span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
									<span
										class="relative inline-flex items-center px-2 py-2 text-sm font-medium  border cursor-default rounded-l-md leading-5 {{ $disabledColors }}"
										aria-hidden="true">
											<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
													<path fill-rule="evenodd"
																d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
																clip-rule="evenodd" />
											</svg>
									</span>
								</span>
							@else
								<button type="button" wire:click.debounce="previousPage('{{ $paginator->getPageName() }}')"
												x-on:click="{{ $scrollIntoViewJsSnippet }}"
												dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
												class="relative inline-flex items-center px-2 py-2 text-sm font-medium border rounded-l-md leading-5 focus:z-10 focus:outline-hidden focus:ring-3 transition ease-in-out duration-150 {{ $selectableColors }}"
												aria-label="{{ __('pagination.previous') }}">
									<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
											<path fill-rule="evenodd"
														d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
														clip-rule="evenodd" />
									</svg>
								</button>
							@endif
						</span>

						{{-- Pagination Elements --}}
						@foreach ($elements as $element)
							{{-- "Three Dots" Separator --}}
							@if (is_string($element))
								<span aria-disabled="true">
									<span
										class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium border cursor-default leading-5 {{ $disabledColors }}">{{ $element }}</span>
								</span>
							@endif

							{{-- Array Of Links --}}
							@if (is_array($element))
								@foreach ($element as $page => $url)
									<span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
										@if ($page == $paginator->currentPage())
											<span aria-current="page">
												<span
													class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium border cursor-default leading-5 {{ $selectedColors }}">{{ $page }}</span>
											</span>
										@else
											<button type="button"
															wire:click.debounce="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
															x-on:click="{{ $scrollIntoViewJsSnippet }}"
															class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium border leading-5 focus:z-10 focus:outline-hidden focus:ring-3 transition ease-in-out duration-150 {{ $selectableColors }}"
															aria-label="{{ __('Go to page :page', compact('page')) }}">
													{{ $page }}
											</button>
										@endif
									</span>
								@endforeach
							@endif
						@endforeach

						<span>
							{{-- Next Page Link --}}
							@if ($paginator->hasMorePages())
								<button type="button" wire:click.debounce="nextPage('{{ $paginator->getPageName() }}')"
												x-on:click="{{ $scrollIntoViewJsSnippet }}"
												dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
												class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium border rounded-r-md leading-5 focus:z-10 focus:outline-hidden focus:ring-3 transition ease-in-out duration-150 {{ $selectableColors }}"
												aria-label="{{ __('pagination.next') }}">
									<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
											<path fill-rule="evenodd"
														d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
														clip-rule="evenodd" />
									</svg>
								</button>
							@else
								<span aria-disabled="true" aria-label="{{ __('pagination.next') }}">
									<span
										class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium border cursor-default rounded-r-md leading-5 {{ $disabledColors }}"
										aria-hidden="true">
											<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
													<path fill-rule="evenodd"
																d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
																clip-rule="evenodd" />
											</svg>
									</span>
								</span>
							@endif
						</span>
					</span>
				</div>
			</div>
		</nav>
	@endif
</div>
