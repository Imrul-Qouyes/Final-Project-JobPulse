<?php

namespace App\Http\Controllers\Employer;

use App\Http\Controllers\Controller;
use App\Models\AllJob;
use App\Models\CandidateAppliedJob;
use App\Models\Candidate\Candidate;
use App\Models\Candidate\CandidateBasicInformation;
use App\Models\Candidate\CandidateEducationDetail;
use App\Models\Candidate\CandidateExperienceDetail;
use App\Models\Candidate\CandidateSkillAndSalary;
use App\Models\Candidate\CandidateTrainingDetail;
use Exception;
use Illuminate\Http\Request;

class EmployerDashboardController extends Controller {

    public function createJobs( Request $request ) {

        $employerId = $request->header( 'id' );

        try {

            $request->validate( [
                'job_title'       => 'required|string',
                'job_description' => 'required',
                'job_skills'      => 'required|string',
                'job_benefits'    => 'required|string',
                'salary'          => 'required|string',
                'employment_type' => 'required',
                'location'        => 'required|string',
                'deadline'        => 'required|string',
            ] );

            AllJob::create( [
                'job_title'       => $request->input( 'job_title' ),
                'job_description' => $request->input( 'job_description' ),
                'job_skills'      => $request->input( 'job_skills' ),
                'job_benefits'    => $request->input( 'job_benefits' ),
                'salary'          => $request->input( 'salary' ),
                'employment_type' => $request->input( 'employment_type' ),
                'location'        => $request->input( 'location' ),
                'deadline'        => $request->input( 'deadline' ),
                'employer_id'     => $employerId,
            ] );

            return response()->json( ['status' => 'success', 'message' => 'Job created successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }
    }

    public function getJobList( Request $request ) {

        $employerId = $request->header( 'id' );

        $data = AllJob::where( 'employer_id', $employerId )->where( 'status', '=', 'active' )->paginate( 5 );

        return response()->json( $data );
    }

    public function getPostedJobCount( Request $request ) {

        $employerId = $request->header( 'id' );

        $count = AllJob::where( 'employer_id', $employerId )->where( 'status', '=', 'active' )->count();

        return response()->json( $count );

    }

    public function removeJob( Request $request ) {
        try {
            $job_id = $request->id;

            AllJob::where( 'id', $job_id )->delete();

            return response()->json( [
                'status'  => 'success',
                'message' => 'Job deleted successfully',
            ] );

        } catch ( Exception $exception ) {
            return response()->json( [
                'status'  => 'failed',
                'message' => 'Job deletion Failed!',
            ] );
        }
    }

    public function appliedCandidateCount( Request $request ) {

        $job_id = $request->id;

        $data = CandidateAppliedJob::where( 'job_id', '=', $job_id )->get();

        return response()->json( $data->count() );
    }

    public function getAppliedCandidateList( Request $request ) {

        $job_id = $request->id;

        $data = CandidateAppliedJob::with( 'candidates' )->where( 'job_id', $job_id )->where( 'selection_status', 'pending' )->paginate( 5 );

        return response()->json( $data );
    }

    public function getCVDetails( Request $request ) {

        $candidateId = $request->id;
        $candidateImgUrl = Candidate::where( 'id', $candidateId )->select( 'image_url' )->get();
        $basicData = CandidateBasicInformation::where( 'candidate_id', $candidateId )->get();
        $eduData = CandidateEducationDetail::where( 'candidate_id', $candidateId )->get();
        $trainingData = CandidateTrainingDetail::where( 'candidate_id', $candidateId )->get();
        $experiencData = CandidateExperienceDetail::where( 'candidate_id', $candidateId )->get();
        $skillData = CandidateSkillAndSalary::where( 'candidate_id', $candidateId )->get();

        return response()->json( ['candidateImgUrl' => $candidateImgUrl, 'basicInfo' => $basicData, 'eduInfo' => $eduData, 'trainingInfo' => $trainingData, 'experienceInfo' => $experiencData, 'skills' => $skillData] );
    }

    public function selectCandidate( Request $request ) {

        try {

            $applied_id = $request->applied_id;

            CandidateAppliedJob::where( 'id', $applied_id )->update( ['selection_status' => 'selected'] );

            return response()->json( ['status' => 'success', 'message' => 'Candidate selected Successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => 'Failed!'] );
        }
    }

    public function getSelectedCandidateList( Request $request ) {

        $job_id = $request->id;

        $data = CandidateAppliedJob::with( 'candidates' )->where( 'job_id', $job_id )->where( 'selection_status', 'selected' )->paginate( 5 );

        return response()->json( $data );
    }

    public function rejectCandidate( Request $request ) {

        try {

            $appliedId = $request->id;

            CandidateAppliedJob::where( 'id', $appliedId )->delete();

            return response()->json( ['status' => 'success', 'message' => 'Candidate rejected Successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'Failed', 'message' => 'Failed!'] );
        }

    }

}
