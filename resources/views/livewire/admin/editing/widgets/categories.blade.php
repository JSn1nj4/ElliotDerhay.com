<div class="relative block overflow-clip">
	<div class="flex flex-col w-full gap-2 rounded-lg border dark:border-gray-600 dark:bg-gray-600/20 p-4">
		<p class="text-2xl">Categories</p>
		<p class="text-lg">Choose from existing categories or create a new one.</p>

		<div class="border border-black dark:border-gray-600 rounded-lg bg-gray-800 flex flex-col">
			<div>
				<livewire:ui.form.inline-single field="New Category" button="Save" submit-event="category.create" reset-event="categories.updated" />
			</div>
			<hr class="border-dashed border-black dark:border-gray-600">
			<div class="flex flex-col px-4 py-2 max-h-64 overflow-y-auto">
				@php /** @property \Illuminate\Database\Eloquent\Collection<\App\Models\Category> $this->categories */ @endphp
				@foreach($this->categories as $index => $category)
					{{-- This might need a checkbox list, not individual checkboxes --}}
					<livewire:ui.form.checkbox
						:wire:key="'category-' . $category->id"
						:field-id="'category-'. $category->id"
						name="post_categories[]"
						:value="$category->id"
						:label="$category->title"
						:checked="$category->checked"
					/>
				@endforeach
			</div>
		</div>
	</div>
	<div wire:loading class="absolute p-4 bg-black/25 h-full w-full z-50 content-center place-content-center">
		Loading...
	</div>
</div>
