window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.baseUrl = "http://127.0.0.1:8001/";
window.baseApiUrl = "http://127.0.0.1:8001/api/";
require('alpinejs');
// delete React
require("./components/Delete/index");
require("./components/status/index");
require("./components/Upload/ImgProfile");
require("./View/Pasien/index");


