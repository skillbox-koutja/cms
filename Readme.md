```shell script
docker-compose down -v --remove-orphans
docker run --rm -v ${PWD}/cms:/app --workdir=/app alpine rm -f .ready
docker-compose pull
docker-compose build
docker-compose up -d
docker run --rm -v ${PWD}/cms:/app --workdir=/app alpine touch .ready
```
