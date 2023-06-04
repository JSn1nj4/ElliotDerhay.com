<div class="flex flex-col w-full gap-2 rounded-lg border dark:border-gray-600 dark:bg-gray-600/20 p-4">
		<p class="text-2xl">Categories</p>
		@php /** @var \Illuminate\Support\Collection<\App\Models\Category> $new_categories */ @endphp

		<div class="border border-black dark:border-gray-600 rounded-lg bg-gray-800 px-4 py-2 flex flex-col">
			@if($new_categories->isNotEmpty())
				@foreach($new_categories as $new_category)
					<livewire:ui.form.checkbox
						:wire:key="'category-'.$new_category->id"
						:field-id="'category-'.$new_category->id"
						name="post_categories[]"
						:value="$new_category->id"
						:label="$new_category->title"
						checked
					/>
				@endforeach
				<hr class="border dark:border-gray-600">
			@endif

			@php /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Category> $categories */ @endphp
			@foreach($categories as $category)
				<livewire:ui.form.checkbox
					:wire:key="'category-'.$category->id"
					:field-id="'category-'.$category->id"
					name="post_categories[]"
					:value="$category->id"
					:label="$category->title"
					:checked="$this->categorizeable?->categories->contains(fn ($cat) => $cat->id === $category->id) ?? false"
				/>
			@endforeach
		</div>
</div>
