package main

import (
	"log/slog"
	"net/http"
)

func main() {
	http.Handle("/", http.FileServer(http.Dir("./dist")))

	slog.Info("Listening on 3000")
	panic(http.ListenAndServe(":3000", nil))
}
