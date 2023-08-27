<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{

    protected $table = 'edu_topics';

    protected $fillable = [
        'uuid', 'parent_id', 'topic_name_en', 'topic_name_hn', 'description_en', 'description_hn', 'course_id', 'month_id',
    ];

    public function subTopics()
    {
        return $this->hasMany(Topic::class, 'parent_id');
    }

    public function parentTopic()
    {
        return $this->belongsTo(Topic::class, 'parent_id');
    }
}
