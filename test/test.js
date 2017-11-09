/* global describe, it */
var assert = require('assert')
var jsonMultilineStrings = require('../src/json-multiline-strings')

describe('jsonMultilineStrings.split', function () {
  it('simple', function () {
    var input = { foo: 'bar', long: 'text with\nseveral\nline breaks', number: 5 }
    var expected = { foo: 'bar', long: [ 'text with', 'several', 'line breaks' ], number: 5 }

    assert.deepEqual(expected, jsonMultilineStrings.split(input))
  })

  it('exclude', function () {
    var input = { foo: 'bar', long: 'text with\nseveral\nline breaks', excluded: 'text with\nseveral\nline breaks', number: 5 }
    var expected = { foo: 'bar', long: [ 'text with', 'several', 'line breaks' ], excluded: 'text with\nseveral\nline breaks', number: 5 }

    assert.deepEqual(expected, jsonMultilineStrings.split(input, {
      exclude: [ [ 'excluded' ] ]
    }))
  })

  it('string only', function () {
    var input = 'text without line breaks'
    var expected = 'text without line breaks'

    assert.deepEqual(expected, jsonMultilineStrings.split(input))
  })

  it('multiline string only', function () {
    var input = 'text with\nseveral\nline breaks'
    var expected = [ 'text with', 'several', 'line breaks' ]

    assert.deepEqual(expected, jsonMultilineStrings.split(input))
  })
})

describe('jsonMultilineStrings.join', function () {
  it('simple', function () {
    var input = { foo: 'bar', long: [ 'text with', 'several', 'line breaks' ], nojoin: [ 'this no join', 1 ] }
    var expected = { foo: 'bar', long: 'text with\nseveral\nline breaks', nojoin: [ 'this no join', 1 ] }

    assert.deepEqual(expected, jsonMultilineStrings.join(input))
  })

  it('exclude', function () {
    var input = { foo: 'bar', long: [ 'text with', 'several', 'line breaks' ], excluded: [ 'text with', 'several', 'line breaks' ], nojoin: [ 'this no join', 1 ] }
    var expected = { foo: 'bar', long: 'text with\nseveral\nline breaks', excluded: [ 'text with', 'several', 'line breaks' ], nojoin: [ 'this no join', 1 ] }

    assert.deepEqual(expected, jsonMultilineStrings.join(input, {
      exclude: [ [ 'excluded' ] ]
    }))
  })

  it('string only', function () {
    var input = 'text without line breaks'
    var expected = 'text without line breaks'

    assert.deepEqual(expected, jsonMultilineStrings.join(input))
  })

  it('multiline string only', function () {
    var input = [ 'text with', 'several', 'line breaks' ]
    var expected = 'text with\nseveral\nline breaks'

    assert.deepEqual(expected, jsonMultilineStrings.join(input))
  })
})
