<?php

namespace Tests\Feature;

use Clio\User;
use Tests\TestCase;
use Clio\ContentType;
use Clio\ContentTypeProperty;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * The user model
     *
     * @var /Clio/User
     */
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $contentType = factory(ContentType::class)->create(['label' => 'article']);

        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'isVisible']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'readTimeInMinutes']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'author']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'background-color']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'margin']);
        factory(ContentTypeProperty::class)->create(['content_type' => $contentType->id, 'label' => 'tag']);

        $this->user = factory(User::class)->create();
    }

    /** @test */
    public function a_contributer_can_create_an_article()
    {
        $this->actingAs($this->user, 'api');

        $payload = [
          "title"             => "New article",
          "type"              => "article",
          "body"              => "<p>A really greate story.</p>",
          "isVisible"         => true,
          "readTimeInMinutes" => 60,
          "author"            => "Brian Wasylowihc",
          "styling"           => [
            "background-color" => "green",
            "margin"           => "0 auto"
          ],
          "tags" => [
            "PHP",
            "Laravel",
            "Web"
          ],
          "api_token" => "b-secret"
        ];

        $response = $this->json('POST', route('api.articles.store'), $payload)
            ->assertStatus(201)
            ->assertJson([
                'title'   => $payload['title'],
                'body'    => $payload['body'],
            ]);
    }

    /**
     * *************************************************************************
     *
     * Negative Tests
     *
     * *************************************************************************
     */

    /** @test */
    public function a_contributer_cannot_create_an_article_without_required_fields()
    {
        $this->actingAs($this->user, 'api');

        $payload = [];

        $response = $this->json('POST', route('api.articles.store'), $payload)
            ->assertStatus(422)
            ->assertJsonValidationErrors([
                'title',
                'type',
                'body',
                'isVisible',
                'readTimeInMinutes',
                'author',
                'styling',
                'styling.background-color',
                'styling.margin',
                'tags',
            ]);
    }
}
