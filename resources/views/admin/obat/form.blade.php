
<div class="row justify-content-center mb-4">
    <div class="col">
        <div class="image-live" data-target="foto" data-ext="png,jpg,jpeg">
            <input type="file" class="d-none file-live" name="foto">
            <input type="text" class="d-none" value="" name="foto-old">
            <img id="foto" style="cursor: pointer" src="{{asset('assets/dist/img/default-150x150.png')}}" class="shadow rounded mb-4 img-fluid" alt="" srcset="">
        </div>
        <div class="text-danger"><i>File Tidak Boleh Lebih besar dari 1Mb</i></div>
        <div class="text-dark"><i>Rekomendasi Ukuran 150x150 Pixel</i></div>

    </div>
</div>
<div class="form-group">
    <label>Nama Obat</label>
    <input type="text" name="nama" class="form-control" required="" autocomplete="off">
</div>
<div class="form-group">
    <label>Deskripsi</label>
    <textarea name="deskripsi" class="form-control" required="" autocomplete="off" rows="5"></textarea>
</div>

<div class="form-group">
  <label for="">Kategori</label>
  <select class="form-control" name="id_kategori" id="">
    <option value="0" selected disabled>Pilih Kategori</option>
    @foreach (\App\Models\MKategoriObat::get() as $item)
        <option value="{{$item->id_kategori}}">{{$item->nama}}</option>
    @endforeach
  </select>
</div>
<div class="form-group">
    <label>Harga</label>
    <input type="text" name="harga" class="form-control numeric" required="">
</div>
