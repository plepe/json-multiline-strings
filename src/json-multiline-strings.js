function reducePath (paths, currentPath) {
  var ret = paths.filter(function (path) {
    return path.length && path[0] === currentPath
  })

  ret = ret.map(function (path) {
    return path.slice(1)
  })

  return ret
}

function pathReached (paths) {
  for (var i = 0; i < paths.length; i++) {
    if (paths[i].length === 0) {
      return true
    }
  }

  return false
}

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

  if (options.exclude && pathReached(options.exclude)) {
    return data
  }

  if (isStringArray(data)) {
    return data.join('\n')
  }

  if (typeof data === 'object') {
    for (var k in data) {
      var nextOpt = JSON.parse(JSON.stringify(options))

      if (options.exclude) {
        nextOpt.exclude = reducePath(options.exclude, k)
      }

      data[k] = join(data[k], nextOpt)
    }
  }

  return data
}

function split (data, options) {
  if (!options) {
    options = {}
  }

  if (options.exclude && pathReached(options.exclude)) {
    return data
  }

  if (typeof data === 'string') {
    if (data.search('\n') !== -1) {
      return data.split(/\n/g)
    }

    return data
  }

  if (typeof data === 'object') {
    for (var k in data) {
      var nextOpt = JSON.parse(JSON.stringify(options))

      if (options.exclude) {
        nextOpt.exclude = reducePath(options.exclude, k)
      }

      data[k] = split(data[k], nextOpt)
    }
  }

  return data
}

module.exports = {
  join: join,
  split: split
}
