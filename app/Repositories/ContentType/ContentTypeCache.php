<?php

namespace Clio\Repositories\ContentType;

use Clio\ContentType;
use Illuminate\Support\Facades\Cache;

class ContentTypeCache implements ContentTypeInterface
{
    /**
     * The next object in line to be decorated
     *
     * @var \Clio\Repositories\ContentType\ContentTypeInterface
     */
    private $next;

    /**
     * Class constructor
     *
     * @param \Clio\Repositories\ContentType\ContentTypeInterface $next
     */
    public function __construct(ContentTypeInterface $next)
    {
        $this->next = $next;
    }

    /**
     * Fetch contentType
     *
     * @param  int $id
     * @return \Clio\ContentType
     */
    public function find($id)
    {
        $cacheKey = vsprintf('%s:%s', ['content-type-by-id', $id]);

        return Cache::remember($cacheKey, 60 * 24 * 365, function () use ($id) {
            return $this->next->find($id);
        });
    }

    /**
     * Fetch contentType by label
     *
     * @param string $label
     * @return \Clio\ContentType
     */
    public function findByLabel($label)
    {
        $cacheKey = vsprintf('%s:%s', ['content-type-by-label', $label]);

        return Cache::remember($cacheKey, 60 * 24 * 365, function () use ($label) {
            return $this->next->findByLabel($label);
        });
    }

    /**
     * Fetch all contentTypes
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        $cacheKey = vsprintf('%s', ['all-content-types']);

        return Cache::remember($cacheKey, 60 * 24 * 365, function () {
            return $this->next->all();
        });
    }
}
