<?php

namespace App\Http\Controllers\JobserviceOwner;

use App\Http\Controllers\Controller;
use App\Models\AllJob;
use App\Models\Employer\Employer;
use App\Models\Employer\EmployerDetail;
use App\Models\JobserviceOwner\JobserviceOwner;
use Exception;
use Illuminate\Http\Request;

class JobserviceOwnerController extends Controller {

    public function getAllStatus() {

        $data = Employer::whereIn( 'status', ['active', 'pending'] )->get();

        $activeStatus = $data->where( 'status', '=', 'active' )->count();
        $pendingStatus = $data->where( 'status', '=', 'pending' )->count();

        return response()->json( ['activeStatus' => $activeStatus, 'pendingStatus' => $pendingStatus] );

    }

    public function getAllCompanyList( Request $request ) {

        $data = EmployerDetail::with( 'employer' )->paginate( 4 );

        $filteredData = $data->map( function ( $item ) {
            return [
                $item->id,
                $item->company_name,
                $item->company_address,
                $item->company_size,
                $item->company_type,
                $item->business_description,
                $item->contactPerson_name,
                $item->contactPerson_email,
                $item->contactPerson_designation,
                $item->company_establishYear,
                $item->employer->status,
                $item->employer_id,
            ];
        } );

        return response()->json( $filteredData );
    }

    public function changeCompanyStatus( Request $request ) {

        try {
            $companyId = $request->input( 'id' );

            Employer::where( 'id', $companyId )->update( ['status' => $request->input( 'status' )] );

            return response()->json( ['status' => 'success', 'message' => 'status updated successfully'] );

        } catch ( Exception $exception ) {
            return response()->json( ['status' => 'failed', 'message' => 'update failed'] );
        }
    }

    public function removeCompany( Request $request ) {

        try {
            $companyId = $request->input( 'id' );

            Employer::where( 'id', $companyId )->delete();

            return response()->json( ['status' => 'success', 'message' => 'Deleted successfully'] );

        } catch ( Exception $exception ) {
            return response()->json( ['status' => 'failed', 'message' => 'Deletion failed'] );
        }

    }

    public function getAllJobsList() {

        $data = AllJob::with( 'employerDetail' )->orderBy( 'created_at', 'desc' )->get();

        $filteredData = $data->map( function ( $item ) {

            return [
                'id'              => $item->id,
                'job_title'       => $item->job_title,
                'job_description' => $item->job_description,
                'job_skills'      => $item->job_skills,
                'job_benefits'    => $item->job_benefits,
                'salary'          => $item->salary,
                'employment_type' => $item->employment_type,
                'location'        => $item->location,
                'deadline'        => $item->deadline,
                'company_name'    => $item->employerDetail->company_name,
                'status'          => $item->status,
            ];
        } );

        return response()->json( $filteredData );
    }


    public function getAllJobsListPaginated() {

        $data = AllJob::with( 'employerDetail' )->orderBy( 'created_at', 'desc' )->paginate(5);

        $filteredData = $data->map( function ( $item ) {

            return [
                'id'              => $item->id,
                'job_title'       => $item->job_title,
                'job_description' => $item->job_description,
                'job_skills'      => $item->job_skills,
                'job_benefits'    => $item->job_benefits,
                'salary'          => $item->salary,
                'employment_type' => $item->employment_type,
                'location'        => $item->location,
                'deadline'        => $item->deadline,
                'company_name'    => $item->employerDetail->company_name,
                'status'          => $item->status,
            ];
        } );

        return response()->json( $filteredData );
    }

    public function getTopCompaniesCount() {
        $topCompanies = AllJob::with( 'employerDetail' )->selectRaw( 'employer_id, COUNT(*) as job_count' )
            ->groupBy( 'employer_id' )
            ->orderBy( 'job_count', 'desc' )
            ->take( 5 )
            ->get();

        $companyNames = $topCompanies->map( function ( $company ) {
            return $company->employerDetail->company_name;
        } );

        return $companyNames;
    }

    public function getJobsDevelopersCount() {
        $developersCount = AllJob::where( 'job_title', 'like', '%developer%' )->count();

        return $developersCount;
    }
    public function getJobsDesignersCount() {
        $designersCount = AllJob::where( 'job_title', 'like', '%designer%' )->count();

        return $designersCount;
    }
    public function getJobsMarketerCount() {
        $marketersCount = AllJob::where( 'job_title', 'like', '%marketer%' )->count();

        return $marketersCount;
    }
    public function getJobsUiUxCount() {
        $marketersCount = AllJob::where( 'job_title', 'like', '%ui/ux%' )->count();

        return $marketersCount;
    }



    public function changePostedJobStatus( Request $request ) {

        $jobId = $request->id;

        $date = date( 'd M Y', time() );

        AllJob::where( 'id', $jobId )->update( ['status' => $request->input( 'status' ), 'published_at' => $date] );

        return response()->json( ['status' => 'success', 'message' => 'Update successfull'] );
    }

    public function removePostedJob( Request $request ) {

        $jobId = $request->id;

        AllJob::where( 'id', $jobId )->delete();

        return response()->json( ['status' => 'success', 'message' => 'Deleted successfully'] );

    }

    public function getPostedJobsCount() {

        $data = AllJob::where( 'status', '=', 'active' )->count();

        return response()->json( $data );
    }

    public function getNewCompaniesCount() {

        $count = Employer::where( 'status', '=', 'pending' )->count();

        return $count;
    }

    public function getNewJobsCount() {

        $count = AllJob::where( 'status', '=', 'pending' )->count();

        return $count;
    }

    public function addEmployee( Request $request ) {

        try {
            $request->validate( [
                'employee_name' => 'required|string|max:50',
                'email'         => 'required|email|max:50|unique:jobservice_owners,email',
                'password'      => 'required|min:6',
                'role_id'       => 'required',
            ] );

            $data = JobserviceOwner::create( [
                'employee_name' => $request->input( 'employee_name' ),
                'email'         => $request->input( 'email' ),
                'password'      => $request->input( 'password' ),
                'role_id'       => $request->input( 'role_id' ),
            ] );

            return response()->json( ['status' => 'success', 'message' => 'New Employee has been created successfully', 'data' => $data] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function changeEmployeeRole( Request $request ) {

        try {
            $employeeId = $request->id;
            $roleId = $request->role_id;

            JobserviceOwner::where( 'id', $employeeId )->update( [
                'role_id' => $roleId,
            ] );

            return response()->json( ['status' => 'success', 'message' => 'Role updated successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => "Update Failed"] );

        }
    }

    public function removeEmployee( Request $request ) {

        try {
            $employeeId = $request->id;

            JobserviceOwner::where( 'id', $employeeId )->delete();

            return response()->json( ['status' => 'success', 'message' => 'Employee has been successfully deleted'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function getAllEmployeeList() {

        try {

            $users = JobserviceOwner::with( 'role' )->where( 'role_id', '<>', '1' )->paginate( 5 );

            $filteredData = $users->map( function ( $item ) {
                return [
                    $item->id,
                    $item->employee_name,
                    $item->role->name,
                ];
            } );

            return $filteredData;

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    //For Jobservice Owner Admin Account
    public function changeAccountPassword( Request $request ) {
        try {

            $request->validate( [
                'password' => 'required|confirmed|min:6',
            ] );

            JobserviceOwner::where( 'role_id', '=', '1' )->update( [
                'password' => $request->input( 'password' ),
            ] );

            return response()->json( ['status' => 'success', 'message' => 'Password has been changed successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }
}
