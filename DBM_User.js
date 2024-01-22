/**
 * @author Korentin Massif
 * @version 1.0
 * 
 * @file Gestion of the user table
 */

const mysql = require('mysql');
const fs = require('fs');
const User = require("./User")
const Logger = require("./Log")

const config = JSON.parse(fs.readFileSync('DB_Config.json', 'utf-8'));

class DUser
{
    /** @private Link to the database*/                          #host = config.database.host;
    /** @private Username to connect to the database*/           #user = config.database.user;
    /** @private Password to connect to the database*/           #password = config.database.password;
    /** @private Name of the database you want to work in*/      #database_name = config.User.status ? "User" : null;
    /** @private Connection object used to log in the database*/ #connection;
    /** @private Logger object used to log messages*/            #logger = new Logger()

    /**
     * Set up the connection with the database.
     * If the table does not exist, it will be created
     * 
     * @constructor
     * @this {DUser}
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
            this.#connection.query(config.User.query, (error) => {
                if (error) 
                {
                    this.#logger("USER", "ERROR", `Cannot create the database : ${error}`);
                    throw error;
                }
                this.#logger("USER", "SUCCES", "Table created");
              });
            this.close();
            this.#database_name = "User";
            this.#connection = mysql.createConnection({
                host: this.#host,
                user: this.#user,
                password: this.#password,
                database: this.#database_name
            });
            config.User.status = true;
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
                this.#logger("USER", "ERROR", `Cannot connect to the database : ${error}`);
                return;
            }
            this.#logger("USER", "INFO", "Connected to the database");
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
                this.#logger("USER", "ERROR", `Cannot close the database : ${error}`);
                return;
            }
            this.#logger("USER", "INFO", "Closed the database");
        });
    }

    /**
     * Add a user into the database
     * @param {User} user 
     */
    addUser(user)
    {
        query = "INSERT INTO User (name, forname, username, password) VALUES (?, ?, ?, ?)";
        data = [user.getName(), user.getForname(), user.getUsername(), user.getPassword()];
        this.connect();
        this.#connection.query(query, data, (error) => {
            if (error) 
            {
                this.#logger("USER", "ERROR", `Cannot insert in the database : ${error}`);
                throw error;
            }
            this.#logger("USER", "SUCCES", "User inserted");
        });
        this.close();
    }
}

module.exports = DUser;