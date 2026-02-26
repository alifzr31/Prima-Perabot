@extends('admin.index')

@section('page-title', 'Edit Data Pengguna')

@section('page-content')
    <div class="card-box mb-30 pd-20">
        <div class="mb-20">
            <h4 class="text-blue h4">Edit Data Pengguna</h4>
            <p class="mb-0">Kolom dengan tanda (<span style="color: red;">*</span>) wajib diisi.</p>
        </div>
        <form action="{{ route('dashboard.user.update', $user) }}" method="POST">
            @csrf
            <div class="form-group @error('name') has-danger @enderror">
                <label>Nama Lengkap<span style="color: red;">*</span></label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}"
                    class="form-control @error('name') form-control-danger @enderror"
                    placeholder="Masukkan nama lengkap pengguna">

                @error('name')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12 @error('email') has-danger @enderror">
                        <label>Email<span style="color: red;">*</span></label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="form-control @error('email') form-control-danger @enderror"
                            placeholder="Masukkan email pengguna">

                        @error('email')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 @error('phone') has-danger @enderror">
                        <label>No. Telepon<span style="color: red;">*</span></label>
                        <input type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="form-control @error('phone') form-control-danger @enderror"
                            placeholder="Masukkan no. telepon pengguna">

                        @error('phone')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group @error('role') has-danger @enderror">
                <label>Hak Akses Pengguna<span style="color: red;">*</span></label>
                <select name="role" class="form-control">
                    <option selected disabled>Pilih hak akses pengguna</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role }}" @if (old('role', $user->role) == $role) selected @endif>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </select>

                @error('role')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
