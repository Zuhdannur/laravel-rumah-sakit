@extends('layouts.app', [
    'namePage' => 'Daftar Pasien',
    'class' => 'sidebar-mini',
    'activePage' => 'pasien',
  ])
@push('extra-css')
    <link rel="stylesheet" href="{{ asset('assets') }}/css/ui.css">
@endpush
@section('content')
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Input Data Pasien</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="{{ route('pasien.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama Pasien</label>
                                <input type="text" class="form-control" placeholder="Nama Pasien" name="nama_pasien" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Nama KK</label>
                                <input type="text" class="form-control" placeholder="Nama KK" name="nama_KK" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Tanggal Lahir</label>
                                <input type="text" class="form-control datepicker" placeholder="Tanggal Lahir" name="tgl_lahir" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Alamat</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" rows="2" name="alamat"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Agama</label>
                                <select class="form-control" name="agama" id="exampleFormControlSelect1">
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen">Kristen</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">No Tlp</label>
                                <input type="number" class="form-control" placeholder="Nomor Telp" name="nomor_telp" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlInput1">Jenis Kelamin</label>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios1" value="pria" >
                                        Pria
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                                <div class="form-check form-check-radio">
                                    <label class="form-check-label">
                                        <input class="form-check-input" type="radio" name="jenis_kelamin" id="exampleRadios2" value="wanita" checked>
                                        Wanita
                                        <span class="form-check-sign"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  for="exampleFormControlInput1">Pekerjaan</label>
                                <input type="text" class="form-control" placeholder="Pekerjaan" name="pekerjaan" required>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status</label>
                                <select class="form-control" name="status" id="exampleFormControlSelect1">
                                    <option value="1">Aktif</option>
                                    <option value="0">Non Aktif</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Status Kepersertaan</label>
                                <select class="form-control" name="status_peserta" id="exampleFormControlSelect1">
                                    <option value="BPJS/KIS">BPJS/KIS</option>
                                    <option value="UMUM">UMUM</option>
                                    <option value="BPKS">BPJS</option>
                                    <option value="KIS">KIS</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label  for="exampleFormControlInput1">Faskes TK.I</label>
                                <input type="text" class="form-control" placeholder="Faskes TK.I" name="faskes">
                            </div>
                            <div class="form-group">
                                <label  for="exampleFormControlInput1">No. KTP/KK</label>
                                <input type="text" class="form-control" placeholder="No. KTP/KK" name="nomor_ktp">
                            </div>
                            <div class="form-group">
                                <label  for="exampleFormControlInput1">No. RM</label>
                                <input type="text" class="form-control" placeholder="No. RM" name="nomor_ktp">
                            </div>
                            <div class="form-group">
                                <label  for="exampleFormControlInput1">No. KIS/FASKES</label>
                                <input type="text" class="form-control" placeholder="No. KIS/FASKES" name="nomor_kis">
                            </div>
                            <div class="row justify-content-end p-lg-3 p-sm-3">
                                <button rel="tooltip" class="btn btn-info btn-sm pt-sm-3 pt-lg-2" type="submit">
                                    Tambah Pasien
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
    <script>
        $(document).ready(function () {
            $('.datepicker').datepicker();
        })
    </script>
@endpush
