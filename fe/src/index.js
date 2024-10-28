import React from 'react';
import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom';
import 'bootstrap/dist/css/bootstrap.min.css';
import ReactDOM from 'react-dom/client';
import './index.css';
import App from './App';
import reportWebVitals from './reportWebVitals';
import { Provider } from "react-redux";
import store from './Redux/store';
import Home from './Page/Home/Home';
import Test from './Page/Test/Test';



const root = ReactDOM.createRoot(document.getElementById('root'));
root.render(
  <React.StrictMode>
    <Router>
      <Provider store={store}>
        <Routes>
          <Route path="/" element={<App />} >
            <Route index element={<Home />} />
            <Route path='/test' element={<Test />} />
          </Route>

        </Routes>


      </Provider>
    </Router>
  </React.StrictMode>
);

// If you want to start measuring performance in your app, pass a function
// to log results (for example: reportWebVitals(console.log))
// or send to an analytics endpoint. Learn more: https://bit.ly/CRA-vitals
reportWebVitals();
