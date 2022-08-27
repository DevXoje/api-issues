<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Http\Requests\StoreIssueRequest;
use App\Http\Requests\UpdateIssueRequest;
use Error;

class IssueController extends ApiController
{
    public function index()
    {
        if (!$issues = Issue::all()) {
            return $this->errorResponse('No issues found', 404);
        }
        return $this->successResponse("Issues fetched", $issues);
    }

    public function store(StoreIssueRequest $request)
    {
        //Puede que falle
        if (!$validData = $request->validated()) {
            //errors() puede que no exista, buscar sustituto
            return $this->errorResponse('Validation error.', $request->errors(), 400);
        }

        try {
            $issue = Issue::create($validData);
            return $this->successResponse("Issue Created", $issue, 201);
        } catch (Error $e) {
            return $this->errorResponse('Error creating product.', $e->getMessage(), 400);
        }
    }

    public function show($id)
    {
        if (!$issue = Issue::find($id)) {
            return $this->errorResponse('Issue not found', 404);
        }
        return $this->successResponse("Issue Fetched", $issue);
    }

    public function update(UpdateIssueRequest $request, $id)
    {
        //Puede que falle
        if (!$validData = $request->validated()) {
            //errors() puede que no exista, buscar sustituto
            return $this->errorResponse('Validation error.', $request->errors());
        }

        if (!$issue = Issue::find($id)) {
            return $this->errorResponse('Issue not found', 404);
        }
        $old_issue = $issue->toArray();
        $issue->update($validData);
        return $this->successResponse("Issue Updated", [
            'old' => $old_issue,
            'updated' => $issue,
        ]);
    }

    public function destroy($id)
    {
        if (!$issue = Issue::find($id)) {
            return $this->errorResponse('Issue not found', 404);
        }
        $issue->delete();
        return $this->successResponse("Issue Deleted", $issue);
    }
}
