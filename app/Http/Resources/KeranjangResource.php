<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class KeranjangResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id_obat'=>$this->obat->id_obat,
            'image'=>"public/image/obat/".$this->obat->foto,
            'nama_obat'=>$this->obat->nama,
            'qty'=>$this->qty,
        ];
    }
}
