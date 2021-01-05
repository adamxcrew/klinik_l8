import React from 'react';

const setPasien = ({ pasien }) => {
  return (
    <div className='row'>
      <div className="col-md-5">
        <div className="d-flex justify-content-between">
          <span>No. Pasien</span>
          <span className="text-secondary">{pasien.nomor_pasien}</span>
        </div>
        <div className="d-flex justify-content-between">
          <span>Nama</span>
          <span className="text-secondary">{pasien.nama}</span>
        </div>
        <div className="d-flex justify-content-between">
          <span>Tempat/Tanggal Lahir</span>
          <span className="text-secondary">{pasien.tempat_lahir} / {pasien.tgl_lahir}</span>
        </div>
      </div>
      <div className="col-md-7"></div>

    </div>
  );
};

export default setPasien;