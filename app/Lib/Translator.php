<?php

namespace App\Lib;

use App\Models\LanguageKey;

use Illuminate\Translation\Translator as BaseTranslator;

class Translator extends BaseTranslator {
    public function get($key, array $replace = [], $locale = null, $fallback = true){
        if (!\Str::startsWith($key, 'validation')) {
            LanguageKey::updateOrCreate(['keyword' => $key]);
        }
        
        return parent::get($key, $replace, $locale, $fallback);
    }
}