<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    function index() {
        return Employee::all();
    }
    
    function add(Request $addedDetails) {
        $characters = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 2);
        $numbers = mt_rand(1000, 9999);
        $user_id = $characters.$numbers;
        $employee = new Employee;
        $array1 = [
            "employee_id" => $user_id,
            "first_name" => $addedDetails->firstName,
            "last_name" => $addedDetails->lastName,
            "contact_number" => $addedDetails->contactNumber,
            "email_address" => $addedDetails->emailAddress,
            "date_of_birth" => $addedDetails->dateOfBirth,
            "street_address" => $addedDetails->streetAddress,
            "city" => $addedDetails->city,
            "postal_code" => $addedDetails->postalCode,
            "country" => $addedDetails->country
        ];
        $details = $addedDetails->all();
        $count = 0;
        $array2 = [];
        foreach ($details["skills"] as $skill) {
            $count++;
            $val = strval($count);
            $array2 = $array2 + [
                "skill_$val" => $skill["skill"],
                "years_of_exp_$val" => $skill["yrsExp"],
                "seniority_rating_$val" => $skill["seniorityRating"]
            ];
        };
        $array = $array1 + $array2;
        $dbRowsCreated = $employee->insert($array);
        if($dbRowsCreated == 1) {
            return Employee::all();
        } else {
            return ["dbResult"=>"Failed to save."];
        }
    }

    function edit(Request $editDetails) {
        $array1 = [
            "first_name" => $editDetails->firstName_edit,
            "last_name" => $editDetails->lastName_edit,
            "contact_number" => $editDetails->contactNumber_edit,
            "email_address" => $editDetails->emailAddress_edit,
            "date_of_birth" => $editDetails->dateOfBirth_edit,
            "street_address" => $editDetails->streetAddress_edit,
            "city" => $editDetails->city_edit,
            "postal_code" => $editDetails->postalCode_edit,
            "country" => $editDetails->country_edit
        ];
        $updateDetails = $editDetails->all();
        $count = 0;
        $array2 = [];
        foreach ($updateDetails["skills_edit"] as $skill) {
            $count++;
            $val = strval($count);
            $array2 = $array2 + [
                "skill_$val" => $skill["skill"],
                "years_of_exp_$val" => $skill["yrsExp"],
                "seniority_rating_$val" => $skill["seniorityRating"]
            ];
        };
        $array = $array1 + $array2;
        $dbRowsUpdated = Employee::where("employee_id", $editDetails->employee_id)->update($array);
        if($dbRowsUpdated == 1) {
            return Employee::all();
        } else {
            return ["dbResult"=>"failed to update."];
        }
    }

    function delete(Request $deleteDetails) {
        $dbRowsDeleted = Employee::where("employee_id", "=", $deleteDetails->employeeID)->delete();
        if($dbRowsDeleted == 1) {
            return Employee::all();
        } else {
            return ["dbResult"=>"Failed to delete."];
        }
    }

}
