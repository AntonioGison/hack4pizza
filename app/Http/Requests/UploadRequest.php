<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'categories' => 'required',
            'description' => 'required',
        ];
        $images = count($this->input('images'));

        if($images > 0 ){
            foreach(range(0, $images) as $index) {
                $rules['images.' . $index] = 'required|image|mimes:jpeg,png,jpg';
            }
            return $rules;
        }else {
            return $rules;
        }



    }
}
