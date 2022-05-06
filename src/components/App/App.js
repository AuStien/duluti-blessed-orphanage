import { Route, Routes } from 'react-router';
import Contact from '../Contact/Contact';
import Gallery from '../Gallery/Gallery';
import Header from '../Header/Header';
import Home from '../Home/Home';

import './App.css';

function App() {
  return (
    <div className="App">
      <Header />
      <div className='app-body'>
        <Routes>
          <Route path='/' element={<Home />} />
          <Route path='/gallery' element={<Gallery />} />
          <Route path='/contact' element={<Contact />} />
        </Routes>
      </div>
    </div>
  );
}

export default App;
