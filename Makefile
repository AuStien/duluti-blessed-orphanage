fmt:
	go fmt ./...

vet:
	go vet ./...

generate: fmt vet
	go run cmd/generate/main.go

watch-generate: air
	$(AIR) --build.cmd "go build -o bin/generate cmd/generate/main.go" --build.bin "./bin/generate" --build.exclude_dir "dist,bin,cmd/server"

run-server: fmt vet
	go run cmd/server/main.go

## Location to install dependencies to
LOCALBIN ?= $(shell pwd)/bin
$(LOCALBIN):
	mkdir -p $(LOCALBIN)

AIR ?= $(LOCALBIN)/air

.PHONY: air
air: $(AIR) ## Download air locally if necessary.
$(AIR): $(LOCALBIN)
	test -s $(LOCALBIN)/air || GOBIN=$(LOCALBIN) go install github.com/cosmtrek/air@latest

