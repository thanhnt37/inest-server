<?php namespace App\Models;


class ApplicationDevice extends Base
{


    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'application_devices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [

    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = [];

    protected $presenter = \App\Presenters\ApplicationDevicePresenter::class;

    public static function boot()
    {
        parent::boot();
        parent::observe(new \App\Observers\ApplicationDeviceObserver);
    }

    // Relations
    public function application()
    {
        return $this->belongsTo(\App\Models\Application::class, 'application_id', 'id');
    }

    public function device()
    {
        return $this->belongsTo(\App\Models\Device::class, 'device_id', 'id');
    }


    // Utility Functions

    /*
     * API Presentation
     */
    public function toAPIArray()
    {
        return [
            'id' => $this->id,

        ];
    }

}
