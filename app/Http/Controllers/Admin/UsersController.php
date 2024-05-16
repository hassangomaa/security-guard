<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\UserController;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\EmirateCity;
use App\Models\File;
use App\Models\Role;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;




class UsersController extends Controller
{



    public function index(Request $request)
    {
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = User::select(sprintf('%s.*', (new User())->table));

            // if ($request->input('active') === 'active') {
            //     $query->where('active', 1);
            // } elseif ($request->input('active') === 'inactive') {
            //     $query->where('active', 0);
            // }

            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');
            // $table->addColumn('status', function ($row) {
            //     return $row->active ? 'active' : 'inactive';
            // });

            $table->editColumn('actions', function ($row) {
                $viewGate = 'user_show';
                $editGate = 'user_edit';
                $deleteGate = 'user_delete';
                $crudRoutePart = 'users';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            // $table->editColumn('id', function ($row) {
            //     return $row->id ? $row->id : '';
            // });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('phone', function ($row) {
                return $row->phone ? $row->phone : '';
            });
            // $table->editColumn('adress', function ($row) {
            //     return $row->adress ? $row->adress : '';
            // });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        $roles = Role::get();

        return view('admin.users.index', compact('roles'));
    }




    public function updateStatus(Request $request, User $user)
    {
        $user->active = $request->input('status');
        $user->save();

        return response()->json(['message' => 'User status updated successfully']);
    }




    public function create()
    {
        abort_if(Gate::denies('user_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('name', 'id');

        return view('admin.users.create', compact('roles'
        ));
    }


    public function store(StoreUserRequest $request)
    {
        // return $request->all();


        DB::beginTransaction();

        try {
//        return $request->all();
        $user = User::create($request->all());

        $token = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);



        if ($request->hasFile('profile_image')) {

            $profileImage = $request->file('profile_image');
            $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
            $profileImage->move(public_path('imgs/profile'), $imageName);
            $user->profile_image = $imageName;
        }


        $user->save();
        DB::commit();
        $userController = new UserController();
        $userController->sendEmail($user->email, $token, $user->name);

        return redirect()->route('admin.users.index');
         } catch (\Exception $e) {
        // Something went wrong, rollback the transaction
         DB::rollBack();
         return redirect()->route('admin.users.index');

        }

    }


    public function edit(User $user)
    {
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $roles = Role::pluck('name', 'id');
        // $nationality = Nationality::all();
        // $emirateCities = EmirateCity::all();

        return view('admin.users.edit', compact('user', 'roles'));
    }


    public function update(UpdateUserRequest $request, User $user)
    {
        DB::beginTransaction();

        try {
            // Get validated data from the request
            $validatedData = $request->validated();

            // Separate each variable
            $name = $validatedData['name'] ?? null;
            $email = $validatedData['email'] ?? null;
            $password = $validatedData['password'] ?? null;
            $lang = $validatedData['lang'] ?? null;
            $phone = $validatedData['phone'] ?? null;

            // Remove password if it's empty
            if (empty($password)) {
                unset($password);
            }

            // Update user's attributes individually
            $user->name = $name;
            $user->email = $email;

            // Update password only if it's not empty
            if (!empty($password)) {
                $user->password = Hash::make($password);
            }

            $user->lang = $lang;
            $user->phone = $phone;

            // Save the changes to the user
            $user->save();

            // Handle profile image upload if provided
            if ($request->hasFile('profile_image')) {
                $profileImage = $request->file('profile_image');
                $imageName = time() . '.' . $profileImage->getClientOriginalExtension();
                $profileImage->move(public_path('imgs/profile'), $imageName);
                $user->profile_image = $imageName;
                $user->save();
            }

            DB::commit();

            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('admin.users.index');
        }
    }



    public function show(User $user)
    {
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Modify the eager loading to include soft-deleted posts
        $user->load(['roles']);
        return view('admin.users.show', compact('user'));
    }


    public function destroy(User $user)
    {
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->delete();

        return back();
    }


    public function massDestroy(MassDestroyUserRequest $request)
    {
        User::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
