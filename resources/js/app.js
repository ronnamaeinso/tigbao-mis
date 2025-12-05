import './bootstrap';
import '../../node_modules/bootstrap/dist/js/bootstrap.bundle.js';
import Swal from 'sweetalert2';
import Chart from 'chart.js/auto'

window.Swal = Swal;
window.token = document.querySelector('meta[name="csrf-token"]').content;
window.Chart = Chart;
