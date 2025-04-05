import './bootstrap';
import '../css/app.css';
import 'boxicons';



import Alpine from 'alpinejs';
import collapse from '@alpinejs/collapse';

window.Alpine = Alpine;

Alpine.start();

Alpine.plugin(collapse);
