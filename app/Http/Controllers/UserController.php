<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget('user_return_url');

        $search_nume = $request->search_nume;
        $search_email = $request->search_email;

        $users = User::
            when($search_nume, function ($query, $search_nume) {
                return $query->where('nume', 'like', '%' . $search_nume . '%');
            })
            ->when($search_email, function ($query, $search_email) {
                return $query->where('telefon', 'like', '%' . $search_email . '%');
            })
            ->latest()
            ->simplePaginate(25);

        return view('users.index', compact('users', 'search_nume', 'search_email'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->get('user_return_url') ?? $request->session()->put('user_return_url', url()->previous());

        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $user = User::create($this->validateRequest($request));

        return redirect($request->session()->get('user_return_url') ?? ('/users'))->with('status', 'Utilizatorul „' . ($user->name ?? '') . '” a fost adăugat cu succes!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $request->session()->get('user_return_url') ?? $request->session()->put('user_return_url', url()->previous());

        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
        $request->session()->get('user_return_url') ?? $request->session()->put('user_return_url', url()->previous());

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($this->validateRequest($request, $user));

        return redirect($request->session()->get('user_return_url') ?? ('/users'))->with('status', 'Utilizatorul „' . ($user->name ?? '') . '” a fost modificat cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, User $user)
    {
        $user->delete();

        return back()->with('status', 'Utilizatorul „' . ($user->name ?? '') . '” a fost șters cu succes!');
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest(Request $request, $user = null)
    {
        // Se adauga userul doar la adaugare, iar la modificare nu se schimba
        // if ($request->isMethod('post')) {
        //     $request->request->add(['user_id' => $request->user()->id]);
        // }

        // if ($request->isMethod('post')) {
        //     $request->request->add(['cheie_unica' => uniqid()]);
        // }

        // if ($request['password'] && ($request['password'] !== '**********')){
        //     $request['password'] = Hash::make($request['password']);
        // }
        // dd($request['password']);

        return $request->validate(
            [
                'name' => 'required|max:255',
                'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id ?? 0)],
                'password' => $request->isMethod('post') ? 'required|max:255' : '',
                'role' => 'required|max:50',
            ],
            [

            ]
        );
    }
}
