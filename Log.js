/**
 * @author Korentin Massif
 * @version 0.1
 * 
 * @file Creating log file to trace website management
 */
const fs = require('fs');


class Logger {
    /** @private Path to the log file*/             #path = "DB.log";
    /** @private Options used to display the date*/ #options = {year: 'numeric', month: 'numeric', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: false, timeZone: 'Europe/Paris'};
    
    constructor() {}
    /**
     * Function used to log into the file
     * @param {string} table      Name of the table you are working in
     * @param {string} userStatus Status of the message (ERROR, INFO, SUCCES ...)
     * @param {string} message 
     */
    log(table, userStatus, message) {
        const userLog = `${table}\t| ${new Date().toLocaleDateString('fr-FR', this.#options)}\t| ${userStatus}\t| ${message}\n`;

        fs.appendFile(this.#path, userLog, (err) => {})
    }
}

module.exports = Logger;
