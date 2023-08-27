<?php

namespace Database\Seeders;

use App\Actions\AddCategoryToPost;
use App\Actions\AddTagToPost;
use App\Models\Category;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
	public function addCategories(Post $post): Post
	{
		$addCategoryToPost = new AddCategoryToPost();

		Category::inRandomOrder()
			->limit(rand(0, 2))
			->get()
			->each(static fn ($category) => $addCategoryToPost($category, $post));

		return $post;
	}

	public function addTags(Post $post): Post
	{
		$addTagToPost = new AddTagToPost();

		Tag::inRandomOrder()
			->limit(rand(0, 7))
			->get()
			->each(static fn ($tag) => $addTagToPost($tag, $post));

		return $post;
	}

	public function maybeAttachImage(Post $post): Post
	{
		$image = Image::inRandomOrder()
			->limit(3)
			->get()
			->add(null)
			->random();

		if ($image !== null) $post->images()->sync([$image->id]);

		return $post;
	}

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
	{
		// Seed taxonomies
		$this->call([
			CategorySeeder::class,
			TagSeeder::class,
		]);

        DB::table(Post::make()->getTable())
			->truncate();

		Post::factory(15)
			->create()
			->each([$this, 'addCategories'])
			->each([$this, 'addTags'])
			->each([$this, 'maybeAttachImage']);
    }
}
