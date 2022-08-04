<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;

class EmployeeController extends Controller
{
    //Handles the actions of each route or request.
    function index() {
        error_log("Index function is reached");
        return Employee::all();
    }
    
    function add(Request $addedDetails) {
        error_log("Add function is reached");
        error_log($addedDetails->input('firstName'));

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
            error_log($count);
            $array2 = $array2 + [
                "skill_$val" => $skill["skill"],
                "years_of_exp_$val" => $skill["yrsExp"],
                "seniority_rating_$val" => $skill["seniorityRating"]
            ];
        };
        $array = $array1 + $array2;
        //return $array;
        $dbRowsCreated = $employee->insert($array);
        if($dbRowsCreated == 1) {
            return Employee::all();
        } else {
            return ["dbResult"=>"Failed to save."];
        }
    }

    function edit(Request $editDetails) {
        error_log("Edit function is reached!");
        $dbRowsUpdated = Employee::where("employee_id", $editDetails->user_employee_id)->update([
            "first_name" => $editDetails->user_first_name,
            "last_name" => $editDetails->user_last_name,
            "contact_number" => $editDetails->user_contact_number,
            "email_address" => $editDetails->user_email_address,
            "date_of_birth" => $editDetails->user_date_of_birth,
            "street_address" => $editDetails->user_street_address,
            "city" => $editDetails->user_city,
            "postal_code" => $editDetails->user_postal_code,
            "country" => $editDetails->user_country,
            "skill_1" => $editDetails->user_skill_1,
            "years_of_exp_1" => $editDetails->user_years_of_exp_1,
            "seniority_rating_1" => $editDetails->user_seniority_rating_1,
            "skill_2" => $editDetails->user_skill_2,
            "years_of_exp_2" => $editDetails->user_years_of_exp_2,
            "seniority_rating_2" => $editDetails->user_seniority_rating_2,
            "skill_3" => $editDetails->user_skill_3,
            "years_of_exp_3" => $editDetails->user_years_of_exp_3,
            "seniority_rating_3" => $editDetails->user_seniority_rating_3
        ]);
        if($dbRowsUpdated == 1) {
            return Employee::all();
        } else {
            return ["dbResult"=>"failed to update."];
        }
    }

    function delete(Request $deleteDetails) {
        error_log("Delete function is reached!");
        $dbRowsDeleted = Employee::where("employee_id", "=", $deleteDetails->employeeID)->delete();
        if($dbRowsDeleted == 1) {
            return Employee::all();
        } else {
            return ["dbResult"=>"Failed to delete."];
        }
    }

}
