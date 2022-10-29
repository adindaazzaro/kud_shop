<style>
  @font-face {
    src : url('{{ asset("assets/fonts/F25_Bank_Printer.ttf") }}');
    font-family: 'bankr';
}
.fbprint{
    font-family: "bankr" !important;
    font-size: 9pt;
}
.hr-dashed{
  border-bottom: 0.5px dashed #ccc;
}
</style>
<div class="receipt fbprint">
  <div class="receipt-list text-dark">
    
    <div class="text-center mb-2">
      <img src="{{asset('image/setting/'.$setting->logo)}}" class="img-fluid" width="70px" alt="">
    </div>
    <div class="text-center mb-4">
      Jl. Raya Sumbertangkil Wetan
      <p>{{$setting->no_telp}}</p>
    </div>
    <div class="d-flex align-items-center mb-2">
      <div class="text-left">
        {{AllFunction::convertDate($data->created_at,false,false)}}
      </div>
      <div class="ml-auto">
        {{date("H:i",strtotime($data->created_at))}}
      </div>
    </div>
    
    <div class="d-flex align-items-center mb-2">
      <div class="text-left">
        Order ID
      </div>
      <div class="ml-auto">
        {{$data->kode_transaksi}}
      </div>
    </div>
    <div class="hr-dashed"></div>
    @php
        $diskon = 0;
        $subTotal = 0;
    @endphp
    @foreach ($data->detailTrans as $item)    
    <div class="receipt-item fbprint text-dark ">
      <div class="receipt-label text-capitalize mb-2">{{$item->obat->nama}}</div>
      <div class="receipt-value w-100">
        <div class="float-left">
          <span class="qty">{{$item->jumlah}}</span>
          <span class="price">{{'@'}}{{AllFunction::toCurrency($item->obat->harga)}}</span>
        </div>
        <div class="float-right">
          @php
              $total = (int)$item->obat->harga*(int)$item->jumlah;
              $subTotal += $total;
              
          @endphp
          {{AllFunction::toCurrency($total)}}
        </div>
      </div>
    </div>
    @endforeach
    <div class="hr-dashed my-2"></div>
    <div class="receipt-item fbprint text-dark ">
      <div class="receipt-label text-capitalize float-left">Sub Total</div>
      <div class="receipt-value">
          Rp. {{AllFunction::toCurrency($subTotal)}}
      </div>
    </div>
    <div class="hr-dashed my-2"></div>
    <div class="receipt-item fbprint text-dark ">
      <div class="receipt-label text-capitalize float-left">Total:</div>
      <div class="receipt-value">
          Rp. {{AllFunction::toCurrency($subTotal - $diskon)}}
      </div>
    </div>
  </div>
</div>
