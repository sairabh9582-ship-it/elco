<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'site_name', 'phone', 'email', 'address', 'logo', 'favicon', 'primary_color', 'secondary_color',
        'home_meta_title', 'home_meta_description', 'home_meta_keywords', 'home_meta_image',
        'facebook_link', 'twitter_link', 'linkedin_link',
        'instagram_link',
        'youtube_link',
        'whatsapp_link',
        'currency',
        'shiprocket_email', 'shiprocket_password',
        'footer_description',
        'copyright_text',
        'footer_phone'
    ];
}
