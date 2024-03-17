<?php

namespace App\Http\Controllers\JobserviceOwner;

use App\Http\Controllers\Controller;
use App\Models\JobserviceOwner\AboutPageDetail;
use App\Models\JobserviceOwner\BlogPageDetail;
use App\Models\JobserviceOwner\ContactPageDetail;
use App\Models\JobserviceOwner\HomePageDetail;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class JobserviceOwnerPageController extends Controller {

    public function homePageDetails() {

        $data = HomePageDetail::get();

        return response()->json( $data );
    }

    public function updateHomePage( Request $request ) {

        try {

            $homeDetailsId = $request->id;

            if ( $request->hasFile( 'logo_image' ) ) {

                $request->validate( [
                    'logo_title'   => 'required|string',
                    'hero_title'   => 'required|string',
                    'hero_details' => 'required|string',
                    'logo_image'   => 'image|mimes:jpeg,jpg,png,svg|max:2048',
                ] );

                $time = time();
                // For Logo image
                $logoImage = $request->file( 'logo_image' );
                $logofile_name = $logoImage->getClientOriginalName();
                $logo_image_name = "logo-photo-{$time}-{$logofile_name}";

                $logo_image_url = "uploads/pagesPhoto/home/logo/{$logo_image_name}";

                $logoImage->move( public_path( 'uploads/pagesPhoto/home/logo' ), $logo_image_url );

                File::delete( $request->input( 'logo_file_path' ) );

                HomePageDetail::where( 'id', $homeDetailsId )->update( [
                    'logo_title'     => $request->input( 'logo_title' ),
                    'hero_title'     => $request->input( 'hero_title' ),
                    'hero_details'   => $request->input( 'hero_details' ),
                    'logo_image_url' => $logo_image_url,

                ] );

            } else if ( $request->hasFile( 'hero_image' ) ) {

                $request->validate( [
                    'logo_title'   => 'required|string',
                    'hero_title'   => 'required|string',
                    'hero_details' => 'required|string',
                    'hero_image'   => 'image|mimes:jpeg,jpg,png,svg|max:2048',
                ] );

                //For Hero Image
                $time = time();
                $heroImage = $request->file( 'hero_image' );
                $herofile_name = $heroImage->getClientOriginalName();
                $hero_image_name = "hero-photo-{$time}-{$herofile_name}";

                $hero_image_url = "uploads/pagesPhoto/home/hero/{$hero_image_name}";

                $heroImage->move( public_path( 'uploads/pagesPhoto/home/hero' ), $hero_image_url );

                File::delete( $request->input( 'hero_file_path' ) );

                HomePageDetail::where( 'id', $homeDetailsId )->update( [
                    'logo_title'     => $request->input( 'logo_title' ),
                    'hero_title'     => $request->input( 'hero_title' ),
                    'hero_details'   => $request->input( 'hero_details' ),
                    'hero_image_url' => $hero_image_url,

                ] );

            } else {

                HomePageDetail::where( 'id', $homeDetailsId )->update( [
                    'logo_title'   => $request->input( 'logo_title' ),
                    'hero_title'   => $request->input( 'hero_title' ),
                    'hero_details' => $request->input( 'hero_details' ),

                ] );
            }

            return response()->json( ['status' => 'success', 'message' => 'Saved Successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function blogPageDetails() {

        $data = BlogPageDetail::get();

        return response()->json( $data );
    }

    public function updateBlogPage( Request $request ) {

        try {

            $blogDetailsId = $request->id;

            if ( $request->hasFile( 'blog_banner_image' ) ) {

                $request->validate( [
                    'blog_title'        => 'required|string',
                    'blog_banner_image' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
                ] );

                $time = time();
                $blog_banner_image = $request->file( 'blog_banner_image' );
                $file_name = $blog_banner_image->getClientOriginalName();
                $image_name = "blog-banner-photo-{$time}-{$file_name}";

                $image_url = "uploads/pagesPhoto/blogs/{$image_name}";

                $blog_banner_image->move( public_path( 'uploads/pagesPhoto/blogs' ), $image_name );

                File::delete( $request->input( 'blog_banner_image_file_path' ) );

                BlogPageDetail::where( 'id', $blogDetailsId )->update( [
                    'blog_title'      => $request->input( 'blog_title' ),
                    'blog_banner_url' => $image_url,
                ] );

            } else {

                BlogPageDetail::where( 'id', $blogDetailsId )->update( [
                    'blog_title' => $request->input( 'blog_title' ),
                ] );
            }

            return response()->json( ['status' => 'success', 'message' => 'Update is Successfull'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function aboutPageDetails() {

        $data = AboutPageDetail::get();

        return response()->json( $data );
    }

    public function updateAboutPage( Request $request ) {

        try {

            $aboutDetailsId = $request->id;
           

            if ( $request->hasFile( 'aboutus_image' ) ) {

                $request->validate( [
                    'title'           => 'required|string',
                    'company_mission' => 'required|string',
                    'company_vision'  => 'required|string',
                    'company_history' => 'required|string',
                    'aboutus_image'   => 'image|mimes:jpeg,jpg,png,svg|max:2048',
                ] );

                $time = time();
                $aboutUsimage = $request->file( 'aboutus_image' );
                $file_name = $aboutUsimage->getClientOriginalName();
                $image_name = "aboutus-banner-photo-{$time}-{$file_name}";

                $image_url = "uploads/pagesPhoto/aboutUs/{$image_name}";

                $aboutUsimage->move( public_path( 'uploads/pagesPhoto/aboutUs' ), $image_name );

                File::delete( $request->input( 'aboutus_file_path' ) );

                AboutPageDetail::where( 'id', $aboutDetailsId )->update( [
                    'title'           => $request->input( 'title' ),
                    'company_mission' => $request->input( 'company_mission' ),
                    'company_vision'  => $request->input( 'company_vision' ),
                    'company_history' => $request->input( 'company_history' ),
                    'image_url'       => $image_url,

                ] );

            } else {

                AboutPageDetail::where( 'id', $aboutDetailsId )->update( [
                    'title'           => $request->input( 'title' ),
                    'company_mission' => $request->input( 'company_mission' ),
                    'company_vision'  => $request->input( 'company_vision' ),
                    'company_history' => $request->input( 'company_history' ),

                ] );
            }

            return response()->json( ['status' => 'success', 'message' => 'Update is Successfull'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function contactUsDetails() {

        $data = ContactPageDetail::get();

        return response()->json( $data );
    }

    public function updateContactDetails( Request $request ) {

        $contactDetailsId = $request->id;

        try {

            if ( $request->hasFile( 'contact_banner_image' ) ) {

                $request->validate( [
                    'contact_title'        => 'required|string',
                    'address'              => 'required',
                    'phone'                => 'required|string',
                    'telephone'            => 'required|string',
                    'email'                => 'required|email',
                    'contact_banner_image' => 'image|mimes:jpeg,jpg,png,svg|max:2048',
                ] );

                $time = time();
                $contactimage = $request->file( 'contact_banner_image' );
                $file_name = $contactimage->getClientOriginalName();
                $image_name = "contact-banner-photo-{$time}-{$file_name}";

                $image_url = "uploads/pagesPhoto/contact/{$image_name}";

                $contactimage->move( public_path( 'uploads/pagesPhoto/contact' ), $image_name );

                File::delete( $request->input( 'contact_banner_image_file_path' ) );

                ContactPageDetail::where( 'id', $contactDetailsId )->update( [
                    'contact_title' => $request->input( 'contact_title' ),
                    'address'       => $request->input( 'address' ),
                    'phone'         => $request->input( 'phone' ),
                    'telephone'     => $request->input( 'telephone' ),
                    'email'         => $request->input( 'email' ),
                    'image_url'     => $image_url,
                ] );

            } else {

                ContactPageDetail::where( 'id', $contactDetailsId )->update( [
                    'contact_title' => $request->input( 'contact_title' ),
                    'address'       => $request->input( 'address' ),
                    'phone'         => $request->input( 'phone' ),
                    'telephone'     => $request->input( 'telephone' ),
                    'email'         => $request->input( 'email' ),
                ] );

            }

            return response()->json( ['status' => 'success', 'message' => 'Update is Successfull'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }
}
