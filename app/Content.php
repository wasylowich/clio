<?php

namespace Clio;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content_type', 'title', 'body'];

    /*
    |--------------------------------------------------------------------------
    | Section for: Relation Methods
    |--------------------------------------------------------------------------
    |
    | Define all relation methods for the model here
    |
     */

    /**
     * Many-to-one relation with the ContentType model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function contentType()
    {
    	return $this->belongsTo(ContentType::class, 'content_type');
    }

    /**
     * Many-to-many relations with the ContentTypeProperty model.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function contentTypeProperties()
    {
    	return $this->belongsToMany(ContentTypeProperty::class, 'property_value', 'content', 'content_type_property')
    				->withPivot('value');
    }
}
