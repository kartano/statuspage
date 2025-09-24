# Statuspage
Library to allow (I hope) easier manipulation of Statuspage files (typically Atlassian).

## Incidents
Load from raw JSON or supply a URL to load from.

```php
$statuspage = Statuspage::getFromURL('https://www.the.site/v2/incidents.json');
```

## Summary

```php
$summary = Summary::getFromURL('https://www.the.site/v2/summary.json');
```

## Components

```php
$components = Components::getFromURL('https://www.the.site/v2/components.json');
```

## Maintenances
### Upcoming
To do.
### Active
To do.

## License

[MIT License](LICENSE)
