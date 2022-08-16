@extends ('layouts.app')

@section('content')
<div class="container card" style="border-radius: 40px 40px 40px 40px;">
        <div class="row card-header align-items-center" style="border-radius: 40px 40px 0px 0px;">
            <div class="col-lg-3">
                <span class="badge culoare1 fs-5">
                    Zile nelucrătoare
                </span>
            </div>
            <div class="col-lg-6">
            </div>
            <div class="col-lg-3 text-end">
                <a class="btn btn-sm bg-success text-white border border-dark rounded-3 col-md-8" href="/zile-nelucratoare/adauga" role="button">
                    <i class="fas fa-plus-square text-white me-1"></i>Adaugă zi nelucrătoare
                </a>
            </div>
        </div>

        <div class="card-body px-0 py-3">

            @include ('errors')

            <div class="table-responsive rounded">
                <table class="table table-striped table-hover rounded">
                    <thead class="text-white rounded culoare2">
                        <tr class="" style="padding:2rem">
                            <th class="">#</th>
                            <th class="text-center px-3">Data</th>
                            <th class="text-end">Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($zile_nelucratoare as $zi_nelucratoare)
                            <tr>
                                <td align="">
                                    {{ ($zile_nelucratoare ->currentpage()-1) * $zile_nelucratoare ->perpage() + $loop->index + 1 }}
                                </td>
                                <td class="text-center">
                                    {{ \Carbon\Carbon::make($zi_nelucratoare->data)->isoFormat('DD.MM.YYYY') }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ $zi_nelucratoare->path() }}/modifica" class="flex me-1">
                                            <span class="badge bg-primary">Modifică</span>
                                        </a>
                                        <div style="flex" class="">
                                            <a
                                                href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#stergeZiNelucrătoare{{ $zi_nelucratoare->id }}"
                                                title="Șterge Ziua Nelucrătoare"
                                                >
                                                <span class="badge bg-danger">Șterge</span>
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            {{-- <div>Nu s-au gasit rezervări în baza de date. Încearcă alte date de căutare</div> --}}
                        @endforelse
                        </tbody>
                </table>
            </div>

                <nav>
                    <ul class="pagination justify-content-center">
                        {{$zile_nelucratoare->appends(Request::except('page'))->links()}}
                    </ul>
                </nav>
        </div>
    </div>

    {{-- Modalele pentru stergere zi nelucratoare --}}
    @foreach ($zile_nelucratoare as $zi_nelucratoare)
        <div class="modal fade text-dark" id="stergeZiNelucrătoare{{ $zi_nelucratoare->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Ziua Nelucrătoare: <b>{{ \Carbon\Carbon::make($zi_nelucratoare->data)->isoFormat('DD.MM.YYYY') }}</b></h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align:left;">
                    Ești sigur ca vrei să ștergi Ziua Nelucrătoare?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Renunță</button>

                    <form method="POST" action="{{ $zi_nelucratoare->path() }}">
                        @method('DELETE')
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-danger text-white"
                            >
                            Șterge Ziua Nelucrătoare
                        </button>
                    </form>

                </div>
                </div>
            </div>
        </div>
    @endforeach


@endsection
