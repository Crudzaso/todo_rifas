<?php

class UserController extends Controller{

public function index()
{
    $users = User::paginate(10);
    return view('admin.users.index', compact('users'));
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $user->update($request->all());

    return redirect()->route('admin.users.index')->with('success', 'Usuario actualizado con éxito');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'Usuario eliminado');
}
}


