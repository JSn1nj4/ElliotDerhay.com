<?php

use App\Models\Project;
use Illuminate\Http\Testing\File;
use function Pest\Faker\faker;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\post;

it('redirects logged-out users away from the admin projects page', function () {
	get(route('projects.index'))
		->assertRedirect(route('login'));
});

it('loads the admin projects page for signed-in users', function () {
	actingAs(createUser())
		->get(route('projects.index'))
		->assertStatus(200);
});

it('redirects logged-out users away from the project view page', function () {
	get(route('projects.show', [
		'project' => createProject(),
	]))
		->assertRedirect(route('login'));
});

it('loads the admin project view page for signed-in users', function () {
	actingAs(createUser())
		->get(route('projects.show', [
			'project' => createProject(),
		]))
		->assertStatus(200);
});

it('redirects logged-out users away from the project create page', function () {
	get(route('projects.create'))
		->assertRedirect(route('login'));
});

it('loads the admin project create page for signed-in users', function () {
	actingAs(createUser())
		->get(route('projects.create'))
		->assertStatus(200);
});

it('prevents logged-out users from creating a project', function () {
	$count = Project::count();
	$project = makeProject();

	post(route('projects.store'), [
		'name' => $project->name,
		'link' => $project->link,
		'demo_link' => $project->demo_link,
		'short_desc' => $project->short_desc,
	])->assertRedirect(route('login'));

	expect(Project::count())->toEqual($count);
});

it('errors if thumbnail is not an image file', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'thumbnail' => null,
		])
		->assertSessionHasErrors('thumbnail');
});

it('errors if thumbnail is over size limit', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'thumbnail' => File::fake()
				->image('test', 3000, 3000),
		])
		->assertSessionHasErrors('thumbnail');
});

it('errors if the name is missing', function () {
	actingAs(createUser())
		->post(route('projects.store'))
		->assertSessionHasErrors('name');
});

it('errors if the name is not a string', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'name' => null,
		])
		->assertSessionHasErrors('name');
});

it('errors if the name is 0 length', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'name' => '',
		])
		->assertSessionHasErrors('name');
});

it('errors if the name is over limit', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'name' => Str::random(181),
		])
		->assertSessionHasErrors('name');
});

it('errors if link is missing', function () {
	actingAs(createUser())
		->post(route('projects.store'))
		->assertSessionHasErrors('link');
});

it('errors if link is not a valid URL', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'link' => null,
		])
		->assertSessionHasErrors('link');
});

it('errors if link is 0 length', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'link' => '',
		])
		->assertSessionHasErrors('link');
});

it('errors if link is over limit', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'link' => Str::random(2049),
		])
		->assertSessionHasErrors('link');
});

it('errors if link is not unique', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'link' => createProject()->link,
		])
		->assertSessionHasErrors('link');
});

it('errors if demo_link is not a valid url or null', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'demo_link' => 0,
		])
		->assertSessionHasErrors('demo_link');
});

it('errors if demo_link is over limit', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'demo_link' => Str::random(2049),
		])
		->assertSessionHasErrors('demo_link');
});

it('errors if demo_link is not unique', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'demo_link' => createProject()->demo_link,
		])
		->assertSessionHasErrors('demo_link');
});

it('errors if short_desc is missing', function () {
	actingAs(createUser())
		->post(route('projects.store'))
		->assertSessionHasErrors('short_desc');
});

it('errors if short_desc is not a string', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'short_desc' => null,
		])
		->assertSessionHasErrors('short_desc');
});

it('errors if short_desc is 0 length', function () {
	actingAs(createUser())
		->post(route('projects.store'), [
			'short_desc' => '',
		])
		->assertSessionHasErrors('short_desc');
});

// todo: set length limit in request rules
// it('errors if short_desc is over limit', function () {
// 	actingAs(createUser())
// 		->post(route('projects.store'), [
// 			'short_desc' => Str::random(2049),
// 		])
// 		->assertSessionHasErrors('short_desc');
// });

it('allows logged-in users to create a project', function () {
	$project = makeProject();
	// dump($project);

	$count = Project::count();

	$response = actingAs(createUser())
		->post(route('projects.store'), [
			'thumbnail' => File::fake()
				->image('fake-image.jpg', 300, 300),
			'name' => $project->name,
			'link' => $project->link,
			'demo_link' => $project->demo_link,
			'short_desc' => $project->short_desc,
		]);

	$project = Project::whereLink($project->link)->first();

	$response->assertSessionHasNoErrors()
		->assertRedirect(route('projects.edit', [
			'project' => $project,
		]));

	expect(Project::count())->toEqual($count + 1);
});

it('redirects logged-out users away from the project edit page', function () {
	get(route('projects.edit', [
		'project' => faker()->randomNumber(),
	]))
		->assertRedirect(route('login'));
});

it('loads the admin project edit page for signed-in users', function () {
	actingAs(createUser())
		->get(route('projects.edit', [
			'project' => createProject(),
		]))
		->assertSessionHasNoErrors()
		->assertStatus(200);
});

it('prevents logged-out users from updating a project', function () {
	$project = createProject();

	patch(route('projects.update', [
		'project' => $project,
	]), [
		'thumbnail' => File::fake()
			->image('fake', 600, 600),
		'name' => $project->name,
		'link' => $project->name,
		'demo_link' => $project->demo_link,
		'short_desc' => $project->short_desc,
	])
		->assertRedirect(route('login'));
});

test('on update, error if thumbnail is not an image file', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'thumbnail' => null,
		])
		->assertSessionHasErrors('thumbnail');
});

test('on update, error if thumbnail is over size limit', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'thumbnail' => File::fake()
				->image('test', 3000, 3000),
		])
		->assertSessionHasErrors('thumbnail');
});

test('on update, error if the name is missing', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]))
		->assertSessionHasErrors('name');
});

test('on update, error if the name is not a string', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'name' => null,
		])
		->assertSessionHasErrors('name');
});

test('on update, error if the name is 0 length', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'name' => '',
		])
		->assertSessionHasErrors('name');
});

test('on update, error if the name is over limit', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'name' => Str::random(181),
		])
		->assertSessionHasErrors('name');
});

test('on update, error if link is missing', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]))
		->assertSessionHasErrors('link');
});

test('on update, error if link is not a valid URL', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'link' => null,
		])
		->assertSessionHasErrors('link');
});

test('on update, error if link is 0 length', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'name' => '',
		])
		->assertSessionHasErrors('name');
});

test('on update, error if link is over limit', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'link' => Str::random(2049),
		])
		->assertSessionHasErrors('link');
});

test('on update, error if link is not unique', function () {
	$project = createProject();

	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'link' => $project->link,
		])
		->assertSessionHasErrors('link');
});

test('on update, error if demo_link is not a valid URL or null', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'demo_link' => 0,
		])
		->assertSessionHasErrors('demo_link');
});

test('on update, error if demo_link is over limit', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'demo_link' => Str::random(2049),
		])
		->assertSessionHasErrors('demo_link');
});

test('on update, error if demo_link is not unique', function () {
	$project = createProject();

	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'demo_link' => $project->demo_link,
		])
		->assertSessionHasErrors('demo_link');
});

test('on update, error if short_desc is missing', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]))
		->assertSessionHasErrors('short_desc');
});

test('on update, error if short_desc is not a string', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'short_desc' => null,
		])
		->assertSessionHasErrors('short_desc');
});

test('on update, error if short_desc is 0 length', function () {
	actingAs(createUser())
		->patch(route('projects.update', [
			'project' => createProject(),
		]), [
			'short_desc' => '',
		])
		->assertSessionHasErrors('short_desc');
});

// todo: set limit and test
// test('on update, error if short_desc is over limit', function () {
// 	actingAs(createUser())
// 		->patch(route('projects.update', [
// 			'project' => createProject(),
// 		]), [
// 			'short_desc' => Str::random(),
// 		])
// 		->assertSessionHasErrors('short_desc');
// });

it('allows logged-in users to update a project', function () {
	$project = createProject();

	actingAs(createUser())
		->from(route('projects.edit', [
			'project' => $project,
		]))
		->patch(route('projects.update', [
			'project' => $project,
		]), [
			'thumbnail' => File::fake()
				->image('fake.jpg', 3000, 3000),
			'name' => faker()->title,
			'link' => faker()->unique()->url,
			'demo_link' => faker()->unique()->url,
			'short_desc' => faker()->paragraph,
		])
		->assertSessionHasNoErrors()
		->assertRedirect(route('projects.edit', [
			'project' => $project,
		]));
});

it('prevents logged-out users from deleting a project', function () {
	$project = createProject();

	$count = Project::count();

	delete(route('projects.destroy', [
		'project' => $project,
	]))
		->assertRedirect(route('login'));

	expect(Project::count())->toEqual($count);
});

it('prevents deleting a project that doesn\'t exist', function () {
	$count = Project::count();

	actingAs(createUser())
		->delete(route('projects.destroy', [
			'project' => faker()->randomNumber(),
		]))
		->assertNotFound();

	expect(Project::count())->toEqual($count);
});

it('allows logged-in users to delete a project', function () {
	$project = createProject();

	$count = Project::count();

	actingAs(createUser())
		->delete(route('projects.destroy', [
			'project' => $project,
		]))
		->assertRedirect(route('projects.index'))
		->assertSessionHas('success');

	expect(Project::count())->toEqual($count - 1);
});
