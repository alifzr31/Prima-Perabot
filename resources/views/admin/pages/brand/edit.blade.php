@extends('admin.index')

@section('page-title', 'Edit Data Merk')

@section('page-content')
    <div class="card-box mb-30 pd-20">
        <div class="mb-20">
            <h4 class="text-blue h4">Edit Data Merk</h4>
            <p class="mb-0">Kolom dengan tanda (<span style="color: red;">*</span>) wajib diisi.</p>
        </div>
        <form action="{{ route('dashboard.brand.update', $brand) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group @error('name') has-danger @enderror">
                <label>Nama<span style="color: red;">*</span></label>
                <input type="text" name="name" value="{{ old('name', $brand->name) }}"
                    class="form-control @error('name') form-control-danger @enderror" placeholder="Masukkan nama merk">

                @error('name')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('description') has-danger @enderror">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control @error('description') form-control-danger @enderror"
                    placeholder="Masukkan deskripsi merk">{{ old('description', $brand->description) }}</textarea>

                @error('description')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('logo') has-danger @enderror">
                <label>Logo</label>
                <input type="file" name="logo" accept=".jpg,.jpeg,.png,.webp"
                    class="form-control @error('logo') form-control-danger @enderror" placeholder="Pilih logo merk">

                @error('logo')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12 @error('is_active') has-danger @enderror">
                        <label class="weight-600">Aktif</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio1" name="is_active" value="1"
                                class="custom-control-input" @if ($brand->is_active == 1) checked @endif>
                            <label class="custom-control-label" for="customRadio1">Ya</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio2" name="is_active" value="0"
                                class="custom-control-input" @if ($brand->is_active == 0) checked @endif>
                            <label class="custom-control-label" for="customRadio2">Tidak</label>
                        </div>

                        @error('is_active')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 @error('is_highlighted') has-danger @enderror">
                        <label class="weight-600">Disorot</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio3" name="is_highlighted" value="1"
                                class="custom-control-input" @if ($brand->is_highlighted == 1) checked @endif>
                            <label class="custom-control-label" for="customRadio3">Ya</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio4" name="is_highlighted" value="0"
                                class="custom-control-input" @if ($brand->is_highlighted == 0) checked @endif>
                            <label class="custom-control-label" for="customRadio4">Tidak</label>
                        </div>

                        @error('is_highlighted')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
