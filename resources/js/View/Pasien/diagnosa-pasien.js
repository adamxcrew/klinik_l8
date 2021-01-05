import React from 'react';
import { RecoilRoot } from 'recoil';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Switch } from 'react-router-dom';
import Axios from 'axios';


const Pasien = () => {
  let { id } = useParams();
  const [pasien, setPasien] = useState({});
  const getPasien = async () => {
    try {
      let res = await Axios.get(`admin/pasien/${id}/diagnosa`);
      setPasien(res.data)
    } catch (e) {

    }
  }
  return (
    <div className="row mb-2 pb-2">
      <div className="col-md-6">
        <div className="card mb-4  border-top-primary h-100">
          <div className="card-header text-center bg-gray-100">Informasi Pasien</div>
          <div className="card-body p-0">
            <div className="table-responsive table-billing-history">
              <table className="table mb-0">
                <tbody>
                  <tr>
                    <td className="bg-dark-900">Nomor Pendaftaran</td>
                    <td>PS-20201228-001</td>
                  </tr>
                  <tr>
                    <td className>Nama</td>
                    <td>Wandi</td>
                  </tr>
                  <tr>
                    <td className>Tempat Tgl Lahir</td>
                    <td>Bantaen, 10 December 1996</td>
                  </tr>
                  <tr>
                    <td className>Umur</td>
                    <td>24 Years</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div className="col-md-6">
        <div className="card mb-4  border-top-primary h-100">
          <div className="card-header text-center bg-gray-100 text-gray-900">Informasi Terkait</div>
          <div className="card-body p-0">
            {/* Billing history table*/}
            <div className="table-responsive table-billing-history">
              <table className="table mb-0">
                <tbody>
                  <tr>
                    <td className="bg-dark-900">Tujuan Poliklinik</td>
                    <td>UMUM</td>
                  </tr>
                  <tr>
                    <td className>Tanggal Sekarang</td>
                    <td>238am1231amUTC124, 29 December 2020</td>
                  </tr>
                  <tr>
                    <td className>Jenis Layanan</td>
                    <td>umum</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

  );
};

export default Pasien;
if (document.querySelector('#pasien-diagnosa')) {
  let elPasien = document.querySelector('#pasien-diagnosa');
  ReactDOM.render(<Pasien />, elPasien);
}