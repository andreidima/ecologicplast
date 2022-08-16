<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\ZiNelucratoare;

use Carbon\Carbon;

class ZiNelucratoareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->session()->forget('zi_nelucratoare_return_url');

        $zile_nelucratoare = ZiNelucratoare::select('id', 'data')->orderBy('data')->simplePaginate(25);

        return view('zileNelucratoare.index', compact('zile_nelucratoare',));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->session()->get('zi_nelucratoare_return_url') ?? $request->session()->put('zi_nelucratoare_return_url', url()->previous());

        return view('zileNelucratoare.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $zi_nelucratoare = ZiNelucratoare::create($this->validateRequest($request));

        return redirect($request->session()->get('zi_nelucratoare_return_url') ?? ('/zile-nelucratoare'))
            ->with('status', 'Ziua nelucrătoare „' . ($zi_nelucratoare->data ? Carbon::parse($zi_nelucratoare->data)->isoFormat('DD.MM.YYYY') : '') . '” a fost adăugată cu succes!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ZiNelucratoare  $zi_nelucratoare
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, ZiNelucratoare $zi_nelucratoare)
    {
        $request->session()->get('zi_nelucratoare_return_url') ?? $request->session()->put('zi_nelucratoare_return_url', url()->previous());

        return view('zileNelucratoare.show', compact('zi_nelucratoare'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App ZiNelucratoare  $zi_nelucratoare
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, ZiNelucratoare $zi_nelucratoare)
    {
        $request->session()->get('zi_nelucratoare_return_url') ?? $request->session()->put('zi_nelucratoare_return_url', url()->previous());

        return view('zileNelucratoare.edit', compact('zi_nelucratoare'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App ZiNelucratoare  $zi_nelucratoare
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ZiNelucratoare $zi_nelucratoare)
    {
        $zi_nelucratoare->update($this->validateRequest($request));

        return redirect($request->session()->get('zi_nelucratoare_return_url') ?? ('/zile-nelucratoare'))
            ->with('status', 'Ziua nelucrătoare „' . ($zi_nelucratoare->data ? Carbon::parse($zi_nelucratoare->data)->isoFormat('DD.MM.YYYY') : '') . '” a fost modificată cu succes!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App ZiNelucratoare  $zi_nelucratoare
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, ZiNelucratoare $zi_nelucratoare)
    {
        $zi_nelucratoare->delete();

        return back()->with('status', 'Ziua nelucrătoare „' . ($zi_nelucratoare->data ? Carbon::parse($zi_nelucratoare->data)->isoFormat('DD.MM.YYYY') : '') . ' a fost ștearsă cu succes!');
    }

    /**
     * Validate the request attributes.
     *
     * @return array
     */
    protected function validateRequest(Request $request)
    {
        return $request->validate(
            [
                'data' => 'required',
            ],
            [

            ]
        );
    }
}
