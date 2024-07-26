.PHONY: .build .test-container

.build:
	@docker build -f buildsrc/Dockerfile  --no-cache --progress plain -t cms-frontend-api:latest .

.test-container:
	@docker image exists cms-frontend-api-test || docker build -f tests/buildsrc/Dockerfile.unittest --no-cache --progress plain -t cms-frontend-api-test:latest --target test .

run: .build
	@docker run --rm -p 1080:80 cms-frontend-api:latest

test:
	@docker run --rm -it -v "./tests:/var/www/html/tests" cms-frontend-api-test:latest ./vendor/bin/phpunit tests/endpointTest.php

clean:
	@docker image rm cms-frontend-api:latest cms-frontend-api-test:latest || true