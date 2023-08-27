<?php
    namespace App\Http\Controllers;

    use Illuminate\Http\Request;
    use App\Models\Topic;
    use App\Models\Course;
    
    class TopicController extends Controller
    {
        public function getTopicsByCourseId($uuid)
{
    // Get the course_id using the provided uuid
    $courseId = Course::where('uuid', $uuid)->value('id');
    
    // Get topics (excluding sub-topics) related to the course_id
    $topics = Topic::where('course_id', $courseId)
        ->where('parent_id', 0) // Only top-level topics
        ->with(['subTopics' => function ($query) {
            $query->select('uuid', 'parent_id', 'topic_name_en', 'topic_name_hn');
        }])
        ->select('id', 'topic_name_en', 'description_en','description_hn' ,'topic_name_hn', 'parent_id')
        ->get();
    
    return response()->json($topics);
}

public function getTopicDescriptionsByUuid($uuid)
{
    // Get topic description based on the provided uuid
    $topicDescription = Topic::where('uuid', $uuid)
        ->select('description_en', 'description_hn')
        ->first();
    
    return response()->json($topicDescription);
}

        
    }
    