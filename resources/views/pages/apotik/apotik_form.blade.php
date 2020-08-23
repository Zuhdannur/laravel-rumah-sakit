@extends('layouts.app', [
    'namePage' => 'Daftar Obat Pasien',
    'class' => 'sidebar-mini',
    'activePage' => 'apotik',
  ])
@push('extra-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/ui.css">
@endpush
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Data Obat Pasien</h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('apotik.store') }}" id="form">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Nama Pasien</label>
                                <select class="form-control" name="id_pasien" id="exampleFormControlSelect1">
                                    @foreach($pasien as $item)
                                        <option value="{{ $item->id_pasien}}">{{ $item->nama_pasien }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Jenis Obat</label>
                                <select class="form-control" name="id_obat" id="exampleFormControlSelect1">
                                    @foreach($jenis_obat as $item)
                                        <option value="{{ $item->id_obat}}">{{ $item->nama_obat }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Obat</label>
                                <input type="text" class="form-control" placeholder="Nama Obat" name="nama_obat" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Harga</label>
                                <input type="text" class="form-control money" placeholder="Harga" name="harga" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Stock</label>
                                <input type="number" class="form-control" placeholder="Stock" name="stock" required>
                            </div>
                            <div class="row justify-content-end p-lg-3 p-sm-3">
                                <button rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2" type="submit">
                                    Tambah Obat Pasien
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@push('js')
    <script src="{{ asset('assets')  }}/js/ui.js"></script>
    <script src="{{ asset('assets')}}/js/plugins/jquery.mask.js"></script>
    <script>
        $(document).ready(function () {
            $('.money').mask('000.000.000.000.000,00', {reverse: true});

            $("form").submit(function() {
                $('.money').unmask();
            })
        })
    </script>
@endpush
