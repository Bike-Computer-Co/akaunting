<?php

namespace App\Models;

use App\Enums\MediaUsage;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaFile extends Model
{
    use HasFactory;

    protected $fillable = ['source', 'usage'];

    protected $appends = ['full_source'];

    protected $casts = [
        'usage' => MediaUsage::class,
    ];

    protected $attributes = [
        'usage' => MediaUsage::DEFAULT,
    ];

    public function belongs(): MorphTo
    {
        return $this->morphTo('belongs');
    }

    public function fullSource(): Attribute
    {
        // $value = Str::of($this->source)->startsWith('http')
        //     ? $this->source
        //     : Storage::url($this->source);

        return Attribute::get(fn () => '');
    }

    public static function make($belongs, $filename, $usage = MediaUsage::DEFAULT)
    {
        return tap(new MediaFile([
            'source' => $filename,
            'usage' => $usage,
        ]), function ($media) use ($belongs) {
            $media->belongs()->associate($belongs);

            return $media->save();
        });
    }

    public static function calculateFilename($file, $folder): string
    {
        $filename = Str::uuid().'.'.$file->getClientOriginalExtension();

        return $folder ? "{$folder}/{$filename}" : $filename;
    }

    protected static function boot()
    {
        parent::boot();
        self::deleted(function (MediaFile $media) {
            Storage::delete($media->source);
        });
    }
}
