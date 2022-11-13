@extends('admin.layouts.post-edit', [
    'action' => action([\App\Http\Controllers\PostsController::class, 'store']),
    'errors' => $errors,
    'fields' => new class(
        title: old('title'),
        slug: old('slug'),
        body: old('body'),
    ) {
        public function __construct(
					public ?string $title,
					public ?string $slug,
					public ?string $body,
        ) {}
		},
		'editing' => false,
])
