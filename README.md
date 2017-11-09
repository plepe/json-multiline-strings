# json-multiline-strings
One shortcoming of JSON is the lack of multiline support. This module will split/join multiline strings to string arrays which is more readable.

# EXAMPLE
Convert to multiline variant:
```json
var input = {
    "foo": "bar",
    "long": "text with\nseveral\nline breaks"
}
console.log(JSON.stringify(jsonMultilineStrings.split(input), null, '    '))
{
    "foo": "bar",
    "long": [
        "text with",
        "several",
        "line breaks"
    ]
}
```

Convert back to original json:
```json
var input = {
    "foo": "bar",
    "long": [
        "text with",
        "several",
        "line breaks"
    ]
}
console.log(JSON.stringify(jsonMultilineStrings.join(input), null, '    '))
{
    "foo": "bar",
    "long": "text with\nseveral\nline breaks"
}
```

# API
## jsonMultilineStrings.split(data, options) resp. jsonMultilineStringsSplit(data, options)
Processes input data recursively and convert all multiline strings to string arrays.

Options:
- exclude: Exclude the following paths from modifications. Give an array of string arrays, e.g. [ [ 'foo', 'bar' ], [ 'test' ] ]. This would not modify the paths 'foo/bar' and 'test'.

## jsonMultilineStrings.join(data, options) resp. jsonMultilineStringsJoin(data, options)
Processes input data recursively and convert all string arrays to multiline strings.

Options:
- exclude: Exclude the following paths from modifications. Give an array of string arrays, e.g. [ [ 'foo', 'bar' ], [ 'test' ] ]. This would not modify the paths 'foo/bar' and 'test'.

# INSTALL
## JS usage via npm
```sh
npm install --save json-multiline-strings
```

```js
var jsonMultilineStrings = require('json-multiline-strings')
jsonMultilineStrings.split(...)
jsonMultilineStrings.join(...)
```

## PHP usage via composer
```sh
composer install plepe/json-multiline-strings
```

```php
jsonMultilineStringsSplit(...)
jsonMultilineStringsJoin(...)
```

## Development
```sh
git clone https://github.com/plepe/json-multiline-strings.git
cd json-multiline-strings
npm install
composer install
```
