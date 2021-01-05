import Axios from 'axios';
import { MDBDataTable } from 'mdbreact';
import React, { useEffect, useState } from 'react';

const PasienAntri = () => {
  const [pasiens, setPasiens] = useState([]);
  const data = {
    columns: [
      {
        label: 'No Pendaftaran',
        field: 'nomor_pendaftaran',
        sort: 'asc',
        width: 270
      }, {
        label: 'Tanggal Daftar',
        field: 'nama',
        sort: 'asc',
        width: 150
      },
      {
        label: 'Jenis Layanan',
        field: 'layanan',
        sort: 'asc',
        width: 200
      },
      {
        label: 'Poli',
        field: 'poli',
        sort: 'asc',
        width: 100
      },
      {
        label: 'Dokter',
        field: 'dokter',
        sort: 'asc',
        width: 150
      },
      {
        label: 'Action',
        field: 'salary',
        sort: 'asc',
        width: 100
      }
    ]
  }
  const getPasiens = async () => {
    try {
      let res = await Axios.get(baseApiUrl + "poli-pasien-antri");
      console.log(res.data);
      setPasiens(res.data)
    } catch (e) {
      console.log(e);
    }
  }
  useEffect(() => {
    getPasiens();
  }, []);
  return (
    <div className="card shadow mb-4">
      <div className="card-header py-3">
        <h6 className="m-0 font-weight-bold text-primary">Daftar Pasien Antri</h6>
      </div>
      <div className="card-body">
        <MDBDataTable
          striped
          bordered
          hover
          data={data}
        />
      </div>
    </div>

  );
};

export default PasienAntri;