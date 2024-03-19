# Duluti Blessed Orphanage

Home of the source code for https://dulutiorphanage.org (this orphanage needs all the help it can get, so a [donation](https://dulutiorphanage.org/donate) of any size would be of great help).

---

The HTML files are templated using the `html/template` standard Go library, meaning this repo contains no [external Go dependencies](/go.mod), and no self written JavaScript.

## Running

Running this website locally requires two simple steps:

1. `make generate`: Generate all HTML files and copy assets to the `dist` folder
2. `make run-server`: Run a simple server serving the static files

The site is now hosted at http://localhost:3000.

_Note that the page where you would donate money directly from the website ([/donation/index.html](https://dulutiorphanage.org/donation/index.php)) doesn't work locally, as it was written in PHP by someone else in 2016, and serving PHP from a Go server doesn't seem like a trivial task._

## Development

The [Makefile](/Makefile) has some targets for making development more convenient:

- `make watch-generate`: Will download [Air](https://github.com/cosmtrek/air) to a local `/bin` folder, and use it to watch all relevant files to trigger new generation of templates on each save
- `make run-serve`: Will start a static file server on port `3000`

_For more fine-grained control over when generation is run, use `make generate`._

### Generating thumbnails for images in the gallery

The images in the [gallery](https://dulutiorpahange.org/gallery) require a thumbnail, which belongs in the [/assets/img/gallery/thumbnail](/assets/img/gallery/thumbnail) folder.

These images need to retain the aspect ratio of the original image, but reduce the width to 300.
The name of the image needs to be `thumb.<original-image-name-with-extention>`.

_Note that currently only `.jpg` and `.jpeg` are supported, but more formats can be supported by importing the corresponding standard library in the `/cmd/generate/main.go` file.<br />Ex: `import _ "image/png"` (for more info, see [go docs](https://pkg.go.dev/image))._

Below is an example Bash script using [ImageMagick](https://imagemagick.org/index.php) to automatically generate thumbnails for all images in a folder.

```bash
#!/bin/sh

# Generate thumbnails for all images in the current directory
for i in *.jpg; do
  echo "Processing image $i ..."
  convert -thumbnail 300 $i thumb.$i
done
```

### Updating contact persons

To update the people in the [contact](https://dulutiorphanage.org/contact) page, simply update the `Persons` variable in [/contact/contact.go](/contact/contact.go).
