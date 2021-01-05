import React from 'react';
import ReactDOM from 'react-dom';

import { BrowserRouter, Route, Switch } from 'react-router-dom';
import { RecoilRoot } from 'recoil';
import PasienAntri from './partials/PasienAntri';

const Pasien = () => {
  console.log(baseUrl + "admin/pasien/poli-antri");
  return (
    <RecoilRoot>
      <BrowserRouter>
        <Switch>
          <Route exact path="/admin/pasien/react/">
            <div>Halo Home</div>
          </Route>
          <Route path={`/admin/pasien/react/:id/diagnosa`}>
          </Route>
          <Route path="/users">
            <div>User</div>
          </Route>
          <Route path={`/admin/pasien/react/poli-antri`}>
            <PasienAntri />
          </Route>

        </Switch>
      </BrowserRouter>
    </RecoilRoot>
  );
};

export default Pasien;
if (document.querySelector('#pasien')) {
  let elPasien = document.querySelector('#pasien');
  ReactDOM.render(<Pasien />, elPasien);
}