<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Config;

class CourseController extends Controller
{
    public function getAllCourseNames(Request $request)
{
    $perPage = $request->input('per_page', 6);
    $courseNames = Course::select('uuid', 'course_name_en', 'course_name_hn', 'description_en', 'description_hn', 'image_path')
        ->paginate($perPage);

    // Construct the base image URL using the value from config
    $baseImageUrl = Config::get('app.image_base_url');

    $courseNames->getCollection()->transform(function ($course) use ($baseImageUrl) {
        $course->img_url = $baseImageUrl . $course->image_path;
        return $course;
    });

    $currentPage = $courseNames->currentPage();
    $totalResults = $courseNames->total();
    $startResult = ($currentPage - 1) * $perPage + 1;
    $endResult = min($currentPage * $perPage, $totalResults);

    $paginationData = [
        'total_results' => $totalResults,
        'current_page' => $currentPage,
        'per_page' => $perPage,
        'result_range' => "Showing {$startResult}-{$endResult} of {$totalResults} results",
    ];

    $response = [
        'course_names' => $courseNames,
        'pagination' => $paginationData,
    ];

    return response()->json($response);
}
    
}
