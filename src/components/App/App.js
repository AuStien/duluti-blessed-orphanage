import { Route, Routes } from 'react-router';
import Header from '../Header/Header';
import Home from '../Home/Home';

import './App.css';

function App() {
  return (
    <div className="App">
      <Header />
      <Routes>
        <Route path='/' element={<Home />} />
      </Routes>
    </div>
  );
}

export default App;
