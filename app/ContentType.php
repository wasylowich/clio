<?php

namespace Clio;

use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_type';
    /**
     * Prevent automatica management of timestamps on the model
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['label'];

    /*
    |--------------------------------------------------------------------------
    | Section for: Relation Methods
    |--------------------------------------------------------------------------
    |
    | Define all relation methods for the model here
    |
     */

    /**
     * One-to-many relation with the Content model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentTypes()
    {
    	return $this->hasMany(Content::class, 'content_type');
    }

    /**
     * One-to-many relation with the ContentTypeProperty model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contentTypeProperties()
    {
        return $this->hasMany(ContentTypeProperty::class, 'content_type');
    }
}
