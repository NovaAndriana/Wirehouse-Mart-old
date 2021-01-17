<?php

namespace App\Imports;

use App\Produk;
use Maatwebsite\Excel\Concerns\ToModel;

class ProdukImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Produk([
            'name' => $row[1],
            'stok' => $row[2],
            'satuan' => $row[3],
            'category' => $row[4],
            'brand' => $row[5],
            'supplier' => $row[6],
            'harga_beli' => $row[7],
            'harga_jual' => $row[8],
            'harga_sdiskon' => $row[9],
            'diskon' => $row[10],
            'deskripsi' => $row[11],
            'image' => $row[12]
        ]);
    }
}
