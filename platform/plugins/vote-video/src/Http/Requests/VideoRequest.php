<?php
/**
 * VideoRequest.php
 * Created by: trainheartnet
 * Created at: 24/12/2021
 * Contact me at: longlengoc90@gmail.com
 */


namespace Botble\VideoVoting\Http\Requests;

use Botble\Base\Enums\BaseStatusEnum;
use Botble\Support\Http\Requests\Request;
use Illuminate\Validation\Rule;

class VideoRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name'        => 'required|max:255',
            'description' => 'max:400',
            'categories'  => 'required',
            'status'      => Rule::in(BaseStatusEnum::values()),
        ];

        return $rules;
    }
}
