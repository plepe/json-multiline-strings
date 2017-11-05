/* global describe, it */
var assert = require('assert')
var jsonMultilineStrings = require('../src/json-multiline-strings')

describe('jsonMultilineStrings.split', function () {
  it('simple', function () {
    var input = { foo: 'bar', long: 'text with\nseveral\nline breaks' }
    var expected = { foo: 'bar', long: [ 'text with', 'several', 'line breaks' ] }

    assert.deepEqual(expected, jsonMultilineStrings.split(input))
  })
})

describe('jsonMultilineStrings.join', function () {
  it('simple', function () {
    var input = { foo: 'bar', long: [ 'text with', 'several', 'line breaks' ], nojoin: [ 'this no join', 1 ] }
    var expected = { foo: 'bar', long: 'text with\nseveral\nline breaks', nojoin: [ 'this no join', 1 ] }

    assert.deepEqual(expected, jsonMultilineStrings.join(input))
  })
})
