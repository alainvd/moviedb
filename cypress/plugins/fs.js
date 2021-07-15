const { rmdir } = require('fs')
const readXlsxFile = require('read-excel-file/node')

module.exports = {
    deleteFolder(folderName) {
      console.log('deleting folder %s', folderName)

      return new Promise((resolve, reject) => {
        rmdir(folderName, { maxRetries: 10, recursive: true }, (err) => {
          if (err) {
            console.error(err)

            return reject(err)
          }

          resolve(null)
        })
      })
    },

    readExcelFile({filename, sheet }) {
      sheet = sheet || 1
      return readXlsxFile(filename, {sheet})
    }
}
