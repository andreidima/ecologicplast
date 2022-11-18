@csrf

<div class="row mb-0 p-3 d-flex border-radius: 0px 0px 40px 40px" id="client">
    <div class="col-lg-12 mb-0">

        <div class="row mb-0">
            <div class="col-lg-12 mb-5 mx-auto">
                <label for="name" class="mb-0 ps-3">Nume<span class="text-danger">*</span></label>
                <input
                    type="text"
                    class="form-control bg-white rounded-3 {{ $errors->has('name') ? 'is-invalid' : '' }}"
                    name="name"
                    placeholder=""
                    value="{{ old('name', $user->name) }}"
                    required>
            </div>
            <div class="col-lg-12 mb-5 mx-auto">
                <label for="email" class="mb-0 ps-3">Email<span class="text-danger">*</span></label>
                <input
                    type="email"
                    class="form-control bg-white rounded-3 {{ $errors->has('email') ? 'is-invalid' : '' }}"
                    name="email"
                    placeholder=""
                    value="{{ old('email', $user->email) }}">
            </div>
            <div class="col-lg-12 mb-5 mx-auto">
                <label for="password" class="mb-0 ps-3">Parola<span class="text-danger">*</span></label>
                <input
                    type="password"
                    class="form-control bg-white rounded-3 {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    name="password"
                    placeholder="{{ (Route::currentRouteName() === "users.create") ? '' : '**********' }}"
                    {{-- value=" {{ (Route::currentRouteName() === "users.create") ? '' : '**********' }}" --}}
                    {{-- value="{{ old('password', ($user->password ? '*****' : '')) }}" --}}
                    >
            </div>
            <div class="col-lg-12 mb-5 mx-auto">
                <label for="role" class="mb-0 ps-3">Rol<span class="text-danger">*</span></label>
                <select name="role" class="form-select bg-white rounded-3 {{ $errors->has('role') ? 'is-invalid' : '' }}">
                    <option value='' selected></option>
                    <option value='Administrator' {{ (old('role', $user->role) == 'Administrator') ? 'selected' : '' }}> Administrator </option>
                    <option value='Operator' {{ (old('role', $user->role) == 'Operator') ? 'selected' : '' }}> Operator </option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 mb-2 d-flex justify-content-center">
                <button type="submit" ref="submit" class="btn btn-primary text-white me-3 rounded-3">{{ $buttonText }}</button>
                <a class="btn btn-secondary rounded-3" href="{{ Session::get('user_return_url') }}">Renunță</a>
            </div>
        </div>
    </div>
</div>
