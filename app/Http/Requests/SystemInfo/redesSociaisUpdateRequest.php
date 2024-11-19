<?php

namespace App\Http\Requests\SystemInfo;

use Illuminate\Foundation\Http\FormRequest;

class redesSociaisUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'enable_share' => 'required|integer|min:1|max:2',
            'enable_groups' => 'required|integer|min:1|max:2',
            'enable_social_footer' => 'required|integer|min:1|max:2',
            'link_gratis_url' => 'nullable|url|max:255',
            'telegram_group_url' => 'nullable|url|max:255',
            'whatsapp_group_url' => 'nullable|url|max:255',
            'instagram_group_url' => 'nullable|url|max:255',
            'whatsapp_footer' => 'nullable|string|max:255',
            'instagram_footer' => 'nullable|string|max:255',
            'facebook_footer' => 'nullable|string|max:255',
            'twitter_footer' => 'nullable|string|max:255',
            'youtube_footer' => 'nullable|string|max:255',
            'tag_google_analytics' => 'nullable|string|max:255',
        ];
    }
}
