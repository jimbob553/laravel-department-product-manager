<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Validators\DepartmentValidator;





class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {   // Policy authorization
        $this->authorize('viewAny', Department::class);
       //  Get all departments (sorted)
        $departments = Department::orderBy('name')->get();
        
        return response()->json($departments, Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
         $this->authorize('create', Department::class);
            //  Validate incoming data
        $validated = DepartmentValidator::validate($request->all());
        //  Add fields not sent by the API client
        $validated['user_id'] = $request->user()->id;
        //  Create the department --> saved in the database
        $department = Department::create($validated);
        //  Return JSON response with status 201
        return response()->json($department, Response::HTTP_CREATED);


    }

    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        //  Policy authorization
        $this->authorize('view', $department);

        
        return response()->json($department, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $this->authorize('update', $department);
        //  Validate incoming data
        $validated = DepartmentValidator::validate($request->all());

        $department->update($validated);

        return response()->json($department, Response::HTTP_OK);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $this->authorize('delete', $department);

        $department->delete();
        // Return empty 204 response
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}