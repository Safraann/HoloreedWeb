/**
 * @author Korentin Massif
 * @version 0.1
 * 
 * @file Patient object manipulation 
 */

class Patient
{
    /** @private name of the patient */                     #name;
    /** @private forname of the patient */                  #forname;
    /** @private birthday of the patient */                 #birthday;
    /** @private useful information about the patient */    #about;
    /** @private id of the patient in the database */       #id;
    
    /**
     * Create an instance of a patient
     * 
     * @constructor
     * @this  {Patient}
     * @param {string} name 
     * @param {string} forname
     * @param {date}   date the date is loaded into a table : {YEAR, MONTH, DAY}
     * @param {string} about
     * @param {number} id if the patient is newly created, let the id field empty
     */
    
    constructor(name, forname, date, about, id = 0)
    {
        this.#name = name;
        this.#forname = forname;
        this.#birthday = new Date(date[0], date[1], date[2]);
        this.#about = about;
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
     * Birthday getter
     * @returns {date} birtday
     */
    getBirthday()
    {
        return this.#birthday;
    }

    /**
     * about setter
     * @param {string} about 
     */
    setAbout(about)
    {
        this.#about = about;
    }

    /**
     * about getter
     * @returns {string} about
     */
    getAbout()
    {
        return this.#about;
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

module.exports = Patient