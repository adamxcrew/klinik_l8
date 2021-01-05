import React from 'react';
import { RecoilRoot } from 'recoil';
import { getPasien } from '../store/pasien';

const TambahPasien = () => {
  const [pasien, setPasien] = useState(getPasien);
  const [namaPasien, setNamaPasien] = useState('');
  const [namaPasien, setNamaPasien] = useState('');

  return (
    <RecoilRoot>
      {
        !pasien ? <div className="card mb-4">
          <div className="card-header">Tambah Pasien Baru</div>
          <div className="card-body">
            <form>
              <div className="form-group">
                <label className="small mb-1" htmlFor="namaPasien">Nama Pasien</label>
                <input className="form-control" id="namaPasien" type="text" placeholder="Enter your username" value={ } />
              </div>

              <div className="form-row">
                <div className="form-group col-md-6">
                  <label className="small mb-1" htmlFor="inputFirstName">First name</label>
                  <input className="form-control" id="inputFirstName" type="text" placeholder="Enter your first name" defaultValue="Valerie" />
                </div>
                {/* Form Group (last name)*/}
                <div className="form-group col-md-6">
                  <label className="small mb-1" htmlFor="inputLastName">Last name</label>
                  <input className="form-control" id="inputLastName" type="text" placeholder="Enter your last name" defaultValue="Luna" />
                </div>
              </div>
              {/* Form Row        */}
              <div className="form-row">
                {/* Form Group (organization name)*/}
                <div className="form-group col-md-6">
                  <label className="small mb-1" htmlFor="inputOrgName">Organization name</label>
                  <input className="form-control" id="inputOrgName" type="text" placeholder="Enter your organization name" defaultValue="Start Bootstrap" />
                </div>
                {/* Form Group (location)*/}
                <div className="form-group col-md-6">
                  <label className="small mb-1" htmlFor="inputLocation">Location</label>
                  <input className="form-control" id="inputLocation" type="text" placeholder="Enter your location" defaultValue="San Francisco, CA" />
                </div>
              </div>
              {/* Form Group (email address)*/}
              <div className="form-group">
                <label className="small mb-1" htmlFor="inputEmailAddress">Email address</label>
                <input className="form-control" id="inputEmailAddress" type="email" placeholder="Enter your email address" defaultValue="name@example.com" />
              </div>
              {/* Form Row*/}
              <div className="form-row">
                {/* Form Group (phone number)*/}
                <div className="form-group col-md-6">
                  <label className="small mb-1" htmlFor="inputPhone">Phone number</label>
                  <input className="form-control" id="inputPhone" type="tel" placeholder="Enter your phone number" defaultValue="555-123-4567" />
                </div>
                {/* Form Group (birthday)*/}
                <div className="form-group col-md-6">
                  <label className="small mb-1" htmlFor="inputBirthday">Birthday</label>
                  <input className="form-control" id="inputBirthday" type="text" name="birthday" placeholder="Enter your birthday" defaultValue="06/10/1988" />
                </div>
              </div>
              {/* Save changes button*/}
              <button className="btn btn-primary" type="button">Save changes</button>
            </form>
          </div>
        </div>
          : ''

      }

    </RecoilRoot>
  );
};

export default TambahPasien;