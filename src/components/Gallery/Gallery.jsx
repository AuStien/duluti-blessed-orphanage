import ImageGallery from "react-image-gallery"
import "./image-gallery.css";

const images = require("./images.json")

export default function Gallery() {
  return <ImageGallery items={images.map(i => {
    return {
      "original": "/images/" + i,
      "thumbnail": "/images/thumbnails/tn-" + i,
      "originalHeight": "600px"
    }
  })}
  />
}