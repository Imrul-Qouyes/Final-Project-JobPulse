<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\CandidateAppliedJob;
use App\Models\Candidate\Candidate;
use App\Models\Candidate\CandidateBasicInformation;
use App\Models\Candidate\CandidateEducationDetail;
use App\Models\Candidate\CandidateExperienceDetail;
use App\Models\Candidate\CandidateSkillAndSalary;
use App\Models\Candidate\CandidateTrainingDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CandidateDashboardController extends Controller {
    public function createBasicInfo( Request $request ) {

        $candidateId = $request->header( 'id' );
        try {
            $request->validate( [
                'full_name'            => 'required|string',
                'father_name'          => 'required|string',
                'mother_name'          => 'required|string',
                'date_of_birth'        => 'required|string',
                'nid'                  => 'required|string',
                'cellphone_no'         => 'required|string',
                'emergency_contact_no' => 'required|string',
                'email'                => 'required|email',
                'linkedin_link'        => 'required|string',
                'skills'               => 'required|string',
                'expected_salary'      => 'required|string',
            ] );

            CandidateBasicInformation::Create(
                [
                    'full_name'               => $request->input( 'full_name' ),
                    'father_name'             => $request->input( 'father_name' ),
                    'mother_name'             => $request->input( 'mother_name' ),
                    'date_of_birth'           => $request->input( 'date_of_birth' ),
                    'blood_group'             => $request->input( 'blood_group' ),
                    'nid'                     => $request->input( 'nid' ),
                    'passport_no'             => $request->input( 'passport_no' ),
                    'cellphone_no'            => $request->input( 'cellphone_no' ),
                    'emergency_contact_no'    => $request->input( 'emergency_contact_no' ),
                    'email'                   => $request->input( 'email' ),
                    'whatsapp_no'             => $request->input( 'whatsapp_no' ),
                    'linkedin_link'           => $request->input( 'linkedin_link' ),
                    'fb_id'                   => $request->input( 'fb_id' ),
                    'github_link'             => $request->input( 'github_link' ),
                    'behance_or_dribble_link' => $request->input( 'behance_or_dribble_link' ),
                    'portfolio_link'          => $request->input( 'portfolio_link' ),
                    'candidate_id'            => $candidateId,
                ] );

            $educationDetails = [];

            for ( $i = 1; $i <= 3; $i++ ) {
                $educationDetails[] = [
                    'degree_type'           => $request->input( 'degree_type_' . $i ),
                    'education_institution' => $request->input( 'education_institution_' . $i ),
                    'department'            => $request->input( 'department_' . $i ),
                    'passing_year'          => $request->input( 'passing_year_' . $i ),
                    'result'                => $request->input( 'result_' . $i ),
                    'candidate_id'          => $candidateId,
                ];
            }

            CandidateEducationDetail::insert( $educationDetails );

            $trainingDetails = [];

            for ( $i = 1; $i <= 3; $i++ ) {

                $trainingDetails[] = [
                    'training_name'        => $request->input( 'training_name_' . $i ),
                    'training_institution' => $request->input( 'training_institution_' . $i ),
                    'completion_year'      => $request->input( 'completion_year_' . $i ),
                    'candidate_id'         => $candidateId,
                ];
            }

            CandidateTrainingDetail::insert( $trainingDetails );

            $experienceDetails = [];

            for ( $i = 1; $i <= 3; $i++ ) {

                $experienceDetails[] = [
                    'designation'    => $request->input( 'designation' . $i ),
                    'company_name'   => $request->input( 'company_name' . $i ),
                    'join_date'      => $request->input( 'join_date' . $i ),
                    'deperture_date' => $request->input( 'deperture_date' . $i ),
                    'candidate_id'   => $candidateId,
                ];
            }

            CandidateExperienceDetail::insert( $experienceDetails );

            CandidateSkillAndSalary::create( [
                'skills'          => $request->input( 'skills' ),
                'current_salary'  => $request->input( 'current_salary' ),
                'expected_salary' => $request->input( 'expected_salary' ),
                'candidate_id'    => $candidateId,
            ] );

            return response()->json( ['status' => 'success', 'message' => 'Basic Information created successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }
    }

    public function updateBasicInfo( Request $request ) {

        $candidateId = $request->header( 'id' );

        try {

            CandidateBasicInformation::where( 'id', '=', $request->input( 'general_id' ) )->update( [
                'full_name'               => $request->input( 'full_name' ),
                'father_name'             => $request->input( 'father_name' ),
                'mother_name'             => $request->input( 'mother_name' ),
                'date_of_birth'           => $request->input( 'date_of_birth' ),
                'blood_group'             => $request->input( 'blood_group' ),
                'nid'                     => $request->input( 'nid' ),
                'passport_no'             => $request->input( 'passport_no' ),
                'cellphone_no'            => $request->input( 'cellphone_no' ),
                'emergency_contact_no'    => $request->input( 'emergency_contact_no' ),
                'email'                   => $request->input( 'email' ),
                'whatsapp_no'             => $request->input( 'whatsapp_no' ),
                'linkedin_link'           => $request->input( 'linkedin_link' ),
                'fb_id'                   => $request->input( 'fb_id' ),
                'github_link'             => $request->input( 'github_link' ),
                'behance_or_dribble_link' => $request->input( 'behance_or_dribble_link' ),
                'portfolio_link'          => $request->input( 'portfolio_link' ),
            ] );

            CandidateEducationDetail::where( 'id', $request->input( 'degree_id_1' ) )->update( [
                'degree_type'           => $request->input( 'degree_type_1' ),
                'education_institution' => $request->input( 'education_institution_1' ),
                'department'            => $request->input( 'department_1' ),
                'passing_year'          => $request->input( 'passing_year_1' ),
                'result'                => $request->input( 'result_1' ),
                'candidate_id'          => $candidateId,
            ] );
            CandidateEducationDetail::where( 'id', $request->input( 'degree_id_2' ) )->update( [
                'degree_type'           => $request->input( 'degree_type_2' ),
                'education_institution' => $request->input( 'education_institution_2' ),
                'department'            => $request->input( 'department_2' ),
                'passing_year'          => $request->input( 'passing_year_2' ),
                'result'                => $request->input( 'result_2' ),
                'candidate_id'          => $candidateId,
            ] );
            CandidateEducationDetail::where( 'id', $request->input( 'degree_id_3' ) )->update( [
                'degree_type'           => $request->input( 'degree_type_3' ),
                'education_institution' => $request->input( 'education_institution_3' ),
                'department'            => $request->input( 'department_3' ),
                'passing_year'          => $request->input( 'passing_year_3' ),
                'result'                => $request->input( 'result_3' ),
                'candidate_id'          => $candidateId,
            ] );

            CandidateTrainingDetail::where( 'id', $request->input( 'training_id_1' ) )->update( [
                'training_name'        => $request->input( 'training_name_1' ),
                'training_institution' => $request->input( 'training_institution_1' ),
                'completion_year'      => $request->input( 'completion_year_1' ),
                'candidate_id'         => $candidateId,
            ] );
            CandidateTrainingDetail::where( 'id', $request->input( 'training_id_2' ) )->update( [
                'training_name'        => $request->input( 'training_name_2' ),
                'training_institution' => $request->input( 'training_institution_2' ),
                'completion_year'      => $request->input( 'completion_year_2' ),
                'candidate_id'         => $candidateId,
            ] );
            CandidateTrainingDetail::where( 'id', $request->input( 'training_id_3' ) )->update( [
                'training_name'        => $request->input( 'training_name_3' ),
                'training_institution' => $request->input( 'training_institution_3' ),
                'completion_year'      => $request->input( 'completion_year_3' ),
                'candidate_id'         => $candidateId,
            ] );

            CandidateExperienceDetail::where( 'id', $request->input( 'designation_id_1' ) )->update( [
                'designation'    => $request->input( 'designation1' ),
                'company_name'   => $request->input( 'company_name1' ),
                'join_date'      => $request->input( 'join_date1' ),
                'deperture_date' => $request->input( 'deperture_date1' ),
                'candidate_id'   => $candidateId,

            ] );
            CandidateExperienceDetail::where( 'id', $request->input( 'designation_id_2' ) )->update( [
                'designation'    => $request->input( 'designation2' ),
                'company_name'   => $request->input( 'company_name2' ),
                'join_date'      => $request->input( 'join_date2' ),
                'deperture_date' => $request->input( 'deperture_date2' ),
                'candidate_id'   => $candidateId,

            ] );
            CandidateExperienceDetail::where( 'id', $request->input( 'designation_id_3' ) )->update( [
                'designation'    => $request->input( 'designation3' ),
                'company_name'   => $request->input( 'company_name3' ),
                'join_date'      => $request->input( 'join_date3' ),
                'deperture_date' => $request->input( 'deperture_date3' ),
                'candidate_id'   => $candidateId,

            ] );


            CandidateSkillAndSalary::where( 'id', $request->input( 'skills_id' ) )->update( [
                'skills'          => $request->input( 'skills' ),
                'current_salary'  => $request->input( 'current_salary' ),
                'expected_salary' => $request->input( 'expected_salary' ),

            ] );

            return response()->json( ['status' => 'success', 'message' => 'update is successfull'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }

    }

    public function getCVDetails( Request $request ) {

        $candidateId = $request->header( 'id' );
        $candidateImgUrl = Candidate::where( 'id', $candidateId )->select( 'image_url' )->get();
        $basicData = CandidateBasicInformation::where( 'candidate_id', $candidateId )->get();
        $eduData = CandidateEducationDetail::where( 'candidate_id', $candidateId )->get();
        $trainingData = CandidateTrainingDetail::where( 'candidate_id', $candidateId )->get();
        $experiencData = CandidateExperienceDetail::where( 'candidate_id', $candidateId )->get();
        $skillData = CandidateSkillAndSalary::where( 'candidate_id', $candidateId )->get();

        return response()->json( ['candidateImage'=>$candidateImgUrl ,'basicData' => $basicData, 'eduData' => $eduData, 'traniningData' => $trainingData, 'experienceData' => $experiencData, 'skillData' => $skillData] );
    }

    public function getProfileDetails( Request $request ) {

        $candidateId = $request->header( 'id' );
        $profileDetail = Candidate::where( 'id', '=', $candidateId )->first();

        return response()->json( $profileDetail );
    }

    public function updateProfileDetails( Request $request ) {

        $candidateId = $candidateId = $request->header( 'id' );

        try {
            

            $data = Candidate::where( 'id', '=', $candidateId )->first();

            if ( $data->password != $request->input( 'current_password' ) ) {

                return response()->json( ['status' => 'failed', 'message' => 'Current password did not matched'] );

            } else {
               

                if ( $request->hasFile( 'image' ) ) {

                    $request->validate( [
                        'firstname' => 'required|string',
                        'lastname'  => 'required|string',
                        'password'  => 'required|confirmed|min:6',
                        'image'     => 'image|mimes:jpg,jpeg,png,svg|max:2048',
                    ] );

                    $image = $request->file( 'image' );
                    $time = time();
                    $file_name = $image->getClientOriginalName();
                    $image_name = "candidate-{$time}-{$file_name}";

                    $image_url = "uploads/candidateImage/{$image_name}";

                    $image->move( public_path( 'uploads/candidateImage' ), $image_name );
                    File::delete( $request->input( 'file_path' ) );

                    Candidate::where( 'id', '=', $candidateId )->update( [
                        'firstname' => $request->input( 'firstname' ),
                        'lastname'  => $request->input( 'lastname' ),
                        'password'  => $request->input( 'password' ),
                        'image_url' => $image_url,
                    ] );

                    return response()->json( ['status' => 'success', 'message' => 'Profile Update is successfull'] );

                } else {

                    Candidate::where( 'id', '=', $candidateId )->update( [
                        'firstname' => $request->input( 'firstname' ),
                        'lastname'  => $request->input( 'lastname' ),
                        'password'  => $request->input( 'password' ),
                    ] );

                    return response()->json( ['status' => 'success', 'message' => 'Profile Update is successfull'] );
                }
            }

        } catch ( Exception $exception ) {
            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }

    }

    public function checkLoginToApplyAnJob( Request $request ) {
        $candidateId = $request->header( 'id' );
        $count = Candidate::where( 'id', $candidateId )->count();

        if ( $count == 0 ) {
            return response()->json( ['status' => 'failed'] );
        } else if ( $count == 1 ) {
            return response()->json( ['status' => 'success'] );
        }
    }

    public function applyJob( Request $request ) {

        $candidateId = $request->header( 'id' );

        $date = date( 'd M Y', time() );

        CandidateAppliedJob::create( [
            'job_id'       => $request->input( 'job_id' ),
            'candidate_id' => $candidateId,
            'applied_date' => $date,
            'selection_status' => 'pending'
        ] );

        return response()->json( ['status' => 'success', 'message' => 'Successfully Applied'] );

    }

    public function getAppliedJobList( Request $request ) {

        $candidateId = $request->header( 'id' );

        $data = CandidateAppliedJob::with( 'allJobs' )->where( 'candidate_id', '=', $candidateId )->paginate( 5 );

        return response()->json( $data );

    }

    public function getAppliedJobCount( Request $request ) {

        $candidateId = $request->header( 'id' );

        $count = CandidateAppliedJob::where( 'candidate_id', '=', $candidateId )->count();

        return $count;

    }

}
