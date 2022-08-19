<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Carte;

class CarteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget('carte_return_url');

        $search_titlu = \Request::get('search_titlu');
        $search_autor = \Request::get('search_autor');

        $carti = Carte::with('user')
            ->when($search_titlu, function ($query, $search_titlu) {
                return $query->where('titlu', 'like', '%' . $search_titlu . '%');
            })
            ->when($search_autor, function ($query, $search_autor) {
                return $query->where('autor', 'like', '%' . $search_autor . '%');
            })
            ->latest()
            ->simplePaginate(25);

        return view('carti.index', compact('carti', 'search_titlu', 'search_autor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $carti = Carte::select('id', 'autor', 'editura', 'loc_publicare', 'subiecte', 'limba', 'locatie', 'tip_material')->get();

        $request->session()->get('carte_return_url') ?? $request->session()->put('carte_return_url', url()->previous());

        return view('carti.create', compact('carti'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $carte = Carte::create($this->validateRequest($request));

        return redirect($request->session()->get('carte_return_url') ?? ('/carti'))->with('status', 'Cartea „' . ($carte->titlu ?? '') . '” a fost adăugată cu succes!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carte  $carte
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Carte $carte)
    {
        $request->session()->get('carte_return_url') ?? $request->session()->put('carte_return_url', url()->previous());

        return view('carti.show', compact('carte'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carte  $carte
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Carte $carte)
    {
        $carti = Carte::select('id', 'autor', 'editura', 'loc_publicare', 'subiecte', 'limba', 'locatie', 'tip_material')->get();

        $request->session()->get('carte_return_url') ?? $request->session()->put('carte_return_url', url()->previous());

        return view('carti.edit', compact('carti', 'carte'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carte  $carte
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Carte $carte)
    {
        $carte->update($this->validateRequest($request));

        return redirect($request->session()->get('carte_return_url') ?? ('/carti'))->with('status', 'Cartea „' . ($carte->titlu ?? '') . '” a fost modificată cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carte  $carte
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Carte $carte)
    {
        $carte->delete();
        // \App\Models\CarteIstoric::where('id', $carte->id)->where('operatie', 'Stergere')->update(['user_id' => $request->user()->id]);

        return back()->with('status', 'Cartea „' . ($carte->titlu ?? '') . '” a fost ștearsă cu succes!');
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest(Request $request)
    {
        $request->request->add(['user_id' => $request->user()->id]);

        // if ($request->isMethod('post')) {
        //     $request->request->add(['cheie_unica' => uniqid()]);
        // }

        return $request->validate(
            [
                'titlu' => 'required|max:500',
                'autor' => 'nullable|max:500',
                'editura' => 'nullable|max:500',
                'loc_publicare' => 'nullable|max:500',
                'an_publicare' => 'nullable|max:500',
                'isbn_issn' => 'nullable|max:500',
                'subiecte' => 'nullable|max:500',
                'inventar' => 'nullable|max:500',
                'limba' => 'nullable|max:500',
                'tip_material' => 'nullable|max:500',
                'locatie' => 'nullable|max:500',
                'user_id' => '',
                // 'cheie_unica' => ''
            ],
            [

            ]
        );
    }
}
