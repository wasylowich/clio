<?php

use Clio\ContentType;
use Clio\ContentTypeProperty;
use Illuminate\Database\Seeder;

class ContentTypePropertiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('content_type')->delete();

        $contentType = factory(ContentType::class)->create(['label' => 'article']);

        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'isVisible']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'readTimeInMinutes']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'author']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'background-color']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'margin']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'tag']);
    }
}
