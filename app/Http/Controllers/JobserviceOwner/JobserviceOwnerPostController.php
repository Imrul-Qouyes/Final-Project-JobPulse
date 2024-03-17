<?php

namespace App\Http\Controllers\JobserviceOwner;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\JobserviceOwner\JobserviceownerBlogPost;

class JobserviceOwnerPostController extends Controller {

    public function createBlogPost( Request $request ) {

        try {

            $userId = $request->header('id');
            
            $request->validate( [
                'title'   => 'required|string',
                'content' => 'required',
                'blog_image'   => 'image|mimes:jpeg,png,jpg,svg|max:2048',
            ] );

            if ( $request->hasFile( 'blog_image' ) ) {

                $image = $request->file( 'blog_image' );

                $time = time();
                $file_name = $image->getClientOriginalName();
                $image_name = "blog-posts-image-{$time}-{$file_name}";

                $image_url = "uploads/blogPostImages/{$image_name}";

                $image->move( public_path( 'uploads/blogPostImages' ), $image_name );
            }

            JobserviceownerBlogPost::create( [
                'title'       => $request->input( 'title' ),
                'content'     => $request->input( 'content' ),
                'image'       => $image_url,
                'category_id' => $request->input( 'category_id' ),
                'user_id'     => $userId,
            ] );

            return response()->json( ['status' => 'success', 'message' => 'Post created Successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function updateBlogPost( Request $request ) {

        try {

            $postId = $request->id;
            $blogPost = JobserviceownerBlogPost::find( $postId );

            if ( !$blogPost ) {

                return response()->json( ['status' => 'failed', 'message' => 'Blog post not found'] );

            }           

           

            if ( $request->hasFile( 'blog_image' ) ) {

                $request->validate( [
                    'title'   => 'required|string',
                    'content' => 'required',
                    'blog_image'   => 'image|mimes:jpeg,jpg,png,svg|max:2048|nullable',
                ] );

                $image = $request->file( 'blog_image' );

                $time = time();
                $file_name = $image->getClientOriginalName();
                $image_name = "blog-posts-image-{$time}-{$file_name}";

                $image_url = "uploads/blogPostImages/{$image_name}";

                $image->move( public_path( 'uploads/blogPostImages' ), $image_name );
                File::delete( $request->input( 'file_path' ) );

                JobserviceownerBlogPost::where( 'id', $postId )->update( [
                    'title'   => $request->input( 'title' ),
                    'content' => $request->input( 'content' ),
                    'image'   => $image_url,
                    'status'  => $request->input( 'status' ),
                ] );

                return response()->json( ['status' => 'success', 'message' => 'Post Updated Successfully'] );

            } else {

                JobserviceownerBlogPost::where( 'id', $postId )->update( [
                    'title'   => $request->input( 'title' ),
                    'content' => $request->input( 'content' ),
                    'status'  => $request->input( 'status' ),
                ] );

                return response()->json( ['status' => 'success', 'message' => 'Post Updated Successfully'] );
            }

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function removeBlogPost( Request $request ) {

        try {

            $postId = $request->id;

            JobserviceownerBlogPost::where( 'id', $postId )->delete();
            File::delete( $request->input( 'file_path' ) );

            return response()->json( ['status' => 'success', 'message' => 'Post Deleted Successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }

    public function getPostedBlog() {

        try {

            $data = JobserviceownerBlogPost::where('status','published')->paginate(5);

            return response()->json( $data );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }
    public function getAllBlogPost() {

        try {

            $data = JobserviceownerBlogPost::paginate(5);

            return response()->json( $data );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }


    public function getBlogPostById(Request $request) {

        try {

            $blogPostId = $request->id;

            $post = JobserviceownerBlogPost::with('category','user')->findOrFail($blogPostId);
           
            return response()->json(['status'=>'success','message'=>'Data found successfully','post'=>$post]);

        } catch(Exception $exception) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );

        }
    }
}

