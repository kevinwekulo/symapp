/*
 * Welcome to your app's main JavaScript file!
 *
 * This file will be included onto the page via the importmap() Twig function,
 * which should already be in your base.html.twig.
 */
import './styles/app.css';
import 'bootstrap/dist/css/bootstrap.min.css';

import Duck from  './js/duck.js';
import { Alert } from 'bootstrap';

const duck = new Duck('Waddles');
duck.quack();

// Manually dismiss the alert after 5 seconds
setTimeout(() => {
    const myAlert = document.getElementById('myAlert');
    const bsAlert = Alert.getOrCreateInstance(myAlert);
    bsAlert.close();
  }, 5000);