@extends ('layouts.app')

@section('content')
<div class="container card" style="border-radius: 40px 40px 40px 40px;">
        <div class="row card-header align-items-center" style="border-radius: 40px 40px 0px 0px;">
            <div class="col-lg-3">
                <span class="badge culoare1 fs-5">
                    <i class="fa-solid fa-user-gear me-1"></i>Utilizatori
                </span>
            </div>

            <div class="col-lg-6">
                <form class="needs-validation" novalidate method="GET" action="{{ route(Route::currentRouteName())  }}">
                    @csrf
                    <div class="row mb-1 custom-search-form justify-content-center">
                        <div class="col-lg-4">
                            <input type="text" class="form-control rounded-3" id="search_nume" name="search_nume" placeholder="Nume" value="{{ $search_nume }}">
                        </div>
                        <div class="col-lg-4">
                            <input type="text" class="form-control rounded-3" id="search_email" name="search_email" placeholder="Email" value="{{ $search_email }}">
                        </div>
                    </div>
                    <div class="row custom-search-form justify-content-center">
                        <button class="btn btn-sm btn-primary text-white col-md-4 me-3 border border-dark rounded-3" type="submit">
                            <i class="fas fa-search text-white me-1"></i>Caută
                        </button>
                        <a class="btn btn-sm btn-secondary text-white col-md-4 border border-dark rounded-3" href="{{ route(Route::currentRouteName())  }}" role="button">
                            <i class="far fa-trash-alt text-white me-1"></i>Resetează căutarea
                        </a>
                    </div>
                </form>
            </div>
            <div class="col-lg-3 text-end">
                <a class="btn btn-sm btn-success text-white border border-dark rounded-3 col-md-8" href="{{ route(Route::currentRouteName())  }}/adauga" role="button">
                    <i class="fas fa-plus-square text-white me-1"></i>Adaugă utilizator
                </a>
            </div>
        </div>

        <div class="card-body px-0 py-3">

            @include ('errors')

            <div class="table-responsive rounded">
                <table class="table table-striped table-hover rounded">
                    <thead class="text-white rounded culoare2">
                    {{-- <thead class="text-white rounded" style="background-color: #69A1B1"> --}}
                        <tr class="" style="padding:2rem">
                            <th class="">#</th>
                            <th class="">Nume</th>
                            <th class="">Email</th>
                            <th class="">Rol</th>
                            <th class="text-end">Acțiuni</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td align="">
                                    {{ ($users ->currentpage()-1) * $users ->perpage() + $loop->index + 1 }}
                                </td>
                                <td class="">
                                    {{ $user->name }}
                                </td>
                                <td class="">
                                    {{ $user->email }}
                                </td>
                                <td class="">
                                    {{ $user->role }}
                                </td>
                                <td>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ $user->path() }}" class="flex me-1">
                                            <span class="badge bg-success">Vizualizează</span>
                                        </a>
                                        <a href="{{ $user->path() }}/modifica" class="flex me-1">
                                            <span class="badge bg-primary">Modifică</span>
                                        </a>
                                        <div style="flex" class="">
                                            <a
                                                href="#"
                                                data-bs-toggle="modal"
                                                data-bs-target="#stergeUtilizatorul{{ $user->id }}"
                                                title="Șterge Utilizatorul"
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
                        {{$users->appends(Request::except('page'))->links()}}
                    </ul>
                </nav>
        </div>
    </div>

    {{-- Modalele pentru stergere user --}}
    @foreach ($users as $user)
        <div class="modal fade text-dark" id="stergeUtilizatorul{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Utilizatorul: <b>{{ $user->name }}</b></h5>
                    <button type="button" class="btn-close bg-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="text-align:left;">
                    Ești sigur ca vrei să ștergi Utilizatorul?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Renunță</button>

                    <form method="POST" action="{{ $user->path() }}">
                        @method('DELETE')
                        @csrf
                        <button
                            type="submit"
                            class="btn btn-danger text-white"
                            >
                            Șterge Utilizatorul
                        </button>
                    </form>

                </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection
