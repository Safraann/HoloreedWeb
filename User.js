/**
 * @author Korentin Massif
 * @version 0.1
 * 
 * @file User object manipulation 
 */

class User
{
    /** @private name of the user */                     #name;
    /** @private forname of the user */                  #forname;
    /** @private username of the user, used to log in */ #username;
    /** @private password of the user, used to log in */ #password;
    /** @private id of the user in the database */       #id;

    /**
     * Create an instance of a user
     * 
     * @constructor
     * @this  {User}
     * @param {string} name 
     * @param {string} forname 
     * @param {string} username 
     * @param {string} password 
     * @param {number} id if the user is newly created, let the id field empty
     */
   
    constructor(name, forname, username, password, id = 0)
    {
        this.#name = name;
        this.#forname = forname;
        this.#username = username;
        this.#password = password;
        this.#id = id;
    }

    /**
     * Name getter 
     * @returns {string} #name
     */
    getName()
    {
        return this.#name;
    }

    /**
     * Name setter
     * @param {string} name 
     */
    setName(name)
    {
        this.#name = name
    }

    /**
     * Forname getter
     * @returns {string} #forname
     */
    getForname()
    {
        return this.#forname;
    }

    /**
     * Forname setter
     * @param {string} forname 
     */
    setForname(forname)
    {
        this.#forname = forname;
    }

    /**
     * Username getter
     * @returns {string} #username
     */
    getUsername()
    {
        return this.#username;
    }

    /**
     * Username setter
     * @param {String} username 
     */
    setUsername(username)
    {
        this.#username = username;
    }

    /**
     * Password getter
     * @returns {string} #password
     */
    getPassword()
    {
        return this.#password;
    }

    /**
     * Password setter
     * @param {string} password 
     */
    setPassword(password)
    {
        this.#password = password
    }

    /**
     * Id getter
     * @returns {number} #id
     */
    getId()
    {
        return this.#id;
    }

}

module.exports = User;