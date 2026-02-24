@extends('admin.index')

@section('page-title', 'Tambah Data Produk')

@section('page-content')
    <div class="card-box mb-30 pd-20">
        <div class="mb-20">
            <h4 class="text-blue h4">Tambah Data Produk</h4>
            <p class="mb-0">Kolom dengan tanda (<span style="color: red;">*</span>) wajib diisi.</p>
        </div>
        <form action="{{ route('dashboard.product.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group @error('name') has-danger @enderror">
                <label>Nama<span style="color: red;">*</span></label>
                <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control @error('name') form-control-danger @enderror" placeholder="Masukkan nama produk">

                @error('name')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('description') has-danger @enderror">
                <label>Deskripsi</label>
                <textarea name="description" class="form-control @error('description') form-control-danger @enderror"
                    placeholder="Masukkan deskripsi produk">{{ old('description') }}</textarea>

                @error('description')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group @error('sku') has-danger @enderror">
                <label>SKU</label>
                <input type="text" name="sku" value="{{ old('sku') }}"
                    class="form-control @error('sku') form-control-danger @enderror" placeholder="Masukkan SKU produk">

                @error('sku')
                    <div class="form-control-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12 @error('brand_id') has-danger @enderror">
                        <label>Merk<span style="color: red;">*</span></label>
                        <select name="brand_id" class="form-control">
                            <option selected disabled>Pilih merk</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}" @if (old('brand_id') == $brand->id) selected @endif>
                                    {{ $brand->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('brand_id')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 @error('category_id') has-danger @enderror">
                        <label>Kategori Produk<span style="color: red;">*</span></label>
                        <select name="category_id" class="form-control">
                            <option selected disabled>Pilih kategori produk</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @if (old('category_id') == $category->id) selected @endif>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>

                        @error('category_id')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 col-sm-12 @error('price') has-danger @enderror">
                        <label>Harga<span style="color: red;">*</span></label>
                        <input type="number" name="price" value="{{ old('price') }}"
                            class="form-control @error('price') form-control-danger @enderror"
                            placeholder="Masukkan harga produk">

                        @error('price')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6 col-sm-12 @error('discount_percent') has-danger @enderror">
                        <label>Diskon</label>
                        <input type="number" name="discount_percent" value="{{ old('discount_percent') }}"
                            class="form-control @error('discount_percent') form-control-danger @enderror"
                            placeholder="Masukkan diskon produk">

                        @error('discount_percent')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4 col-sm-12 @error('is_active') has-danger @enderror">
                        <label class="weight-600">Aktif</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio1" name="is_active" value="1"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="customRadio1">Ya</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio2" name="is_active" value="0"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadio2">Tidak</label>
                        </div>

                        @error('is_active')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12 @error('is_hot_sale') has-danger @enderror">
                        <label class="weight-600">Penjualan Terbaik</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio3" name="is_hot_sale" value="1"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadio3">Ya</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio4" name="is_hot_sale" value="0"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="customRadio4">Tidak</label>
                        </div>

                        @error('is_hot_sale')
                            <div class="form-control-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-4 col-sm-12 @error('is_highlighted') has-danger @enderror">
                        <label class="weight-600">Disorot</label>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio5" name="is_highlighted" value="1"
                                class="custom-control-input">
                            <label class="custom-control-label" for="customRadio5">Ya</label>
                        </div>
                        <div class="custom-control custom-radio mb-5">
                            <input type="radio" id="customRadio6" name="is_highlighted" value="0"
                                class="custom-control-input" checked>
                            <label class="custom-control-label" for="customRadio6">Tidak</label>
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
