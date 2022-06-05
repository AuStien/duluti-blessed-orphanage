import "./Navbar.css"

export default function Navbar() {
  return (
  <div className="navbar-container">
    <span className="navbar-item" onClick={() => window.location = "/"}>Home</span>
    <span className="navbar-item" onClick={() => window.location = "/gallery"}>Gallery</span>
    <span className="navbar-item" onClick={() => window.location = "/contact"}>Contact</span>
    <span className="navbar-item" onClick={() => window.location = "/donate"}>Donate</span>
  </div>)
}