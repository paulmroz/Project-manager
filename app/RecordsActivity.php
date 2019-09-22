<?php


namespace App;


use function foo\func;

trait RecordsActivity
{
    public $oldAttributes = [];


    public static function bootRecordsActivity()
    {


        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {
                $description = $event;
                if (class_basename($model) !== 'Project') {
                    $description = "{$event}_" . strtolower(class_basename($model));
                }
                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }
    }


    protected function activityDescription($description)
    {
        return "{$description}_" . strtolower(class_basename($this));
    }

    /**
     * @return array|mixed
     */
    public static function recordableEvents()
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        } else {
            return ['created', 'updated', 'deleted'];
        }
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id
        ]);
    }


    protected function activityChanges()
    {
        if ($this->wasChanged()) {
            return [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after' => array_except($this->getChanges(), 'updated_at')
            ];
        }

    }


    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }
}
