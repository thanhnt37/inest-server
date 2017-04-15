<?php namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Base
{

    use SoftDeletes;

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
        'application_id',
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
    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class, 'application_id', 'id');
    }



    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id'             => $this->id,
            'device_id'      => $this->device_id,
            'name'           => $this->name,
            'model'          => $this->model,
            'platform'       => $this->platform,
            'os_version'     => $this->os_version,
            'application_id' => $this->application_id,
            'lbh'            => $this->lbh,
            'mode_player'    => $this->mode_player,
            'bg'             => $this->bg,
            'ads_name'       => $this->ads_name,
        ];
    }

}
