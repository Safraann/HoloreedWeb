/**
 * @author Korentin Massif
 * @version 1.0
 * 
 * @file Gestion of the patient table
 */

const mysql = require('mysql');
const fs = require('fs');
const Patient = require("./Patient")
const Logger = require("./Log")

const config = JSON.parse(fs.readFileSync('DB_Config.json', 'utf-8'));

class DPatient
{
    /** @private Link to the database*/                          #host = config.database.host;
    /** @private Username to connect to the database*/           #user = config.database.user;
    /** @private Password to connect to the database*/           #password = config.database.password;
    /** @private Name of the database you want to work in*/      #database_name = config.User.status ? "Patient" : null;
    /** @private Connection object used to log in the database*/ #connection;
    /** @private Logger object used to log messages*/            #logger = new Logger()

    /**
     * Set up the connection with the database.
     * If the table does not exist, it will be created
     * 
     * @constructor
     * @this {DPatient}
     */
    constructor()
    {
        this.#connection = mysql.createConnection({
            host: this.#host,
            user: this.#user,
            password: this.#password,
            database: this.#database_name
        });
        if(!config.User.status) // check if the table is created
        {
            this.connect();
            this.#connection.query(config.Patient.query, (error) => {
                if (error) 
                {
                    this.#logger("PATIENT", "ERROR", `Cannot create the database : ${error}`);
                    throw error;
                }
                this.#logger("PATIENT", "SUCCES", "Table created");
              });
            this.close();
            this.#database_name = "Patient";
            this.#connection = mysql.createConnection({
                host: this.#host,
                user: this.#user,
                password: this.#password,
                database: this.#database_name
            });
            config.Patient.status = true;
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
                this.#logger("PATIENT", "ERROR", `Cannot connect to the database : ${error}`);
                return;
            }
            this.#logger("PATIENT", "INFO", "Connected to the database");
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
                this.#logger("PATIENT", "ERROR", `Cannot close the database : ${error}`);
                return;
            }
            this.#logger("PATIENT", "INFO", "Closed the database");
        });
    }

    /**
     * Add a user into the database
     * @param {Patient} patient
     */
    addUser(patient)
    {
        query = "INSERT INTO Patient (name, forname, birthday, about) VALUES (?, ?, ?, ?)";
        data = [patient.getName(), patient.getForname(), patient.getBirthday(), patient.getAbout()];
        this.connect();
        this.#connection.query(query, data, (error) => {
            if (error) 
            {
                this.#logger("PATIENT", "ERROR", `Cannot insert in the database : ${error}`);
                throw error;
            }
            this.#logger("PATIENT", "SUCCES", "Patient inserted");
        });
        this.close();
    }
}

module.exports = DPatient;
