@extends('admin.index')

@section('page-title', 'Data Merk')

@section('custom-css')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/src/plugins/datatables/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/admin/src/plugins/datatables/css/responsive.bootstrap4.min.css') }}">
@endsection

@section('page-content')
    <div class="card-box mb-30">
        <div class="row pd-20">
            <div class="col-md-6 col-sm-12">
                <h4 class="text-blue h4">Data Merk</h4>
                <p class="mb-0">Berikut ini adalah data merk yang ada di sistem Prima Perabot.</p>
            </div>
            <div class="col-md-6 col-sm-12 text-right">
                <a class="btn btn-primary" href="{{ route('dashboard.brand.create') }}">
                    Tambah Merk
                </a>
            </div>
        </div>
        <div class="pb-20">
            <div class="table-responsive">
                <table class="data-table table stripe hover nowrap" id="brand-table">
                    <thead>
                        <tr>
                            <th class="table-plus">Nama</th>
                            <th>Deskripsi</th>
                            <th class="datatable-nosort">Logo</th>
                            <th class="datatable-nosort">Aktif</th>
                            <th class="datatable-nosort">Disorot</th>
                            <th class="datatable-nosort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($brands as $brand)
                            <tr>
                                <td class="table-plus">{{ $brand->name }}</td>
                                <td>{{ $brand->description ?? '-' }}</td>
                                <td>
                                    @if ($brand->logo == null)
                                        <small>Belum melampirkan logo</small>
                                    @else
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"
                                            height="80" width="80">
                                    @endif
                                </td>
                                <td>
                                    @if ($brand->is_active)
                                        <i class="icon-copy ion-checkmark-circled" style="color: green;"></i>
                                    @else
                                        <i class="icon-copy ion-close-circled" style="color: red;"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($brand->is_highlighted)
                                        <i class="icon-copy ion-checkmark-circled" style="color: green;"></i>
                                    @else
                                        <i class="icon-copy ion-close-circled" style="color: red;"></i>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
                                            role="button" data-toggle="dropdown">
                                            <i class="dw dw-more"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                            {{-- <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a> --}}
                                            <a class="dropdown-item" href="{{ route('dashboard.brand.edit', $brand) }}">
                                                <i class="dw dw-edit2"></i> Edit
                                            </a>
                                            <form action="{{ route('dashboard.brand.destroy', $brand) }}" method="POST"
                                                onsubmit="return confirm('Apakah anda yakin ingin hapus merk {{ $brand->name }}?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="dropdown-item" type="submit">
                                                    <i class="dw dw-delete-3"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('custom-scripts')
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <!-- buttons for Export datatable -->
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('assets/admin/src/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <!-- Datatable Setting js -->
    <script src="{{ asset('assets/admin/vendors/scripts/datatable-setting.js') }}"></script>
@endsection
