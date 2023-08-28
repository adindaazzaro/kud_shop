<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ObatResource extends JsonResource
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
          'id_obat'=>$this->id_obat,
          'nama'=>$this->nama,
          'foto'=>$this->foto,
          'id_kategori'=>$this->kategori?->nama,
          'deskripsi'=>$this->deskripsi,
          'stok'=>$this->stok,
          'harga'=>$this->harga,
        ];
    }
}
