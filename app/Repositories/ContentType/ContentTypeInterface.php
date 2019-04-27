<?php

namespace Clio\Repositories\ContentType;

interface ContentTypeInterface
{
    /**
     * Fetch contentType
     *
     * @param  int $id
     * @return \Clio\ContentType
     */
    public function find($id);

    /**
     * Fetch contentType by label
     *
     * @param string $label
     * @return \Clio\ContentType
     */
    public function findByLabel($label);

    /**
     * Fetch all contentTypes
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();
}
