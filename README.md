# WordPress PurAí REST API
Module in [WordPress REST API](https://developer.wordpress.org/rest-api/) with custom `wp-json` for [Post Types](https://codex.wordpress.org/Post_Types). Includes WP theme and docker that provides a development environment.

![WordPress](/screenshots/wordpress.png "WordPress")

## User Endpoints

#### GET `http://localhost:8081/wp-json/purai/events`
List all events from WordPress dashboard

```json
   {
	"my-awesome-concert": {
		"id": 22,
		"slug": "my-awesome-concert",
		"title": "My Awesome Concert",
		"image": "http://localhost:8081/wp-content/uploads/2018/11/photo.jpg",
		"address": "Rua X, 123",
		"city": "Divinópolis",
		"date": "2020-01-01"
	},
	"sample-event": {
		"id": 21,
		"slug": "sample-event",
		"title": "Sample Event",
		"image": "http://localhost:8081/wp-content/uploads/2018/11/photo.jpg",
		"address": "Apple Campus, Cupertino, CA 95014, EUA",
		"city": "Cupertino",
		"date": "2019-02-12"
	}
   }
```

#### GET `http://localhost:8081/wp-json/purai/event/{slug}`
List event by event slug

```json
   {
	"id": 21,
	"slug": "sample-event",
	"title": 21,
	"image": "http://localhost:8081/wp-content/uploads/2018/11/photo.jpg",
	"address": "Apple Campus, Cupertino, CA 95014, EUA",
	"city": "Cupertino",
	"date": "2019-02-12"
   }
```
## Installing manually

Clone this repo:
```
$ git clone https://github.com/felipemendes/purai_wp_api.git
```

Add theme folder `theme/server` into any WordPress directory, like `.../wp-content/themes/`.

## Installing with Docker

Clone this repo:
```
$ git clone https://github.com/felipemendes/purai_wp_api.git
```

Start out development environment from [docker-composer.yml](./docker-compose.yml) file:

```
$ docker-compose up
```

The above command will run docker-compose in the foreground. If you would rather run it as a background process, you use the -d flag.

```
$ docker-compose up -d
```

And the application will start at `http://localhost:8081`.

### Docker util commands

#### Stopping the Environment
```
$ docker-compose stop
```

#### Destroying the Environment
```
$ docker-compose rm
```

#### List running instances
```
$ docker-compose ps
```

Made with :heart: by [Felipe Mendes](https://github.com/felipemendes).
