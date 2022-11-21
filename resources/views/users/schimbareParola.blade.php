@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="shadow-lg" style="border-radius: 40px 40px 40px 40px;">
                <div class="border border-secondary p-2 culoare2" style="border-radius: 40px 40px 0px 0px;">
                    <span class="badge text-light fs-5">
                        <i class="fa-solid fa-user-gear me-1"></i>Schimbă parola contului
                    </span>
                </div>

                @include ('errors')

                <div class="card-body py-2 border border-secondary"
                    style="border-radius: 0px 0px 40px 40px;"
                >
                    <form  class="needs-validation" novalidate method="POST" action="/schimbare-parola">
                        @csrf

                        <div class="row mb-0 p-3 d-flex border-radius: 0px 0px 40px 40px" id="client">
                            <div class="col-lg-12 mb-0">

                                <div class="row mb-0">
                                    <div class="col-lg-12 mb-5 mx-auto">
                                        <label for="parolaInput" class="form-label">Parola nouă</label>
                                        <input name="parola" type="password" class="form-control @error('parola') is-invalid @enderror" id="parolaInput"
                                            placeholder="">
                                    </div>
                                    <div class="col-lg-12 mb-5 mx-auto">
                                        <label for="confirmParolaInput" class="form-label">Confirmă Parola</label>
                                        <input name="parola_confirmation" type="password" class="form-control @error('parola') is-invalid @enderror" id="confirmParolaInput"
                                            placeholder="">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-lg-12 mb-2 d-flex justify-content-center">
                                        <button type="submit" ref="submit" class="btn btn-primary text-white me-3 rounded-3">Schimbă</button>
                                        <a class="btn btn-secondary rounded-3" href="/">Renunță</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
