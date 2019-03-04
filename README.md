# WordPress PurAí REST API
Module in [WordPress REST API](https://developer.wordpress.org/rest-api/) with custom wp-json and [Post Types](https://codex.wordpress.org/Post_Types). Includes WP theme and docker that provides a develop environment.

![WordPress](/screenshots/wordpress.png "WordPress")

## Documentation
Used [Restsplain](https://github.com/humanmade/Restsplain) to document and test.
```
http://localhost:8081/api-docs/
```

## Getting a Token

Send a `POST` request to `http://localhost:8081/jwt-auth/v1/token`. 

#### Curl request example
```
curl -XGET http://localhost:8081/jwt-auth/v1/token
```

## GraphQL Endpoint

Use [wp-graphql](https://github.com/wp-graphql/wp-graphql) plugin that provide a GraphQL endpoint at `http://localhost:8081/graphql`. The plugin must be installed and pretty permalinks enabled.

![GraphQL](/screenshots/graphql.png "GraphQL")

## Event Endpoints

#### GET `http://localhost:8081/wp-json/purai/v1/events`
List all events from WordPress dashboard

| Parameter | Type | Required | Description
| --------- | ---- | -------- | ----------- |
| `status` | string | :x: | GET filtered by any WP status type. (Default is `future`) |
| `slug` | string | :x: | GET filtered by slug |
| `per-page` | int | :x: | GET filtered by limit informed. If not informed returns all records |
| `category` | string | :x: | GET filtered by category slug |
| `today` | int | :x: | GET filtered events by current date |
| `city` | string | :x: | GET filtered by city slug |
| `featured` | int | :x: | GET filtered by featured events. (1: Yes, 0: No) |
| `trending` | int | :x: | GET filtered by trending events. (1: Yes, 0: No) |

#### Event data response example
```json
[
    {
        "id": 1,
        "guid": "http://localhost:8081/?post_type=events&#038;p=5",
        "slug": "sample-event",
        "status": "future",
        "featured": "0",
        "title": "Sample Event",
        "image": "http://localhost:8081/wp-content/uploads/2019/01/image.jpeg",
        "thumbnail": "http://localhost:8081/wp-content/uploads/2019/01/thumbnail.jpeg",
        "about": "Sample event description",
        "price": "U$100,00",
        "date_raw": "2019-01-01 08:00:00",
        "date": "01/01/2019 at 08:00pm",
        "contact": "Get in touch on (877) 412–7753",
        "address": "Cupertino, CA 95014",
        "where": "Apple Campus",
        "city": {
            "slug": "cupertino",
            "title": "Cupertino"
        },
        "category": {
            "slug": "concerts",
            "title": "Concerts"
        },
        "where_to_buy": {
            "slug": "buy-your-ticket",
            "title": "Buy Your Ticket",
            "url": "http://www.buyyourticket.com"
        }
    }
]
```

#### GET `http://localhost:8081/wp-json/purai/v1/event/{slug}`
List event by event slug

```json
{
    "id": 1,
    "guid": "http://localhost:8081/?post_type=events&#038;p=5",
    "slug": "sample-event",
    "status": "future",
    "featured": "0",
    "title": "Sample Event",
    "image": "http://localhost:8081/wp-content/uploads/2019/01/image.jpeg",
    "thumbnail": "http://localhost:8081/wp-content/uploads/2019/01/thumbnail.jpeg",
    "about": "Sample event description",
    "price": "U$100,00",
    "date_raw": "2019-01-01 08:00:00",
    "date": "01/01/2019 at 08:00pm",
    "contact": "Get in touch on (877) 412–7753",
    "address": "Cupertino, CA 95014",
    "where": "Apple Campus",
    "city": {
        "slug": "cupertino",
        "title": "Cupertino"
    },
    "category": {
        "slug": "concerts",
        "title": "Concerts"
    },
    "where_to_buy": {
        "slug": "buy-your-ticket",
        "title": "Buy Your Ticket",
        "url": "http://www.buyyourticket.com"
    }
}
```

## Category Endpoints

#### GET `http://localhost:8081/wp-json/purai/v1/categories`
List all categories

```json
[
    {
        "slug": "concerts",
        "title": "Concerts",
        "about": "Sample text description",
        "count": 3
    },
    {
        "slug": "meetup",
        "title": "Meetup",
        "about": "Sample text description",
        "count": 2
    }
]
```

## City Endpoints

#### GET `http://localhost:8081/wp-json/purai/v1/cities`
List all cities

```json
[
    {
        "slug": "cupertino",
        "title": "Cupertino",
        "about": "Sample text description",
        "count": 1
    },
    {
        "slug": "los-angeles",
        "title": "Los Angeles",
        "about": "Sample text description",
        "count": 0
    }
]
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

## License
This project is licensed under the GNU GPLv3 License - see the [LICENSE](LICENSE) file for details

Made with :heart: by [Felipe Mendes](https://github.com/felipemendes).