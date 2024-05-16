<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{


    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Blog::query();

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'blogs_show';
                $editGate = 'blogs_edit';
                $deleteGate = 'blogs_delete';
                $crudRoutePart = 'blogs';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('content', function ($row) {
                return $row->content ? $row->content : '';
            });
           

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('admin.blogs.index');
    }

    public function create()
    {
        return view('admin.blogs.create');
    }



    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules (optional)
        ]);

        // Create a new blog post instance
        $blog = new Blog([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        // Check if a new image file was uploaded
        if ($request->hasFile('image')) {
            // Get the uploaded image file
            $imageFile = $request->file('image');

            // Generate a unique file name for the image
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            // Move the uploaded image to the desired public directory
            $imagePath = 'imgs/blogs/' . $imageName;
            $imageFile->move(public_path('imgs/blogs'), $imageName);

            // Construct the relative server URL for the stored image
            $imageUrl = url('/') . '/' . $imagePath;

            // Save the image URL to the blog post
            $blog->image = $imageUrl;
        }

        // Save the blog post to the database
        $blog->save();

        // Redirect back to the blog index page with a success message
        return redirect()->route('admin.blogs.index')->with('success', trans('global.create_success'));
    }
    public function edit(Blog $blog)
    {
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation rules (optional)
        ]);

        // Update the blog post attributes
        $blog->title = $request->input('title');
        $blog->content = $request->input('content');

        // Check if a new image file was uploaded
        if ($request->hasFile('image')) {
            // Get the uploaded image file
            $imageFile = $request->file('image');

            // Generate a unique file name for the image
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();

            // Move the uploaded image to the desired public directory
            $imagePath = 'imgs/blogs/' . $imageName;
            $imageFile->move(public_path('imgs/blogs'), $imageName);

            // Construct the server-relative URL for the stored image
            $imageUrl = url('/') . '/' . $imagePath;

            // Update the blog's image URL in the database
            $blog->image = $imageUrl;
        }

        // Save the updated blog post details
        $blog->save();

        // Redirect back to the blog index page with a success message
        return redirect()->route('admin.blogs.index')->with('success', trans('global.update_success'));
    }
    
    public function show(Blog $blog)
    {
        // return $blog;
        return view('admin.blogs.show', compact('blog'));
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back();
    }
}
