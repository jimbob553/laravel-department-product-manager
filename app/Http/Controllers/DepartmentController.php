<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

/************************************************************
 *  Controller: DepartmentController
 *  Purpose:    Handles all Department-related views and actions.
 *               - Lists all departments (index)
 *               - Shows a single department and its related products (show)
 *               - Handles create, edit, update, and delete
 *  Notes:
 *   • Routes: /departments, /departments/{department}
 *   • View Files: resources/views/departments/
 *   • Relationships: Department hasMany Products
 ************************************************************/

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Display a listing of departments.
     */
    public function index(Request $request)
    {
        // Everyone can view (policy allows all roles)
        if ($request->user()->cannot('viewAny', Department::class)) {
            abort(403);
        }

        $departments = Department::orderBy('name')->paginate(12);
        return view('departments.index', compact('departments'));
    }

    /**
     * Display a single department and its products.
     */
    public function show(Request $request, Department $department)
    {
        if ($request->user()->cannot('view', $department)) {
            abort(403);
        }

        $products = $department->products()
            ->orderBy('name')
            ->paginate(10)
            ->withQueryString();

        return view('departments.products', compact('department', 'products'));
    }

    /**
     * Show the form for creating a new department.
     * Admins only.
     */
    public function create(Request $request)
    {
        if ($request->user()->cannot('create', Department::class)) {
            abort(403);
        }

        return view('departments.create', ['department' => new Department()]);
    }

    /**
     * Store a newly created department.
     * Admins only.
     */
    public function store(Request $request)
    {
        if ($request->user()->cannot('create', Department::class)) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name',
            'description' => 'nullable|string|max:1000',
        ]);

        $data['user_id'] = $request->user()->id;

        Department::create($data);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department created successfully!');
    }

    /**
     * Show the edit form for an existing department.
     * Admins and managers only.
     */
    public function edit(Request $request, Department $department)
    {
        if ($request->user()->cannot('update', $department)) {
            abort(403);
        }

        return view('departments.edit', compact('department'));
    }

    /**
     * Update an existing department.
     * Admins and managers only.
     */
    public function update(Request $request, Department $department)
    {
        if ($request->user()->cannot('update', $department)) {
            abort(403);
        }

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:departments,name,' . $department->id,
            'description' => 'nullable|string|max:1000',
        ]);

        $department->update($data);

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department updated successfully!');
    }

    /**
     * Delete a department.
     * Admins only.
     */
    public function destroy(Request $request, Department $department)
    {
        if ($request->user()->cannot('delete', $department)) {
            abort(403);
        }

        $department->delete();

        return redirect()
            ->route('departments.index')
            ->with('success', 'Department deleted successfully!');
    }
}
