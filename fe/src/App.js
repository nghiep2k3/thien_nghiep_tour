import logo from './logo.svg';
import './App.css';
import Header from './components/Header/Header';
import Slider from './components/Carousel/Carousel';
import Search from './components/Search/Search';

function App() {
  return (
    <div className="App">
      <Header/>
      <Slider/>
      <Search/>
    </div>
  );
}

export default App;
