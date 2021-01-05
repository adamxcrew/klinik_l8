import Axios from "axios";
import { atom } from "recoil";

export const getPasien = atom({
  key: 'pasien',
  default: async () => {
    let keyPas = localStorage.getItem("pasienId");
    if (!keyPas)
      return null;
    try {
      let res = await Axios.get(`pasien/${keyPas}`);
      return res.data;
    } catch (error) {
      console.log(`Error : ${error.response.message}`);
      return null
    }
  },
});