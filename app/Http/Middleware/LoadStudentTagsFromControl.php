<?php

namespace App\Http\Middleware;

use App\Packages\ControlDB\Models\Student;
use App\Packages\ControlDB\Models\StudentTag;
use Closure;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class LoadStudentTagsFromControl
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::user()->isAdmin()) {
            $studentId = Auth::guard('committee-role')->user()->student_id;

            $studentTags = Cache::remember('Middleware.LoadStudentTagsFromControl.'.$studentId, 200, function() use ($studentId) {

                $student = Student::find($studentId);
                $studentTags = StudentTag::allThrough($student);

                if($studentTags === false) {
                    return Collection::make([]);
                }

                return $studentTags;
            });
        } else {
            $studentTags = new Collection();
        }


        $request->attributes->add(['auth_student_tags' => $studentTags]);
        
        return $next($request);
    }
}
