![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg)
![PHP](https://badgen.net/badge/php/8.4/green?icon=php)
# Statuspage
Library to allow (I hope) easier manipulation of Statuspage files (typically Atlassian).

## Incidents
Load from raw JSON or supply a URL to load from.

```php
// Load directly from a URL
$statuspage = Statuspage::getFromURL('https://www.the.site/v2/incidents.json');

// Load using an unencoded JSON raw string
$statuspage = Statuspage::getFromJSONString($somestring);
```

## Summary

```php
// Load directly from a URL
$summary = Summary::getFromURL('https://www.the.site/v2/summary.json');

// Load using an unencoded JSON raw string
$summary = Summary::getFromJSONString($somestring);
```

## Components

```php
// Load directly from a URL
$components = Components::getFromURL('https://www.the.site/v2/components.json');

// Load using an unencoded JSON raw string
$components = Components::getFromJSONString($somestring);
```

## Maintenances
### Upcoming
To do.
### Active
To do.

## License

[MIT License](LICENSE)
