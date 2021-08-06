<?php

namespace App\Services\Project;

use App\Models\Identification;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\ProjectFile;
use Exception;
use Illuminate\Http\Exceptions\HttpResponseException;
use Log;

class ProjectService
{
    public function attachTags(Project $project, Request $request)
    {
        if ($request->has('tags')) {
            $project->tags()->detach();
            $project->tags()->attach(array_values($request->tags));
        } else if ($request->has('tags') === false && $request->current_tab === 'overview') {
            $project->tags()->detach();
        }
    }

    public function saveProjectImage(Project $project, ProjectFile $project_file = null, Request $request)
    {
        try {
            if (isset($project_file)) {
                $project_file->file_url = $request->file;
                $project_file->save();
            } else {
                $project->projectFiles()->save(
                    ProjectFile::make([
                        'file_url' => $request->file,
                        'file_content_type' => 'image_url'
                    ])
                );
            };
        } catch (Exception $e) {
            Log::alert($e->getMessage(), $e->getTrace());
            $res = response()->json([
                'status' => 500,
                'errors' => $e->getMessage(),
            ], 500);
            throw new HttpResponseException($res);
        }
    }

    public function saveVideoUrl(Project $project, Request $request)
    {
        if ($request->has('video_url') && $request->video_url !== null) {
            $project->projectFiles()->save(
                ProjectFile::make([
                    'file_url' => $request->video_url,
                    'file_content_type' => 'video_url'
                ])
            );
        }
    }
}
