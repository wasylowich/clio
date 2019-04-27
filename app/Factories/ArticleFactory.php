<?php

namespace Clio\Factories;

use Clio\Content;
use Clio\Repositories\ContentType\ContentTypeInterface;

class ArticleFactory
{
    /**
     * Creates a Content model
     *
     * @param  string  $title
     * @param  string  $body
     * @param  bool    $isVisible
     * @param  int     $readTimeInMinutes
     * @param  string  $author
     * @param  string  $styling
     * @param  array   $tags
     * @return \Clio\Content
     */
    public function create(
        $title,
        $body,
        $isVisible,
        $readTimeInMinutes,
        $author,
        $styling,
        $tags
    )
    {
        $contentTypeRepository = resolve(ContentTypeInterface::class);

        $articleContentType = $contentTypeRepository->findByLabel('article');

        $article = Content::create([
            'content_type' => $articleContentType->id,
            'title'        => $title,
            'body'         => $body,
        ]);

        $isVisibleProperty         = $articleContentType->contentTypeProperties->where('label', 'isVisible')->first();
        $readTimeInMinutesProperty = $articleContentType->contentTypeProperties->where('label', 'readTimeInMinutes')->first();
        $authorProperty            = $articleContentType->contentTypeProperties->where('label', 'author')->first();
        $backgroundColorProperty   = $articleContentType->contentTypeProperties->where('label', 'background-color')->first();
        $marginProperty            = $articleContentType->contentTypeProperties->where('label', 'margin')->first();
        $tagProperty               = $articleContentType->contentTypeProperties->where('label', 'tag')->first();

        $article->contentTypeProperties()->attach([
            $isVisibleProperty->id => ['value' => ($isVisible ? 'true' : 'false')],
        ]);

        $article->contentTypeProperties()->attach([
            $readTimeInMinutesProperty->id => ['value' => "{$readTimeInMinutes}"],
        ]);

        $article->contentTypeProperties()->attach([
            $authorProperty->id => ['value' => $author],
        ]);

        foreach ($styling as $styleName => $styleValue) {
            switch ($styleName) {
                case 'background-color':
                    $property = $backgroundColorProperty;
                    break;

                case 'margin':
                    $property = $marginProperty;
            }

            $article->contentTypeProperties()->attach([
                $property->id => ['value' => $styleValue],
            ]);
        }

        foreach ($tags as $tag) {
            $article->contentTypeProperties()->attach([
                $tagProperty->id => ['value' => $tag],
            ]);
        }

        return $article;
    }
}
