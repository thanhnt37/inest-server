<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Base
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertisements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type',
        'name',
        'icon_url',
        'url',
        'description',
        'image_url',
        'video_url',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];

    protected $presenter = \App\Presenters\AdvertisementPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\AdvertisementObserver);
    }

    // Relations


    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id'          => $this->id,
            'type'        => $this->type,
            'name'        => $this->name,
            'icon_url'    => $this->icon_url,
            'url'         => $this->url,
            'description' => $this->description,
            'image_url'   => $this->image_url,
            'video_url'   => $this->video_url,
        ];
    }

}
