import Axios from 'axios';
import React, { useState } from 'react';
import ReactDOM from 'react-dom';
import swal from 'sweetalert';

const Delete = ({ endpoint }) => {
  const [isDelete, setIsDelete] = useState(false)
  const deleteMe = (e) => {
    const trClose = e.currentTarget.parentNode.parentNode.parentNode;

    swal("Are you sure?", {
      dangerMode: true,
      buttons: true,
    }).then(async jawaban => {
      if (jawaban) {
        setIsDelete(true)
        try {
          let res = await Axios.delete(endpoint);
          if (res.data.status)
            trClose.remove();
          else
            swal({
              icon: "error",
              text: "Gagal Menghapus"
            });
        } catch (error) {
          swal({
            icon: "error",
            text: error.message
          })
        }

      }
      setIsDelete(false)
    });
  }
  return (
    <div className={`btn ${!isDelete ? " btn-danger" : ''}`} onClick={deleteMe}>
      {isDelete ?
        <div className="spinner-border" role="status">
          <span className="sr-only">Loading...</span>
        </div>
        : "Delete"}
    </div>
  );
};

export default Delete;
if (document.querySelectorAll('.delete')) {
  let deletesNode = document.querySelectorAll('.delete');
  deletesNode.forEach(deleteNode => {
    ReactDOM.render(<Delete endpoint={deleteNode.getAttribute("endpoint")} />, deleteNode);
  })
}