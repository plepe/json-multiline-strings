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

function join (data) {
  for (var k in data) {
    if (isStringArray(data[k])) {
      data[k] = data[k].join('\n')
    } else if (typeof data[k] === 'object') {
      data[k] = join(data[k])
    }
  }

  return data
}

function split (data) {
  for (var k in data) {
    if (typeof data[k] === 'string' && data[k].search('\n') !== -1) {
      data[k] = data[k].split(/\n/g)
    } else if (data[k] !== null && data[k][Symbol.iterator]) {
      data[k] = split(data[k])
    }
  }

  return data
}

module.exports = {
  join: join,
  split: split
}
