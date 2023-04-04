<?php

use App\Models\Post;
use Illuminate\Http\Testing\File;
use function Pest\Faker\fake;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

it('redirects logged-out users away from the admin posts page', function () {
	get(route('posts.index'))
		->assertRedirect(route('login'));
});

it('loads the admin posts page for signed-in users', function () {
	actingAs(makeUser())
		->get(route('posts.index'))
		->assertStatus(200);
});

it('redirects logged-out users away from the post view page', function () {
	get(route('posts.show', [
		'post' => createPost(),
	]))
		->assertRedirect(route('login'));
});

it('loads the admin post view page for signed-in users', function () {
	actingAs(makeUser())
		->get(route('posts.show', [
			'post' => createPost(),
		]))
		->assertStatus(200);
});

it('redirects logged-out users away from the post create page', function () {
	get(route('posts.create'))
		->assertRedirect(route('login'));
});

it('loads the admin post create page for signed-in users', function () {
	actingAs(makeUser())
		->get(route('posts.create'))
		->assertStatus(200);
});

it('prevents logged-out users from creating a post', function () {
	// needed to prove nothing was stored, regardless of redirect being triggered
	$count = Post::count();
	$post = makePost();

	post(route('posts.store'), [
		'title' => $post->title,
		'slug' => $post->slug,
		'body' => $post->body,
	])->assertRedirect(route('login'));

	expect(Post::count())->toEqual($count);
});

it('returns an error if cover_image is not an image file', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'cover_image' => 'something',
		])
		->assertSessionHasErrors('cover_image');
});

it('returns an error if cover_image is over size limit', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'cover_image' => File::fake()
				->image('test', 3000, 3000),
		])
		->assertSessionHasErrors('cover_image');
});

it('returns an error if the title is missing', function () {
	actingAs(createUser())
		->post(route('posts.store'))
		->assertSessionHasErrors('title');
});

it('returns an error if the title is not a string', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'title' => null,
		])
		->assertSessionHasErrors('title');
});

it('returns an error if the title is 0 length', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'title' => '',
		])
		->assertSessionHasErrors('title');
});

it('returns an error if the title is over limit', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'title' => Str::random(181),
		])
		->assertSessionHasErrors('title');
});

it('returns an error if slug is missing', function () {
	actingAs(createUser())
		->post(route('posts.store'))
		->assertSessionHasErrors('slug');
});

it('returns an error if slug is not a string', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'slug' => null,
		])
		->assertSessionHasErrors('slug');
});

it('returns an error if slug is 0 length', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'slug' => '',
		])
		->assertSessionHasErrors('slug');
});

it('returns an error if slug is over limit', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'slug' => Str::random(181),
		])
		->assertSessionHasErrors('slug');
});

it('returns an error if slug is not unique', function () {
	$post = createPost();

	actingAs(createUser())
		->post(route('posts.store'), [
			'slug' => $post->slug,
		])
		->assertSessionHasErrors('slug');
});

it('returns an error if body is missing', function () {
	actingAs(createUser())
		->post(route('posts.store'))
		->assertSessionHasErrors('body');
});

it('returns an error if body is not a string', function () {
	actingAs(createUser())
		->post(route('posts.store'), [
			'body' => null,
		])
		->assertSessionHasErrors('body');
});

// TODO: add limit to body
// it('returns an error if body is over limit', function () {
// 	actingAs(createUser())
// 		->post(route('posts.store'), [
// 			'body' => null,
// 		])
// 		->assertSessionHasErrors('body');
// });

it('allows logged-in users to create a post', function () {
	$post = makePost();

	$posts_count = Post::count();

	$response = actingAs(createUser())
		->post(route('posts.store'), [
			'cover_image' => File::fake()
				->image('fake-image.jpg', 300, 300),
			'title' => $post->title,
			'slug' => $post->slug,
			'body' => $post->body,
		]);

	$post = Post::whereSlug($post->slug)->first();

	$response->assertRedirect(route('posts.edit', ['post' => $post]));

	expect(Post::count())->toEqual($posts_count + 1);
});

it('redirects logged-out users away from the post edit page', function () {
	get(route('posts.edit', [
		'post' => fake()->randomNumber(),
	]))
		->assertRedirect(route('login'));
});

it('loads the admin post edit page for signed-in users', function () {
	actingAs(createUser())
		->get(route('posts.edit', [
			'post' => createPost(),
		]))
		->assertStatus(200);
});

it('prevents logged-out users from updating a post', function () {
	$post = createPost();

	patch(route('posts.update', [
		'post' => $post,
	]), [
		'cover_image' => File::fake()
			->image('fake', 600, 600),
		'title' => $post->title,
		'slug' => $post->slug,
		'body' => $post->body,
	])
		->assertRedirect(route('login'));

	expect($post->updated_at->unix())
		->toEqual($post->refresh()->updated_at->unix());
});

test('on post update, return an error if cover_image is not an image file', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'cover_image' => null,
		])
		->assertSessionHasErrors('cover_image');
});

test('on post update, return an error if cover_image is over size limit', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'cover_image' => File::fake()
				->image('test', 3000, 3000),
		])
		->assertSessionHasErrors('cover_image');
});

test('on post update, return an error if the title is missing', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]))
		->assertSessionHasErrors('title');
});

test('on post update, return an error if the title is not a string', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'title' => null,
		])
		->assertSessionHasErrors('title');
});

test('on post update, return an error if the title is 0 length', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'title' => '',
		])
		->assertSessionHasErrors('title');
});

test('on post update, return an error if the title is over limit', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'title' => Str::random(181),
		])
		->assertSessionHasErrors('title');
});

test('on post update, return an error if slug is missing', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]))
		->assertSessionHasErrors('slug');
});

test('on post update, return an error if slug is not a string', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'slug' => null,
		])
		->assertSessionHasErrors('slug');
});

test('on post update, return an error if slug is 0 length', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'slug' => '',
		])
		->assertSessionHasErrors('slug');
});

test('on post update, return an error if slug is over limit', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'slug' => Str::random(181),
		])
		->assertSessionHasErrors('slug');
});

test('on post update, return an error if slug is not unique', function () {
	$other = createPost();

	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'slug' => $other->slug,
		])
		->assertSessionHasErrors('slug');
});

test('on post update, return an error if body is missing', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]))
		->assertSessionHasErrors('body');
});

test('on post update, return an error if body is not a string', function () {
	actingAs(createUser())
		->patch(route('posts.update', [
			'post' => createPost(),
		]), [
			'body' => null,
		])
		->assertSessionHasErrors('body');
});

// TODO: come back once length is chosen
// test('on post update, throw an error if body is over limit', function () {
// 	actingAs(createUser())
// 		->patch(route('posts.update', [
// 			'post' => createPost(),
// 		]), [
// 			'body' => stringOfLength(999999999),
// 		])
// 		->assertSessionHasErrors('body');
// });

it('allows logged-in users to update a post', function () {
	$post = createPost();

	actingAs(createUser())
		->from(route('posts.edit', [
			'post' => $post,
		]))
		->patch(route('posts.update', [
			'post' => $post,
		]), [
			'cover_image' => File::fake()
				->image('fake-image.jpg', 300, 300),
			'title' => fake()->title(),
			'slug' => fake()->slug(),
			'body' => fake()->paragraph(),
		])
		->assertRedirect(route('posts.edit', [
			'post' => $post,
		]))
		->assertSessionHas('success');
});

it('prevents logged-out users from deleting a post', function () {
	$post = createPost();

	$count = Post::count();

	delete(route('posts.destroy', [
		'post' => $post,
	]))
		->assertRedirect(route('login'));

	expect(Post::count())->toEqual($count);
});

it('prevents deleting a post that doesn\'t exist', function () {
	$count = Post::count();

	actingAs(createUser())
		->delete(route('posts.destroy', [
			'post' => fake()->randomNumber(),
		]))
		->assertNotFound();

	expect(Post::count())->toEqual($count);
});

it('allows logged-in users to delete a post', function () {
	$post = createPost();

	$count = Post::count();

	actingAs(createUser())
		->delete(route('posts.destroy', [
			'post' => $post,
		]))
		->assertRedirect(route('posts.index'))
		->assertSessionHas('success');

	expect(Post::count())->toEqual($count - 1);
});
