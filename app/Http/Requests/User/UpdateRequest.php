<?php

namespace App\Http\Requests\User;

use App\Models\Tag;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'max:100',
            'message' => 'max:1000',
        ];
    }

    public function updateProfile()
    {
        $this->user()->fill(
            $this->only(
                [
                    'title',
                    'message',
                    'hidden',
                ]
            )
        )->save();

        $tag_id = [];

        foreach ($this->tags as $tag) {
            $tag_id[] = Tag::firstOrCreate(
                [
                    'tag' => $tag,
                ]
            )->id;
        }

        $this->user()->tags()->sync($tag_id);
    }
}
