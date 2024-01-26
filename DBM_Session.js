/**
 * @author Korentin Massif
 * @version 1.0
 * 
 * @file Gestion of the session table
 */

const mysql = require('mysql');
const fs = require('fs');
const Session = require("./Session")
const Logger = require("./Log")

const config = JSON.parse(fs.readFileSync('DB_Config.json', 'utf-8'));

class DSession
{
    /** @private Link to the database*/                          #host = config.database.host;
    /** @private Username to connect to the database*/           #user = config.database.user;
    /** @private Password to connect to the database*/           #password = config.database.password;
    /** @private Name of the database you want to work in*/      #database_name = config.Session.status ? "Session" : null;
    /** @private Connection object used to log in the database*/ #connection;
    /** @private Logger object used to log messages*/            #logger = new Logger()

    /**
     * Set up the connection with the database.
     * If the table does not exist, it will be created
     * 
     * @constructor
     * @this {DSession}
     */
    constructor()
    {
        this.#connection = mysql.createConnection({
            host: this.#host,
            user: this.#user,
            password: this.#password,
            database: this.#database_name
        });
        if(!config.Session.status) // check if the table is created
        {
            this.connect();
            this.#connection.query(config.Session.query, (error) => {
                if (error) 
                {
                    this.#logger("SESSION", "ERROR", `Cannot create the database : ${error}`);
                    throw error;
                }
                this.#logger("SESSION", "SUCCES", "Table created");
              });
            this.close();
            this.#database_name = "Session";
            this.#connection = mysql.createConnection({
                host: this.#host,
                user: this.#user,
                password: this.#password,
                database: this.#database_name
            });
            config.Session.status = true;
            fs.writeFileSync('DB_Config.json', JSON.stringify(config, null, 2));
        };
    }

    /**
     * Connect to the database
     */
    connect()
    {
        this.#connection.connect((error) => 
        {
            if (error) 
            {
                this.#logger("SESSION", "ERROR", `Cannot connect to the database : ${error}`);
                return;
            }
            this.#logger("SESSION", "INFO", "Connected to the database");
        });
    }

    /**
     * Close the connection to the database
     */
    close()
    {
        this.#connection.end((error) => 
        {
            if (error) 
            {
                this.#logger("SESSION", "ERROR", `Cannot close the database : ${error}`);
                return;
            }
            this.#logger("SESSION", "INFO", "Closed the database");
        });
    }

    /**
     * Add a session into the database
     * @param {Session} session 
     */
    addUser(session)
    {
        query = "INSERT INTO Session (patient_id, user_id, session_type, session_date, session_time) VALUES (?, ?, ?, ?, ?)";
        data = [session.getPatientId(), session.getUserId(), session.getSessionType(), session.getSessionDate(), session.getSessionTime()];
        this.connect();
        this.#connection.query(query, data, (error) => {
            if (error) 
            {
                this.#logger("SESSION", "ERROR", `Cannot insert in the database : ${error}`);
                throw error;
            }
            this.#logger("SESSION", "SUCCES", "Session inserted");
        });
        this.close();
    }
}

module.exports = DSession;