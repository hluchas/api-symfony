# Test API in Symfony

Task is not complete to all details as mentioned in API doc section. It is not problem to do everything, but I need to save my time.

### Build

```bash
git clone git@github.com:hluchas/api-symfony.git
cd api-symfony
./build.sh
```

* Go to [http://127.0.0.1](http://127.0.0.1)

### API doc

* Go to [http://127.0.0.1/doc](http://127.0.0.1/doc)

Is not complete as there are not mentioned non 200 status codes, validation messages etc. I would need more research in Swagger doc for this.

### Tests runner & environment

```bash
./test.sh
```

Used for automated testing. Server is running on different port with different app settings and database connection.
Check `.env.test` file.

Implemented tests are simple unit and API acceptance test with HTTP requests touching API.

### XDebug

- server : 127.0.0.1
- port : 9002
- IDE key : PHPSTORM

Remember to use correct path mappings to `/war/www/symfony`

### My requirements

- [x] Docker
- [x] FOSRest bundle with proper configuration
- [x] ParamConverter implementation to simplify API
- [x] PHPUnit
- [x] PHPCS fixer
- [x] PHPSTAN checks
- [x] PHPUnit test  run
- [x] XDebug enabled for dev env
- [x] Normalizer for FOSRest exception responses (non 200 OK) to json
- [ ] ~~Normalizer for invalid POST data responses (now it is too complex to read, should be simplified)~~ - Already
  normalized to easy readable format
- [ ] ~~API versioning - https://symfony.com/doc/current/bundles/FOSRestBundle/versioning.html~~
- [x] Swagger for API doc
- [x] Acceptance API test
- [ ] ~~Acceptance (integration) testing suite - used codeception. Developer must be able to write against these test suites without manually sending requests via Postman.~~

### Missing and should be implemented in CI
1. Code coverage checks
2. Codeception implementation in CI
