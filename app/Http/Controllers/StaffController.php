<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::paginate(10);

        if ($staffs->count() <= 0) {

            return response()->json([
                'message' => 'No records found.'
            ], 200);
        }

        return view('admin.staffs.index', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeStaff(Request $request)
    {
        $staff = $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:staff',
            'phone_number' => 'required'
        ]);

        Staff::create($staff);


        return response()->json([
            'message' => 'Successfully added staff',
            'data' => $staff
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function showStaff(Staff $id)
    {
        $staff = Staff::find($id);

        if (!$staff) {

            return response()->json([

                'message' => 'Staff not found'

            ], 404);

        }

        return response()->json([

            'success' => true,
            'data' => $staff

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateStaff(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
