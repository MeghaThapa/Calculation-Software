<?php

namespace App\Http\Controllers;
use App\Models\Staff;

use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function index(){
        $staff=Staff::all();
        $response=[
            "status"=>true,
            "message"=>"Staff created successfully",
            "staff"=>$staff,
        ];
        return response($response,200);

    }
    public function toggleEdit(Request $request,$id){
        $staff=Staff::find($id);
        $staff->status= $request->flag;
        $staff->save();
        $response=[
            "status"=>true,
            "message"=>"toggled successfully",
            "staff"=>$staff,
        ];
        return response($response,201);


    }
    public function editStaffSave(Request $request,$id){
        $staff=Staff::find($id);
        $staff->createUpdate($request);
        $response=[
            "status"=>true,
            "message"=>"Staff edited successfully",
            "staff"=>$staff,
        ];
        return response($response,201);

    }
    public function deleteStaff($id){
        $staff=Staff::find($id);
        $staff->delete();
        $response=[
            "status"=>true,
            "message"=>"staff deleted successfully",
            "staff"=>$staff,
        ];
        return response($response,200);
    }

    public function editStaff($id){
            $staff=Staff::find($id); //Edited By Saugat old(Staff::where()) to new(Staff::find())
            $response=[
                "status"=> true,
                "message"=>"data received",
                "staff"=>$staff
            ];
            return response($response,200);
    }

    public  function create(Request $request){

        $staff=new Staff();
        $staff->createUpdate($request);

        $response=[
            "status"=>true,
            "message"=>"Staff created successfully",
            "staff"=>$staff,
        ];
        return response($response,201);

    }
}
