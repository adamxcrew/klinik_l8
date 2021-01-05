<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PasienResaurce extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return array
   */
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'nama' => $this->nama,
      'email' => $this->email,
      'tanggal_lahir' => $this->created_at->format("d F Y"),
      "no_ktp" => $this->no_ktp,
      "tempat_lahir" => $this->tempat_lahir,
      "alamat" => $this->alamat,
      "rt_rw" => $this->rt_rw,
    ];
  }
}
