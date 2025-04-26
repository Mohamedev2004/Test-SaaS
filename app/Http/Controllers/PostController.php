<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function removeImage($imageName, Request $request)
    {
        // Assuming the 'images' column is a JSON column that stores an array of image paths.
        $post = Post::whereJsonContains('images', $imageName)->first();

        if ($post) {
            // Decode the images column (which is JSON)
            $images = json_decode($post->images);

            // Find the image to remove
            if (($key = array_search($imageName, $images)) !== false) {
                unset($images[$key]);  // Remove the image from the array
            }

            // Update the 'images' column in the database
            $post->images = json_encode(array_values($images));
            $post->save();

            // Delete the image from storage
            if (Storage::exists('public/' . $imageName)) {
                Storage::delete('public/' . $imageName);
            }

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'Image not found']);
    }
}
