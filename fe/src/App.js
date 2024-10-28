import logo from './logo.svg';
import './App.css';
import Header from './components/Header/Header';
import Slider from './components/Carousel/Carousel';
import Search from './components/Search/Search';
import ListTourSuggest from './Page/ListTourSuggest/ListTourSuggest';
import CardTour from './components/CardTour/CardTour';
import Test from "./Page/Test/Test"
import Home from './Page/Home/Home';
import { Outlet, } from "react-router-dom";
import TourFooter from './Page/Footer/Footer';
function App() {
  return (
    <div className="App">
      <Header />
      <Outlet />
      <TourFooter/>
    </div>
  );
}

export default App;
