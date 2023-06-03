<?php

namespace Modules\Certificate\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class CertificateDesign extends Model
{

    use HasTranslations;

    public $translatable = ['title', 'body'];

    protected $table = 'certificate_design';

    protected $fillable = ['background_image', 'background_image_enable', 'background_color', 'logo_image', 'logo_enable', 'border_one', 'border_one_color', 'border_one_enable', 'border_two', 'border_two_color', 'border_two_enable', 'width', 'height', 'title', 'title_position', 'title_font_size', 'title_font_color', 'body', 'body_position', 'body_font_size', 'body_font_color', 'body_max_len', 'date', 'date_position', 'date_font_size', 'date_font_color', 'date_format', '', 'signature_image', 'signature_position', 'signature_height', 'signature_width', 'name', 'name_position', 'name_font_size', 'name_font_color', 'for_course', 'for_quiz', 'default', 'logo_width', 'logo_height', 'logo_position','percentage','date_enable','widget1_enable','widget2_enable','widget3_enable'];

    /**
     * Convert the model instance to an array.
     *
     * @return array
     */
    public function toArray()
    {
        $attributes = parent::toArray();

        foreach ($this->getTranslatableAttributes() as $name) {
            $attributes[$name] = $this->getTranslation($name, app()->getLocale());
        }

        return $attributes;
    }

}
