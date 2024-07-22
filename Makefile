.PHONY: .build

.build:
	@docker build -f buildsrc/Dockerfile --progress plain -t cms-frontend-api:latest .

.test-container:
	@docker build -f test/buildsrc/Dockerfile.unittest --no-cache --progress plain -t cms-frontend-api-test:latest .

run: build
	@docker run --rm -p 1080:80 cms-frontend-api:latest

test: build .test-container

clean:
	@docker image rm cms-frontend-api:latest cms-frontend-api-test:latest || true