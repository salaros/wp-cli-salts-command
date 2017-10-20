# WP-CLI Salt Command
Manage salts for your WordPress installation

## Output salts to STDOUT

```
wp salts generate
```

This will grab new salts from the [WordPress Salt API](https://api.wordpress.org/secret-key/1.1/salt/) and output it to the `STDOUT`

## Output salts to a file

```
wp salts generate --file=/absolute/path/to/file.php
```

This will output the salts to a file. Because the file contains the complete `define()` code the salts will be set by a simple `require` somewhere in your wp-config.php

## Output salts as env vars

```
wp salts generate --format=env --file=/absolute/path/to/.env
```

This will output the salts as shell environment variables. Useful for projects that load configurations from .env files.

## Output salts as Yaml config file

```
wp salts generate --format=yaml --file=/absolute/path/to/file.yaml
```

This will output the salts as Yaml config file.
