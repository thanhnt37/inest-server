<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Application extends Base
{

    use SoftDeletes;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'bundle_id',
        'version',
        'introduction',
        'icon',
        'ios_url',
        'android_url',
        'ads_type',
        'message_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];

    protected $presenter = \App\Presenters\ApplicationPresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\ApplicationObserver);
    }

    // Relations
    public function message()
    {
        return $this->belongsTo(\App\Models\Message::class, 'message_id', 'id');
    }

    public function devices()
    {
        return $this->belongsToMany('App\Models\Device', ApplicationDevice::getTableName(), 'application_id', 'device_id');
    }



    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id'           => $this->id,
            'name'         => $this->name,
            'bundle_id'    => $this->bundle_id,
            'version'      => $this->version,
            'introduction' => $this->introduction,
            'icon'         => $this->icon,
            'ios_url'      => $this->ios_url,
            'android_url'  => $this->android_url,
            'ads_type'     => $this->ads_type,
            'message_id'   => $this->message_id,
        ];
    }

}
