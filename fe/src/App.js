import logo from './logo.svg';
import './App.css';
import Header from './components/Header/Header';
import Slider from './components/Carousel/Carousel';
import Search from './components/Search/Search';
import ListTourSuggest from './Page/ListTourSuggest/ListTourSuggest';

function App() {
  return (
    <div className="App">
      <Header/>
      <Slider/>
      <Search/>
      <ListTourSuggest/>
    </div>
  );
}

export default App;
