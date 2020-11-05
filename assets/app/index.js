//import files
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';
import './styles/app.css';

//global variables
import jQuery from 'jquery';
window.$ = jQuery;

//import modules
import Form from "./js/form";

//launch modules
let form = new Form();
form.initHandlers();