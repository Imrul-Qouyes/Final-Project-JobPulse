<?php

use App\Http\Controllers\Candidate\CandidateDashboardController;
use App\Http\Controllers\Candidate\CandidateLoginController;
use App\Http\Controllers\Candidate\CandidateSocialLoginController;
use App\Http\Controllers\Employer\EmployerDashboardController;
use App\Http\Controllers\Employer\EmployerLoginController;
use App\Http\Middleware\CandidateTokenVerificationMiddleWare;
use App\Http\Middleware\EmployerTokenVerificationMiddleWare;
use App\Http\Middleware\TokenVerificationMiddleWare;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobserviceOwner\JobserviceOwnerBlogController;
use App\Http\Controllers\JobserviceOwner\JobserviceOwnerPageController;
use App\Http\Controllers\JobserviceOwner\JobserviceOwnerPostController;
use App\Http\Controllers\JobserviceOwner\JobserviceOwnerController;
use App\Http\Controllers\Employer\EmployerSocialLoginController;
use App\Http\Controllers\JobserviceOwner\JobserviceOwnerLoginController;

/*
|--------------------------------------------------------------------------
| ALL Web Routes
|--------------------------------------------------------------------------
*/



//=============JobserviceOwner Dashboard Routes================/
Route::get('/dashboard/admin',[JobserviceOwnerController::class,'getAllStatus']);
Route::get('/dashboard/admin/employerList',[JobserviceOwnerController::class,'getAllCompanyList']);
Route::post('/dashboard/admin/employerStatus',[JobserviceOwnerController::class,'changeCompanyStatus']);
Route::post('/dashboard/admin/removeEmployer',[JobserviceOwnerController::class,'removeCompany']);
Route::get('/dashboard/admin/allJobList',[JobserviceOwnerController::class,'getAllJobsListPaginated']);
Route::post('/dashboard/admin/jobStatus',[JobserviceOwnerController::class,'changePostedJobStatus']);
Route::post('/dashboard/admin/removeJob',[JobserviceOwnerController::class,'removePostedJob']);
Route::get('/dashboard/admin/postedJobs',[JobserviceOwnerController::class,'getPostedJobsCount']);
Route::get('/dashboard/admin/newCompanyCount',[JobserviceOwnerController::class,'getNewCompaniesCount']);
Route::get('/dashboard/admin/newJobsCount',[JobserviceOwnerController::class,'getNewJobsCount']);

//============================================================/


//=============JobserviceOwner Dashboard Routes================/

Route::post('/dashboard/admin/addEmployee',[JobserviceOwnerController::class,'addEmployee']);
Route::get('/dashboard/admin/EmployeeList',[JobserviceOwnerController::class,'getAllEmployeeList']);
Route::post('/dashboard/admin/changeEmployeeRole',[JobserviceOwnerController::class,'changeEmployeeRole']);
Route::post('/dashboard/admin/removeEmployee',[JobserviceOwnerController::class,'removeEmployee']);
Route::post('/dashboard/admin/accountSettings',[JobserviceOwnerController::class,'changeAccountPassword']);


//=============================================================/


//==========================JobserviceOwner Login ==============================/
Route::post('admin/login',[JobserviceOwnerLoginController::class,'jobserviceOwnerLogin']);
Route::post('admin/sendOTP',[JobserviceOwnerLoginController::class,'sendOTP']);
Route::post('admin/verifyOTP',[JobserviceOwnerLoginController::class,'verifyOTP']);
Route::post('admin/resetPassword',[JobserviceOwnerLoginController::class,'resetPassword'])->middleware([TokenVerificationMiddleWare::class]);

//=============================================================/


//==================Job service Owner Blog Category======================/

Route::get('/dashboard/admin/allBlogCategory',[JobserviceOwnerBlogController::class,'getAllBlogCategories']);
Route::post('/dashboard/admin/addBlogCategory',[JobserviceOwnerBlogController::class,'createBlogCategories']);
Route::post('/dashboard/admin/updateBlogCategory',[JobserviceOwnerBlogController::class,'updateBlogCategories']);
Route::post('/dashboard/admin/removeBlogCategory',[JobserviceOwnerBlogController::class,'removeBlogCategories']);


//=======================================================================/



//==================Job service Owner Blog Category======================/
Route::post('/dashboard/admin/createBlogPost',[JobserviceOwnerPostController::class,'createBlogPost'])->middleware([TokenVerificationMiddleWare::class]);
Route::post('/dashboard/admin/updateBlogPost',[JobserviceOwnerPostController::class,'updateBlogPost'])->middleware([TokenVerificationMiddleWare::class]);
Route::post('/dashboard/admin/removeBlogPost',[JobserviceOwnerPostController::class,'removeBlogPost'])->middleware([TokenVerificationMiddleWare::class]);
Route::get('/dashboard/admin/allBlogPost',[JobserviceOwnerPostController::class,'getAllBlogPost'])->middleware([TokenVerificationMiddleWare::class]);
Route::get('/dashboard/admin/allPostedBlogs',[JobserviceOwnerPostController::class,'getPostedBlog']);
Route::get('admin/singleBlogPost/{id}',[JobserviceOwnerPostController::class,'getBlogPostById']);

//=======================================================================/



//=============================Home=================================/

Route::get('/dashboard/admin/homePageDetail',[JobserviceOwnerPageController::class,'homePageDetails']);
Route::post('/dashboard/admin/updateHomePage',[JobserviceOwnerPageController::class,'updateHomePage']);
Route::get('/topcompanies',[JobserviceOwnerController::class,'getTopCompaniesCount']);
Route::get('/getJobsDevelopersCount',[JobserviceOwnerController::class,'getJobsDevelopersCount']);
Route::get('/getJobsDesignersCount',[JobserviceOwnerController::class,'getJobsDesignersCount']);
Route::get('/getJobsMarketerCount',[JobserviceOwnerController::class,'getJobsMarketerCount']);
Route::get('/getJobsUiUxCount',[JobserviceOwnerController::class,'getJobsUiUxCount']);
Route::get('/getOtherJobsCount',[JobserviceOwnerController::class,'getOtherJobsCount']);


//=======================================================================/

//===============================Blogs=====================================/
Route::get('/dashboard/admin/blogPageDetail',[JobserviceOwnerPageController::class,'blogPageDetails']);
Route::post('/dashboard/admin/blogPageDetailUpdate',[JobserviceOwnerPageController::class,'updateBlogPage']);
//=======================================================================/


//=============================Jobs========================================/

Route::get('/allPublishedJobs',[JobserviceOwnerController::class,'getAllJobsList']);
//=======================================================================/





//============================Contact Us=====================================/

Route::get('/dashboard/admin/contactUsPageDetail',[JobserviceOwnerPageController::class,'contactUsDetails']);
Route::post('/dashboard/admin/contactUsPageDetailUpdate',[JobserviceOwnerPageController::class,'updateContactDetails']);

//=======================================================================/


//=============================About Us=================================/

Route::get('/dashboard/admin/aboutUsPageDetail',[JobserviceOwnerPageController::class,'aboutPageDetails']);
Route::post('/dashboard/admin/aboutUsPageDetailUpdate',[JobserviceOwnerPageController::class,'updateAboutPage']);

//=======================================================================/



Route::view('/','pages/webpages/home-page')->name('page.home');
Route::view('/about','pages/webpages/about-page')->name('page.about');
Route::view('/allJobs','pages/webpages/alljobs-page')->name('page.alljobs');
Route::view('/contact','pages/webpages/contact-page')->name('page.contact');
Route::view('/blog','pages/webpages/blogs-page')->name('page.blog');




Route::view('/dashboards','pages/jobserviceowner-dashboard-pages/jobserviceowner-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/status','pages/jobserviceowner-dashboard-pages/status-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/allcompanies','pages/jobserviceowner-dashboard-pages/allcompanies-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/alljobs','pages/jobserviceowner-dashboard-pages/alljobs-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/allEmployee','pages/jobserviceowner-dashboard-pages/employee-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/blogCategory','pages/jobserviceowner-dashboard-pages/blogs-category-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/blogPost','pages/jobserviceowner-dashboard-pages/blog-posts-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/webPages/home','pages/jobserviceowner-dashboard-pages/pages-home-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/webPages/blog','pages/jobserviceowner-dashboard-pages/blogpages-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/webPages/contact','pages/jobserviceowner-dashboard-pages/pages-contact-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/webPages/about','pages/jobserviceowner-dashboard-pages/pages-about-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/plugins','pages/jobserviceowner-dashboard-pages/plugins-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);
Route::view('/dashboard/accountSettings','pages/jobserviceowner-dashboard-pages/account-settings-dashboard-page')->middleware([TokenVerificationMiddleWare::class]);


Route::view('/login/jobserviceOwner','pages/jobserviceOwnerLogin-page');
Route::get('/jobserviceOwner/logout',[JobserviceOwnerLoginController::class,'jobserviceOwnerLogout'])->middleware([TokenVerificationMiddleWare::class]);


Route::view('/login/employer','pages/employerLogin-page')->name('employer.login');
Route::view('/dashboard/employer','layout/employer-dashboard')->middleware([EmployerTokenVerificationMiddleWare::class]);
Route::view('/dashboard/employer/status','pages/employer-dashboard-pages/status-dashboard-page')->middleware([EmployerTokenVerificationMiddleWare::class]);
Route::view('/dashboard/employer/jobs','pages/employer-dashboard-pages/jobs-dashboard-page')->middleware([EmployerTokenVerificationMiddleWare::class]);
Route::view('/dashboard/employer/appliedCandidates','pages/employer-dashboard-pages/applied-candidate-list-dashboard-page')->middleware([EmployerTokenVerificationMiddleWare::class]);
Route::view('/dashboard/employer/plugins','pages/employer-dashboard-pages/plugins-dashboard-page')->middleware([EmployerTokenVerificationMiddleWare::class]);
Route::get('/allEmployer',[EmployerLoginController::class,'allEmployer'])->middleware([EmployerTokenVerificationMiddleWare::class]);
Route::get('/logout',[EmployerLoginController::class,'Logout'])->middleware([TokenVerificationMiddleWare::class]);

Route::view('/login/candidate','pages/candidateLogin-page')->name('candidate.login');
Route::get('/allCandidate',[CandidateLoginController::class,'allCandidate'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::view('/dashboard/candidate','layout/candidate-dashboard')->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::view('/dashboard/candidate/status','pages/candidate-dashboard-pages/status-dashboard-page')->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::view('/dashboard/candidate/jobs','pages/candidate-dashboard-pages/jobs-dashboard-page')->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::view('/dashboard/candidate/accountSettings','pages/candidate-dashboard-pages/account-setting-dashboard-page')->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::get('/dashboard/candidate/appliedJobList',[CandidateDashboardController::class,'getAppliedJobList'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::view('/dashboard/candidate/profile','pages/candidate-dashboard-pages/profile-dashboard-page')->middleware([CandidateTokenVerificationMiddleWare::class]);


Route::view('/register/employer','pages/employerReg-page')->name('employer.register');
Route::view('/register/candidate','pages/candidateReg-page')->name('candidate.register');

Route::view('/employer/OTP','pages/employersendOTP-page')->name('employer.otp');
Route::view('/employer/OTPVerify','pages/employerverifyOTP-page');
Route::view('/employer/resetPass','pages/employerResetPass-page');

Route::view('/candidate/OTP','pages/candidatesendOTP-page')->name('candidate.otp');
Route::view('/candidate/OTPVerify','pages/candidateverifyOTP-page');
Route::view('/candidate/resetPass','pages/candidateResetPass-page');





//==========================Employer Google Soical Login===========================/

Route::get('login/google/employer',[EmployerSocialLoginController::class,'googleRedirect'])->name('login.google.employer');
Route::get('login/google/employer/callback',[EmployerSocialLoginController::class,'googleCallback']);

//=======================================================================/


//==========================Employer Normal Login========================/

Route::post('/employerSignup',[EmployerLoginController::class,'employerSignup']);
Route::post('/employerLogin',[EmployerLoginController::class,'employerLogin']);
Route::post('/employerDetails',[EmployerLoginController::class,'employerDetails']);
Route::post('/employer/sendOTP',[EmployerLoginController::class,'sendOTP']);
Route::post('/employer/verifyOTP',[EmployerLoginController::class,'verifyOTP']);
Route::post('/employer/resetPassword',[EmployerLoginController::class,'resetPassword'])->middleware([TokenVerificationMiddleWare::class]);
//=======================================================================/


//==========================Employer dashboard Routes=======================/

Route::post('/dashboard/employer/createJob',[EmployerDashboardController::class,'createJobs'])->middleware([TokenVerificationMiddleWare::class]);
Route::get('/dashboard/employer/postedJobs',[EmployerDashboardController::class,'getPostedJobCount'])->middleware([TokenVerificationMiddleWare::class]);
Route::get('/dashboard/employer/jobList',[EmployerDashboardController::class,'getJobList'])->middleware([EmployerTokenVerificationMiddleWare::class]);
Route::post('/dashboard/employer/deleteJob',[EmployerDashboardController::class,'removeJob']);
Route::post('/dashboard/employer/candiateCount',[EmployerDashboardController::class,'appliedCandidateCount'])->middleware([TokenVerificationMiddleWare::class]);
Route::post('/dashboard/employer/appliedCandiateList',[EmployerDashboardController::class,'getAppliedCandidateList'])->middleware([TokenVerificationMiddleWare::class]);
Route::post('/dashboard/employer/candidateCVDetails',[EmployerDashboardController::class,'getCVDetails']);
Route::get('/dashboard/employer/candiateCVList',[EmployerDashboardController::class,'getJobCandidatesCV']);
Route::post('/dashboard/employer/selectCandidate',[EmployerDashboardController::class,'selectCandidate']);
Route::post('/dashboard/employer/selectedCandidateList',[EmployerDashboardController::class,'getSelectedCandidateList']);
Route::post('/dashboard/employer/rejectCandidate',[EmployerDashboardController::class,'rejectCandidate']);

//=========================================================================/

//==========================Candidate Google Soical Login===========================/

Route::get('login/google/candiate',[CandidateSocialLoginController::class,'googleRedirect'])->name('login.google.candidate');
Route::get('login/google/candidate/callback',[CandidateSocialLoginController::class,'googleCallback']);

//=======================================================================/


//==========================Candiate Normal Login========================/

Route::post('/candidateSignup',[CandidateLoginController::class,'candidateSignup']);
Route::post('/candidateLogin',[CandidateLoginController::class,'candidateLogin']);
Route::post('/candidate/sendOTP',[CandidateLoginController::class,'sendOTP']);
Route::post('/candidate/verifyOTP',[CandidateLoginController::class,'verifyOTP']);
Route::post('/candidate/resetPassword',[CandidateLoginController::class,'resetPassword'])->middleware([TokenVerificationMiddleWare::class]);
Route::get('/candidate/logout',[CandidateLoginController::class,'candidateLogout'])->middleware([TokenVerificationMiddleWare::class]);

//=======================================================================/


//=====================Candidate dashboard===============================/

Route::get('/dashboard/candidate/appliedJobCount',[CandidateDashboardController::class,'getAppliedJobCount'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::post('/dashboard/candidate/createBasicInfo',[CandidateDashboardController::class,'createBasicInfo'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::post('/dashboard/candidate/updateBasicInfo',[CandidateDashboardController::class,'updateBasicInfo'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::get('/dashboard/candidate/cvDetails',[CandidateDashboardController::class,'getCVDetails'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::get('/dashboard/candidate/profileDetails',[CandidateDashboardController::class,'getProfileDetails'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::post('/dashboard/candidate/updateprofileDetails',[CandidateDashboardController::class,'updateProfileDetails'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::get('/candidate/checkLogin',[CandidateDashboardController::class,'checkLoginToApplyAnJob']);
Route::post('/candidate/applyJob',[CandidateDashboardController::class,'applyJob'])->middleware([CandidateTokenVerificationMiddleWare::class]);
Route::get('/candidate/appliedJobList',[CandidateDashboardController::class,'getAppliedJobList'])->middleware([CandidateTokenVerificationMiddleWare::class]);


//=======================================================================/



