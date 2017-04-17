<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Base
{

    use SoftDeletes;

    const TYPE_MODE_PLAYER_YT   = 'yt';
    const TYPE_MODE_PLAYER_XCD  = 'xcd';

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'device_id',
        'name',
        'model',
        'platform',
        'os_version',
        'lbh',
        'mode_player',
        'bg',
        'ads_name',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];

    protected $presenter = \App\Presenters\DevicePresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\DeviceObserver);
    }

    // Relations
    public function applications()
    {
        return $this->belongsToMany('App\Models\Application', ApplicationDevice::getTableName(), 'device_id', 'application_id');
    }



    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'lbh'            => $this->lbh ? true : false,
            'mode_player'    => $this->mode_player,
            'bg'             => $this->bg ? true : false,
            'ads_name'       => $this->ads_name,
        ];
    }

}
