<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Manager\StoreRequest;
use App\Http\Requests\Admin\Manager\UpdateRequest;
use App\Models\User;
use Hash;
use Laravel\Fortify\Fortify;
use Password;
use Spatie\Permission\Models\Role;
use Str;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $managers = User::all();

        return view('pages.admin.manager.index')->with('managers', $managers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $roles = Role::all();

        return view('pages.admin.manager.create')->with('roles', $roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\Admin\Manager\StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreRequest $request)
    {
        $data = $request->validated();

        $manager = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make(Str::random(12))
        ]);

        $manager->assignRole(Role::findById($data['role'], config('fortify.guard')));

        $status = Password::sendResetLink($manager->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->route('admin.manager.index')->with(['status' => __($status)]);
        }

        return redirect()->back()->withErrors(['email' => __($status)]);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $manager
     * @return \Illuminate\Http\Response
     */
    public function show(User $manager)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $manager
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(User $manager)
    {
        $roles = Role::all();
        return view('pages.admin.manager.edit')->with('manager', $manager)->with('roles', $roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\Admin\Manager\UpdateRequest $request
     * @param \App\Models\User $manager
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $manager)
    {

        $data = $request->validated();

        if (!$manager->update([
            'name' => $data['name'],
            'email' => $data['email']
        ])) {
            return redirect()->back()->withErrors(['error' => 'Beheerder kon niet worden bijgewerkt.']);
        }

        $this->handleRoleChange($manager, $data['role']);

        return redirect()->route('admin.managers.index')->with('message', 'De beheerder is successvol aangepast!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $manager)
    {
        //
    }

    private function handleRoleChange(User $manager, $roleId) {
        $currentRoleId = $manager->roles[0]->id;
        $currentRole = Role::all()->where('id', $currentRoleId)->first();

        if ($roleId != $currentRoleId) {
            $manager->removeRole($currentRole);

            $newRole = Role::all()->where('id', $roleId)->first();
            $manager->assignRole($newRole->name);
        }
    }
}
