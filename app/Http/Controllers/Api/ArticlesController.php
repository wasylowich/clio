<?php

namespace Clio\Http\Controllers\Api;

use Clio\Content;
use Clio\ContentType;
use Clio\Factories\ArticleFactory;
use Illuminate\Support\Facades\DB;
use Clio\Http\Requests\ArticleRequest;

class ArticlesController extends BaseApiController
{
    const LABEL_ARTICLE = 'article';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = collect();

        $articleType = ContentType::whereLabel(self::LABEL_ARTICLE)->first();

        $contents = Content::with('contentType')->whereContentType($articleType->id)->get();

        foreach ($contents as $content) {
            $article = $this->articleTransformer($content);

            $articles->push($article);
        }

        return $articles;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Clio\Http\Requests\ArticleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        $articleFactory = resolve(ArticleFactory::class);

        $article = DB::transaction(function () use ($request, $articleFactory) {
            $article = $articleFactory->create(
                $request->title,
                $request->body,
                $request->isVisible,
                $request->readTimeInMinutes,
                $request->author,
                $request->styling,
                $request->tags,
            );

            return $article;
        });

        return response($this->articleTransformer($article), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Clio\Content  $article
     * @return \Illuminate\Http\Response
     */
    public function show($articleId)
    {
        $article = Content::find($articleId);

        if (! $article) {
            return response("Sorry. We couldn't find that article", 404);
        }

        return response($this->articleTransformer($article), 200);
    }

    /**
     * Transforms (Dvs. harmonizes) the content of an artical into a composite entity
     *
     * @param  \Clio\Content $content
     * @return array
     */
    protected function articleTransformer($content)
    {
        $article = [
            'id'    => $content->id,
            'title' => $content->title,
            'type'  => $content->contentType->label,
            'body'  => $content->body,
        ];

        $properties = $content->contentTypeProperties;

        $styles = [];

        foreach ($properties as $property) {
            switch ($property->label) {
                case 'background-color':
                case 'margin':
                    $styles[$property->label] = $property->pivot->value;
                    break;

                case 'isVisible':
                    $article[$property->label] = ($property->pivot->value == 'true' ? true : false);
                    break;

                case 'readTimeInMinutes':
                    $article[$property->label] = (int) $property->pivot->value;
                    break;

                case 'tag':
                    $article[$property->label][] = $property->pivot->value;
                    break;

                default:
                    $article[$property->label] = $property->pivot->value;
            }

            $article['styling'] = (object) $styles;
        }

        return $article;
    }
}
