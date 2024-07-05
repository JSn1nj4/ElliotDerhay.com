@php
	if (! isset($scrollTo)) {
			$scrollTo = 'body';
	}

	$scrollIntoViewJsSnippet = ($scrollTo !== false)
			? <<<JS
				 (\$el.closest('{$scrollTo}') || document.querySelector('{$scrollTo}')).scrollIntoView()
			JS
			: '';
@endphp

<div>
	@if ($paginator->hasPages())
		<nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="flex items-center justify-between">
			<div class="flex justify-between flex-1 sm:hidden">
				<span>
					@if ($paginator->onFirstPage())
						<span
							class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-caribbeanGreen-500 dark:text-caribbeanGreen-400 border border-caribbeanGreen-300 dark:border-caribbeanGreen-700 cursor-default leading-5 rounded-md">
                    {!! __('pagination.previous') !!}
						</span>
					@else
						<button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
										x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
										dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
										class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-caribbeanGreen-700 dark:text-caribbeanGreen-300 border border-caribbeanGreen-700 dark:border-caribbeanGreen-300 leading-5 rounded-md hover:text-caribbeanGreen-500 dark:hover:text-caribbeanGreen-400 focus:outline-none focus:ring ring-caribbeanGreen-300 dark:ring-caribbeanGreen-700 focus:border-caribbeanGreen-300 dark:focus:border-caribbeanGreen-700 active:text-caribbeanGreen-700 dark:active:text-caribbeanGreen-300 transition ease-in-out duration-150">
                            {!! __('pagination.previous') !!}
                        </button>
					@endif
				</span>

				<span>
					@if ($paginator->hasMorePages())
						<button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
										x-on:click="{{ $scrollIntoViewJsSnippet }}" wire:loading.attr="disabled"
										dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.before"
										class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-caribbeanGreen-700 dark:text-caribbeanGreen-300 border border-caribbeanGreen-700 dark:border-caribbeanGreen-300 leading-5 rounded-md hover:text-caribbeanGreen-500 dark:hover:text-caribbeanGreen-400 focus:outline-none focus:ring ring-caribbeanGreen-300 dark:ring-caribbeanGreen-700 focus:border-caribbeanGreen-300 dark:focus:border-caribbeanGreen-700 active:text-caribbeanGreen-700 dark:active:text-caribbeanGreen-300 transition ease-in-out duration-150">
							{!! __('pagination.next') !!}
						</button>
					@else
						<span
							class="relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-caribbeanGreen-500 dark:text-caribbeanGreen-400 border border-caribbeanGreen-300 dark:border-caribbeanGreen-700 cursor-default leading-5 rounded-md">
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
					<span class="relative z-0 inline-flex shadow-sm rounded-md">
						<span>
							{{-- Previous Page Link --}}
							@if ($paginator->onFirstPage())
								<span aria-disabled="true" aria-label="{{ __('pagination.previous') }}">
									<span
										class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-caribbeanGreen-300 dark:text-caribbeanGreen-700 bg-white dark:bg-black border border-caribbeanGreen-300 dark:border-caribbeanGreen-700 cursor-default rounded-l-md leading-5"
										aria-hidden="true">
											<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
													<path fill-rule="evenodd"
																d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
																clip-rule="evenodd" />
											</svg>
									</span>
								</span>
							@else
								<button type="button" wire:click="previousPage('{{ $paginator->getPageName() }}')"
												x-on:click="{{ $scrollIntoViewJsSnippet }}"
												dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
												class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-caribbeanGreen-500 dark:text-caribbeanGreen-400 bg-white dark:bg-black border border-caribbeanGreen-500 dark:border-caribbeanGreen-400 hover:border-caribbeanGreen-400 dark:hover:border-caribbeanGreen-600 rounded-l-md leading-5 hover:text-caribbeanGreen-400 dark:hover:text-caribbeanGreen-600 focus:z-10 focus:outline-none focus:ring ring-caribbeanGreen-700 dark:ring-caribbeanGreen-300 focus:border-caribbeanGreen-300 dark:focus:border-caribbeanGreen-700 active:text-caribbeanGreen-500 dark:active:text-caribbeanGreen-400 transition ease-in-out duration-150"
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
										class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-caribbeanGreen-700 bg-white dark:bg-black border border-caribbeanGreen-300 cursor-default leading-5">{{ $element }}</span>
								</span>
							@endif

							{{-- Array Of Links --}}
							@if (is_array($element))
								@foreach ($element as $page => $url)
									<span wire:key="paginator-{{ $paginator->getPageName() }}-page{{ $page }}">
										@if ($page == $paginator->currentPage())
											<span aria-current="page">
											<span
												class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-caribbeanGreen-500 dark:text-caribbeanGreen-400 bg-white dark:bg-black border border-caribbeanGreen-700 dark:border-caribbeanGreen-300 cursor-default leading-5">{{ $page }}</span>
                                            </span>
										@else
											<button type="button"
															wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')"
															x-on:click="{{ $scrollIntoViewJsSnippet }}"
															class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-caribbeanGreen-500 dark:text-caribbeanGreen-400 bg-white dark:bg-black border border-caribbeanGreen-500 dark:border-caribbeanGreen-400 hover:border-caribbeanGreen-400 dark:hover:border-caribbeanGreen-600 leading-5 hover:text-caribbeanGreen-400 dark:hover:text-caribbeanGreen-600 focus:z-10 focus:outline-none focus:ring ring-caribbeanGreen-700 dark:ring-caribbeanGreen-300 focus:border-caribbeanGreen-300 dark:focus:border-caribbeanGreen-700 active:text-caribbeanGreen-500 dark:active:text-caribbeanGreen-400 transition ease-in-out duration-150"
															aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
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
								<button type="button" wire:click="nextPage('{{ $paginator->getPageName() }}')"
												x-on:click="{{ $scrollIntoViewJsSnippet }}"
												dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}.after"
												class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-caribbeanGreen-500 dark:text-caribbeanGreen-400 bg-white dark:bg-black border border-caribbeanGreen-700 dark:border-caribbeanGreen-300 hover:border-caribbeanGreen-400 dark:hover:border-caribbeanGreen-600 rounded-r-md leading-5 hover:text-caribbeanGreen-400 dark:hover:text-caribbeanGreen-600 focus:z-10 focus:outline-none focus:ring ring-caribbeanGreen-300 dark:ring-caribbeanGreen-700 focus:border-caribbeanGreen-300 dark:focus:border-caribbeanGreen-700 active:text-caribbeanGreen-500 dark:active:text-caribbeanGreen-400 transition ease-in-out duration-150"
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
										class="relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-caribbeanGreen-300 dark:text-caribbeanGreen-700 bg-white dark:bg-black border border-caribbeanGreen-300 dark:border-caribbeanGreen-700 cursor-default rounded-r-md leading-5"
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
