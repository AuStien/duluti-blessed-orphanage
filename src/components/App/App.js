import { Route, Routes } from 'react-router';
import Header from '../Header/Header';
import './App.css';

function App() {
  return (
    <div className="App">
      <Routes>
        <Route path='/' element={<Header />} />
      </Routes>
    </div>
  );
}

export default App;
