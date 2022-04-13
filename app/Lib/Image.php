<?php

namespace App\Lib;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image
{
    public static function delete($model, $attribute = null)
    {
        if ($model instanceof Model && $attribute) {
            $image = $model->getRawOriginal($attribute);
        } else {
            $image = $model;
        }

        if (Storage::exists($image)) {
            Storage::delete($image);
        }
    }

    public static function store($requestKey, $uploadPath, $name = null)
    {
        if (is_null($name)) {
            return request()->file($requestKey)->store('public' . DIRECTORY_SEPARATOR . $uploadPath);
        }

        return request()->file($requestKey)->storeAs('public' . DIRECTORY_SEPARATOR . $uploadPath, $name);
    }

    public static function url($model, $attribute = null)
    {
        if ($model instanceof Model && $attribute) {
            $image = $model->getRawOriginal($attribute);
        } else {
            $image = $model;
        }

        if ('local' === config('filesystems.default')) {
            return Storage::url(preg_replace("/^public\\\?\/?/", '', $image));
        }

        return Storage::url($image);
    }
}

