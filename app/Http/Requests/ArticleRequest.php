<?php

namespace Clio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        switch ($this->method()) {
            case 'GET':
                break;

            case 'POST':
                break;

            case 'PUT':
            case 'PATCH':
                break;

            case 'DELETE':
                break;

            default:
        }

        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];

            case 'POST':

                return [
                    'title'                    => 'required',
                    'type'                     => 'required|in:article',
                    'body'                     => 'required',
                    'isVisible'                => 'required|boolean',
                    'readTimeInMinutes'        => 'required|integer',
                    'author'                   => 'required',
                    'styling'                  => 'required|array',
                    'styling.background-color' => 'required',
                    'styling.margin'           => 'required',
                    'tags'                     => 'required|array',
                ];

            case 'PUT':
            case 'PATCH':
                return [];

            default:
                return [];
        }
    }
}
