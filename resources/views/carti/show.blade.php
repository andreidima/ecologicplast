@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="shadow-lg" style="border-radius: 40px 40px 40px 40px;">
                <div class="culoare2 border border-secondary p-2" style="border-radius: 40px 40px 0px 0px;">
                    <span class="badge text-light fs-5">
                        <i class="fa-solid fa-book me-1"></i>Cărți / {{ $carte->titlu }}
                    </span>
                </div>

                <div class="card-body py-2 border border-secondary"
                    style="border-radius: 0px 0px 40px 40px;"
                >

            @include ('errors')

                    <div class="table-responsive col-md-12 mx-auto">
                        <table class="table table-striped table-hover"
                        >
                            <tr>
                                <td class="pe-4">
                                    Titlu
                                </td>
                                <td>
                                    {{ $carte->titlu }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Autor
                                </td>
                                <td>
                                    {{ $carte->autor }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Editura
                                </td>
                                <td>
                                    {{ $carte->editura }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Loc publicare
                                </td>
                                <td>
                                    {{ $carte->loc_publicare }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Am publicare
                                </td>
                                <td>
                                    {{ $carte->an_publicare }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    ISBN/ ISSN
                                </td>
                                <td>
                                    {{ $carte->isbn_issn }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Subiecte
                                </td>
                                <td>
                                    {{ $carte->subiecte }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Inventar
                                </td>
                                <td>
                                    {{ $carte->inventar }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Limba
                                </td>
                                <td>
                                    {{ $carte->limba }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Tip material
                                </td>
                                <td>
                                    {{ $carte->tip_material }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pe-4">
                                    Locație
                                </td>
                                <td>
                                    {{ $carte->locatie }}
                                </td>
                            </tr>
                        </table>
                    </div>

                    <div class="form-row mb-2 px-2">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <a class="btn btn-secondary text-white rounded-3" href="{{ Session::get('carte_return_url') }}">Înapoi</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
