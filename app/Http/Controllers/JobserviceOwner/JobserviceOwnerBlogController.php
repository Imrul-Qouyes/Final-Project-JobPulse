<?php

namespace App\Http\Controllers\JobserviceOwner;

use App\Http\Controllers\Controller;
use App\Models\JobserviceOwner\JobserviceownerBlogCategory;
use Exception;
use Illuminate\Http\Request;

class JobserviceOwnerBlogController extends Controller {
    public function createBlogCategories( Request $request ) {

        try {

            $request->validate( [
                'blog_category_name' => 'required|string|max:50',
            ] );

            $blogCategoryName = $request->input( 'blog_category_name' );

            JobserviceownerBlogCategory::updateOrCreate( [
                'blog_category_name' => $blogCategoryName,
            ] );

            return response()->json( ['status' => 'success', 'message' => 'Category has been created successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }
    }

    public function updateBlogCategories( Request $request ) {

        try {

            $blogCategoryId = $request->id;
            $blogCategoryName = $request->blog_category_name;

            JobserviceownerBlogCategory::where( 'id', $blogCategoryId )->update( ['blog_category_name' => $blogCategoryName] );

            return response()->json( ['status' => 'success', 'message' => 'Category has been updated successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }
    }

    public function removeBlogCategories( Request $request ) {

        try {

            $blogCategoryId = $request->id;

            JobserviceownerBlogCategory::where( 'id', $blogCategoryId )->delete();

            return response()->json( ['status' => 'success', 'message' => 'Category has been deleted successfully'] );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }
    }

    public function getAllBlogCategories( Request $request ) {

        try {

            $data = JobserviceownerBlogCategory::paginate( 3 );

            return response()->json( $data );

        } catch ( Exception $exception ) {

            return response()->json( ['status' => 'failed', 'message' => $exception->getMessage()] );
        }
    }

}
