<?php

namespace Clio\Repositories\ContentType;

use Clio\ContentType;

class ContentTypeRepository implements ContentTypeInterface
{
    /**
     * Fetch contentType
     *
     * @param  int $id
     * @return \Clio\ContentType
     */
    public function find($id)
    {
        return ContentType::find($id);
    }

    /**
     * Fetch contentType by label
     *
     * @param string $label
     * @return \Clio\ContentType
     */
    public function findByLabel($label)
    {
        return ContentType::where('label', $label)->first();
    }

    /**
     * Fetch all contentTypes
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all()
    {
        return ContentType::all();
    }
}
