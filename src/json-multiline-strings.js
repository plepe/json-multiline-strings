function isStringArray (arr) {
  if (!Array.isArray(arr)) {
    return false
  }

  var nonStringElements = arr.filter(function (x) {
    return typeof x !== 'string'
  })

  if (nonStringElements.length) {
    return false
  }

  return true
}

function join (data, options) {
  if (!options) {
    options = {}
  }

  if (isStringArray(data)) {
    return data.join('\n')
  }

  if (typeof data === 'object') {
    for (var k in data) {
      data[k] = join(data[k])
    }
  }

  return data
}

function split (data, options) {
  if (!options) {
    options = {}
  }

  if (typeof data === 'string') {
    if (data.search('\n') !== -1) {
      return data.split(/\n/g)
    }

    return data
  }

  if (typeof data === 'object') {
    for (var k in data) {
      data[k] = split(data[k])
    }
  }

  return data
}

module.exports = {
  join: join,
  split: split
}
