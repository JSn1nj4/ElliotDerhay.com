<div class="flex flex-col w-full gap-2 rounded-lg border dark:border-gray-600 dark:bg-gray-600/20 p-4">
	<x-admin.forms.field label="Tags" field="tags" :errors="$errors" :value="$tags" />
	<p class="text-lg">Tags must be separated by commas. New tags will be automatically created.</p>
</div>
