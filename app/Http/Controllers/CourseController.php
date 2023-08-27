<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function getAllCourseNames(Request $request)
    {
        $perPage = $request->input('per_page', 6); // Number of items per page
        $courseNames = Course::select('uuid', 'course_name_en', 'course_name_hn','description_en','description_hn')->paginate($perPage);
        
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
