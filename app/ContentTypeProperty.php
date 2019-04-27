<?php

namespace Clio;

use Illuminate\Database\Eloquent\Model;

class ContentTypeProperty extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'content_type_property';
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
    public function contents()
    {
    	return $this->belongsToMany(Content::class, 'property_value', 'content_type_property', 'content')
    				->withPivot('value');
    }
}
