<?php

use Clio\Content;
use Clio\ContentType;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Clio\Repositories\ContentType\ContentTypeInterface;

class ContentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_value')->delete();
        DB::table('content')->delete();

        $faker = Faker::create('da_DK');

        $tags = collect([
            'Art',
            'Books',
            'Business',
            'Design',
            'Education',
            'Family',
            'Fashion',
            'Fitness',
            'Food',
            'Health',
            'Humor',
            'Internet',
            'Life',
            'Marketing',
            'Movies',
            'Music',
            'News',
            'Photography',
            'Politics',
            'Real',
            'Estate',
            'Recipes',
            'Reviews',
            'Technology',
            'Travel',
            'Writing'
        ]);

        $contentTypeRepository = resolve(ContentTypeInterface::class);

        $articleContentType = $contentTypeRepository->findByLabel('article');

        $isVisibleProperty         = $articleContentType->contentTypeProperties->where('label', 'isVisible')->first();
        $readTimeInMinutesProperty = $articleContentType->contentTypeProperties->where('label', 'readTimeInMinutes')->first();
        $authorProperty            = $articleContentType->contentTypeProperties->where('label', 'author')->first();
        $backgroundColorProperty   = $articleContentType->contentTypeProperties->where('label', 'background-color')->first();
        $marginProperty            = $articleContentType->contentTypeProperties->where('label', 'margin')->first();
        $tagProperty               = $articleContentType->contentTypeProperties->where('label', 'tag')->first();

        // Seed 1st article
        $content = factory(Content::class)->create([
            'content_type' => $articleContentType->id,
            'title'        => 'My article',
        ]);

        $content->contentTypeProperties()->attach([
            $isVisibleProperty->id => ['value' => 'true'],
        ]);

        $content->contentTypeProperties()->attach([
            $readTimeInMinutesProperty->id => ['value' => '35'],
        ]);

        $content->contentTypeProperties()->attach([
            $authorProperty->id => ['value' => 'John Doe'],
        ]);

        $content->contentTypeProperties()->attach([
            $backgroundColorProperty->id => ['value' => 'red'],
        ]);

        $content->contentTypeProperties()->attach([
            $marginProperty->id => ['value' => '0 auto'],
        ]);

        $content->contentTypeProperties()->attach([
            $tagProperty->id => ['value' => 'worlds news'],
        ]);

        $content->contentTypeProperties()->attach([
            $tagProperty->id => ['value' => 'bacon'],
        ]);

        $content->contentTypeProperties()->attach([
            $tagProperty->id => ['value' => 'England'],
        ]);


        // Seed 2nd article
        $content = factory(Content::class)->create([
            'content_type' => $articleContentType->id,
            'title'        => 'Another article',
        ]);

        $content->contentTypeProperties()->attach([
            $isVisibleProperty->id => ['value' => ($faker->boolean() ? 'true' : 'false')],
        ]);

        $content->contentTypeProperties()->attach([
            $readTimeInMinutesProperty->id => ['value' => (string) collect([30,45,60,90,120])->random()],
        ]);

        $content->contentTypeProperties()->attach([
            $authorProperty->id => ['value' => $faker->name],
        ]);

        $content->contentTypeProperties()->attach([
            $backgroundColorProperty->id => ['value' => $faker->safeColorName],
        ]);

        $content->contentTypeProperties()->attach([
            $marginProperty->id => ['value' => '0 auto'],
        ]);

        foreach ($tags->random(mt_rand(2, 5)) as $tag) {
            $content->contentTypeProperties()->attach([
                $tagProperty->id => ['value' => $tag],
            ]);
        }
    }
}
