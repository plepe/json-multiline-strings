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

# INSTALL
## Development
```sh
git clone https://github.com/plepe/json-multiline-strings.git
cd json-multiline-strings
npm install
composer install
```
