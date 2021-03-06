help:
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m * %s\033[0m %s\n", $$1, $$2}'

install: ## Install the dependencies
	docker-compose -f server/docker-compose.yaml run php composer install --dev

test: ## Run the automated tests
	docker-compose -f server/docker-compose.yaml run php vendor/bin/phpunit

serve: ## Run the server on port 8080
	docker-compose -f server/docker-compose.yaml up
