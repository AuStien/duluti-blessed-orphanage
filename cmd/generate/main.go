package main

import (
	"fmt"
	"html/template"
	"image"
	_ "image/jpeg"
	"io/fs"
	"os"
	"path/filepath"
	"strings"

	"github.com/austien/duluti-blessed-orphanage/contact"
)

func main() {
	if err := os.RemoveAll("dist"); err != nil {
		panic(err)
	}

	if err := os.Mkdir("dist", 0755); err != nil {
		panic(err)
	}

	if err := generateHTML("templates/pages"); err != nil {
		panic(err)
	}

	if err := copyAssets("assets"); err != nil {
		panic(err)
	}
}

// generateHTML
func generateHTML(folderName string) error {
	if err := filepath.WalkDir(folderName, func(path string, d fs.DirEntry, err error) error {
		if err != nil {
			return nil
		}

		if d.IsDir() {
			return nil
		}

		fileName := filepath.Base(path)

		outFile, err := os.Create(fmt.Sprintf("dist/%s", fileName))
		if err != nil {
			return err
		}
		defer outFile.Close()

		tmpl := template.Must(template.ParseFiles(path, "templates/page.html", "templates/reusables.html"))

		switch fileName {
		case "gallery.html":
			images, err := getImages()
			if err != nil {
				return err
			}

			if err := tmpl.ExecuteTemplate(outFile, "page", images); err != nil {
				return err
			}

			return nil
		case "contact.html":
			if err := tmpl.ExecuteTemplate(outFile, "page", contact.Persons); err != nil {
				return err
			}

			return nil
		default:
			if err := tmpl.ExecuteTemplate(outFile, "page", nil); err != nil {
				return err
			}

			return nil
		}
	}); err != nil {
		return err
	}
	return nil
}

func copyAssets(assetsFolder string) error {
	if err := filepath.WalkDir(assetsFolder, func(path string, d fs.DirEntry, err error) error {
		if err != nil {
			return err
		}

		if path == "assets" {
			return nil
		}

		relPath := strings.Replace(path, assetsFolder, "dist", 1)

		if d.IsDir() {
			if err := os.Mkdir(relPath, 0755); err != nil {
				return err
			}
			return nil
		}

		b, err := os.ReadFile(path)
		if err != nil {
			return err
		}

		if err := os.WriteFile(relPath, b, 0755); err != nil {
			return err
		}

		return nil
	}); err != nil {
		return err
	}
	return nil
}

type Image struct {
	Filename string
	Width    int
	Height   int
}

func getImages() ([]Image, error) {
	de, err := os.ReadDir("assets/img/gallery")
	if err != nil {
		return nil, err
	}

	var images []Image
	for _, file := range de {
		if file.IsDir() {
			continue
		}
		r, err := os.Open(fmt.Sprintf("assets/img/gallery/%s", file.Name()))
		if err != nil {
			return nil, err
		}
		defer r.Close()

		i, _, err := image.DecodeConfig(r)
		if err != nil {
			return nil, err
		}

		images = append(images, Image{
			Filename: file.Name(),
			Width:    i.Width,
			Height:   i.Height,
		})
	}

	return images, nil
}
