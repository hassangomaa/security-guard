<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookmarkLocation;

class BookmarkLocationController extends Controller
{
    public function listBookmarkedLocations()
    {
        $user = auth()->user();
        $bookmarkedLocations = $user->bookmarkLocations()->get();

        return response()->json([
            'bookmarked_locations' => $bookmarkedLocations
        ]);
    }

    public function delete(Request $request, $id)
    {
        $user = auth()->user();
        $bookmarkLocation = BookmarkLocation::where('user_id', $user->id)->find($id);

        //if not found throw exc
        if (!$bookmarkLocation) {
            return response()->json([
                'message' => 'Bookmark location not found'
            ], 404);
        }
        $bookmarkLocation->delete();

        return response()->json([
            'message' => 'Bookmark location deleted successfully'
        ]);
    }
}
