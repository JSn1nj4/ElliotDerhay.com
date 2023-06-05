<div class="flex flex-col w-full gap-2 rounded-lg border dark:border-gray-600 dark:bg-gray-600/20 p-4">
		<p class="text-2xl">Categories</p>

		<div class="border border-black dark:border-gray-600 rounded-lg bg-gray-800 px-4 py-2 flex flex-col">
			@php /** @var \Illuminate\Database\Eloquent\Collection<\App\Models\Category> $categories */ @endphp
			@foreach($categories as $category)
				<livewire:ui.form.checkbox
					:wire:key="'category-'.$category->id"
					:field-id="'category-'.$category->id"
					name="post_categories[]"
					:value="$category->id"
					:label="$category->title"
					:checked="$this->modelHas($category)"
				/>
			@endforeach
		</div>

		<p class="text-lg">Choose from existing categories or create a new one.</p>
		{{--	"add new" form section here	--}}
</div>
